<?php

namespace App\Http\Controllers;

use App\Offer;
use App\Types;
use App\Photos;
use App\Agency;
use App\User;
use App\Appointments;
use Image;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Database\QueryException;
use App\Http\Requests\UploadRequest;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function getOffers(){
      $user =Auth::user();
      if ($user->role == 0) {
        try{
          $user = User::select('users.*')->where('role', 2)->with('offer')->with('agency')->get();
          return view('admin.micasa.listing', compact('user'));
        }catch(Exception $e) {
          return Response::json(['response' => 'Error', 'message' => "You can't get the data you're looking for!"]);
        }
      }
    }

    public function search(){
      $offers = request('keyword');
      $agency = array();
      $results = Offer::where('name', 'like', '%'.$offers.'%')
          ->orWhere('address', 'like', '%'.$offers.'%')->get();
      
      // $agency = Agency::where('user_id', $results->user_id)->first();
      //if (Request::wantsJson()) return $results;
      return view("admin.micasa.search", compact('results','agency'));
    }

    public function showDash() {
      $user = Auth::user();
      if($user->role == 0){
        try{
          $date = date("Y-m-d H:i:s", strtotime("-1 week"));

          $property = Offer::where('created_at', '>', $date)->get();
          $countProp = count($property);

          $offers = Offer::all();
          $countOffer = count($offers);

          $home = Offer::where('type_id', '=', 7)->get();
          $countHome = count($home);

          $apartments = Offer::whereBetween('type_id', [1, 6])->get();
          $countAppartments = count($apartments);

          $houseLand = Offer::whereBetween('type_id', [7, 9])->get();
          $counthouseLand = count($houseLand);

          $newLand = Offer::where('type_id', '=', 9);
          $countNewLand= count($newLand);

          $rural = Offer::where('type_id', '=', 10)->get();
          $countRural = count($rural);

          $users = User::where('created_at', '>', $date)->get();
          $countUsers = count($users);

          $user = User::all();
          $userAll = count($user);

          $appointment = Appointments::all();
          $countApp = count($appointment);

          $offersWaiting = Offer::where('active', 2)->get();
          $offersAppRec = Offer::where('active', 1)->where('created_at', '>', $date)->limit(5)->get();


          return view('admin.micasa.dashboard', compact('offersWaiting', 'offersAppRec','countProp', 'countOffer','countHome','countAppartments','counthouseLand','countNewLand','countRural','countUsers', 'userAll', 'countApp'));
        }catch(Exception $e){
          return Response::json(['response'=> 'Error', 'message' => 'Something went wrong!']);
        }
      }
    }

    public function showOffer($offer_id){
      $user = Auth::user();
      if($user->role == 0) {
        try{
          $offer = Offer::where('id_offer', $offer_id)->first();
          $user = User::where('id_user', $offer->user_id)->first();
          $agency = Agency::where('user_id', $user->id_user)->first();
          $type = Types::where('id_types', $offer->type_id)->first();
          return view('admin.listings.view', compact('offer', 'type','agency'));
        }catch(Exception $e){
          return Response::json(['response' => 'Error', 'message' => 'Something went wrong!']);
        }
      }else{
        return Response::json(['response' => 'Error', 'message' => 'You have no rights to login here. Please login as admin.']);
      }
    }

    public function addOffer(UploadRequest $request) {      
        $user = Auth::user();
        if ($user->role == 0) {
            $user = Auth::user();
            $name = request('name');
            $address = request('address');
            $description = request('description');
            $currency = request('currency');
            $money = request('money');
            $note = request('note');
            $active = 1;
            $latitude = request('latitude');
            $longitude = request('longitude');
            $inspectionTime = request('inspectionTime');
            $bedrooms = request('bedrooms');
            $bathrooms = request('bathroom');
            $parking_spaces = request('parking_space') == null ? request('parking_space') : 0;
            $size = request('size');
            $air_conditioning = request('air_conditioning') == null ? request('air_conditioning') : 0;
            $heating = request('heating') == null ? request('heating') : 0;
            $solar_panel = request('solar_panel') == null ? request('solar_panel') : 0;
            $water_tank = request('water_tank') == null ? request('water_tank') : 0;
            $type_id = request('type');
            $agency_id = request('agency');
            $hipotekimi = request('hipotek');
            $agent = Agency::find($agency_id);
            // dd(request()->all());
            try {
                $offer = new Offer();
                $offer->name = $name;
                $offer->address = $address;
                $offer->active = $active;
                $offer->description = $description;
                $offer->created_at = date('Y-m-d H:i:s');
                $offer->latitude = $latitude;
                $offer->longitude = $longitude;
                $offer->inspectionTime = $inspectionTime;
                $offer->bedrooms = $bedrooms;
                $offer->bathrooms = $bathrooms;
                $offer->parking_spaces = $parking_spaces;
                $offer->size = $size;
                $offer->currency = $currency;
                $offer->air_conditioning = $air_conditioning;
                $offer->heating = $heating;
                $offer->solar_panel = $solar_panel;
                $offer->water_tank = $water_tank;
                $offer->user_id = $user->user_id;
                $offer->type_id = $type_id;
                $offer->user_id = $agent->user_id;
                $offer->hipotek = $hipotekimi;

                if ($currency == 'ALL') {
                    $offer->euro = $money / 1.35;
                    $offer->leke = money;
                }else {
                    $offer->euro = $money;
                    $offer->leke = $money * 1.35;
                }
                foreach ($request->photo  as $photo) {
                    //          $path = $photo->hashName('public/storage');
                    //          $name = $photo->hashName();
                    //          Storage::put($path, (string) $image->encode());
                    $widthdef = 600;
                    $heightdef = 480;
                    $name = $photo->hashName();
                    $path = '/home/shtepiai/public_html/storage/'.$name;
                    $image = Image::make($photo->getRealPath());
                    $width = $image->width();
                    $height = $image->height();
                    if($width > $height) {
                        if ($width < $widthdef) {
                            $background = Image::canvas(600,480);
                            $image->resize($widthdef, $heightdef, function ($asp){
                                $asp->aspectRatio();
                                $asp->upsize();
                            });
                        } else {
                            $image->resize($widthdef, $heightdef, function ($asp){
                                $asp->aspectRatio();
                                $asp->upsize();
                            });
                        }
                    } else if ($width < $height) {
                        if($height < $heightdef) {
                            $background = Image::canvas();
                        }
                    }
                    $image->save($path, 90);

                    Photos::create([
                        'photo' => $name,
                        'offer_id' => $offer->id_offer
                    ]);
                }
            $offer->save();
            return Response::json(["response" => "Success", "message" => "Offer Added!"]);
            } catch (Exception $e) {
                return Response::json(["response" => "Error", "message" => "Can not add this offer!"]);
            }
        } else {
            return Response::json(['response' => 'Error', 'message' => 'You have no rights to login here. Please login as admin.']);
        }
    }

    public function editOffer($offer_id) {
      $user = Auth::user();
      $user_id = $user->id_user;
      $offer = Offer::find($offer_id);
      if($user->role == 0){
        $offer->name = request('name') == '' ? null : request('name');
        $offer->address = request('address') == '' ? null : request('address');
        $offer->description = request('description') == '' ? null : request('description');
        $offer->euro = request('euro') == '' ? null : request('euro');
        $offer->leke = request('leke') == '' ? null : request('leke');
        $offer->note = request('note') == '' ? null : request('note');
        $offer->active = request('active') == '' ? null : request('active');
        $offer->updated_at = request('updated_at') == '' ? null : request('updated_at');
        $offer->latitude = request('latitude') == '' ? null : request('latitude');
        $offer->longitude = request('longitude') == '' ? null : request('longitude');
        $offer->inspectionTime = request('inspectionTime') == '' ? null : request('inspectionTime');
        $offer->bedrooms = request('bedrooms') == '' ? null : request('bedrooms');
        $offer->bathrooms = request('bathrooms') == '' ? null : request('bathrooms');
        $offer->parking_space = request('parking_spaces') == '' ? null : request('parking_spaces');
        $offer->size = request('size') == '' ? null : request('size');
        $offer->air_conditioning = request('air_conditioning') == '' ? null : request('air_conditioning');
        $offer->heating = request('heating') == '' ? null : request('heating');
        $offer->solar_panel = request('solar_panel') == '' ? null : request('solar_panel');
        $offer->water_tank = request('water_tank') == '' ? null : request('water_tank');
        $offer->save();
        return Response::json(['response' => "Success", 'message' => "Offer updated!"]);
      } else {
        return Response::json(['response' => 'Error', 'message' => 'You dont have permision to access this!']);
      }
    }

    public function getEditOffer($offer_id) {
      $user = Auth::user();
      if( $user->role == 0 ){
        try {
          $types = Types::all();
          $offers = Offer::where('id_offer', $offer_id)->first();
          $users = User::where('id_user', $offers->user_id)->first();
          $agency = Agency::where('user_id', $users->id_user)->first();
          return view('admin.listings.edit', compact('types', 'offers','agency'));
        } catch ( QueryException $e ) {
          return Response::json(['response' => 'Error', 'message' => 'Can not get the offers available'. $e->getMessage()]);
        }
      } else {
        return Response::json(['response' => 'Error', 'message' => 'You do not have any permission to access this page']);
      }
    }

    public function deleteOffer($offer_id) {
      $user = Auth::user();
      $user_id = $user->id_user;
      if ($user->role == 0) {
        Offer::destroy($offer_id);
        return Response::json(['response' => 'Success', 'message' => 'Offer Deleted!']);
      } else{
        return Response::json(['response' => 'Error', 'message' => 'You dont have permision to access this!']);
      }
    }

    public function getAgency($id_agency) {
        $user = Auth::user();
        $user_id = $user->id_user;
        if($user->role == 0){
            $agency = Agency::where('id_agency', $id_agency);
            return $agency;
        }else{
            return Response::json(["response" => "Error", "message" => "You have no permission to access this kind of files!"]);
        }
    }

    public function addAgency(){
        $user = Auth::user();
        $user_id = $user->id_user;
        $name = request('name');
        $agency_name = request('agency_name');
        $email = request('email');
        $cel = request('cel');
        $password = request('password');
        $username = request('username');
        $address = request('address');
        $url = request('url');
        if ($user->role == 0) {
            try {
                $user_a = User::create([
                    'name' => $name,
                    'email' => $email,
                    'username' => $username,
                    'phone' => $cel,
                    'password' => Hash::make($password),
                    'role' => 2
                ]);
                $agency = Agency::create([
                    'name' => $agency_name,
                    'url' => $url,
                    'address' => $address,
                    'user_id' => $user_a->id_user
                ]);
                return Response::json(['response'=>'Success', 'message'=>'Agency Addedd Successfully!']);
            } catch (Exception $e) {
                return Response::json(["response" => "Error", "message" => "Wrong: " . $e->getMessage()]);
            }
        } else {
            return Response::json(["response" => "Error", "message" => "Wrong"]);
        }
    }

    public function agencyAdd() {
        return view('admin.micasa.agency.add');
    }

    public function getEditAgency($id_agency) {
        $agency = Agency::find($id_agency);
        $user = User::find($agency->user_id);

        return view('admin.micasa.agency.edit', compact('agency', 'user'));
    }

    public function editAgency($id_agency){
        $user = Auth::user();
        $user_id = $user->id_user;
        $agency = Agency::find($id_agency);
        if ($user->role == 0) {
            $agency->name = request('agency_name') == '' ? null : request('agency_name');
            $agency->address = request('address') == '' ? null : request('address');
            $agency->url = request('url') == '' ? null : request('url');
            $agency->save();
            $id_user = $agency->user_id;
            $usera = User::find($id_user);
            $usera->name = request('name') == '' ? null : request('name');
            $usera->username = request('username') == '' ? null : request('username');
            $usera->email = request('email') == '' ? null : request('email');
            $usera->phone = request('phone') == '' ? null : request('phone');
            $usera->password = request('password') == '' ? null : request('password');
            $usera->save();
            return Response::json(["response" => "Success", "message" => "Update u be!"]);
        } else {
            return Response::json(["response" => "Error", "message" => "Something went wrong!"]);
        }
    }

    public function deleteAgency ($id_user) {
        $user = Auth::user();
        $user_id = $user->id_user;
        if ($user->role == 0) {
            $u = User::destroy($id_user);
            $a = Agency::where('user_id', $id_user)->delete();
            return Response::json(["response" => "Success" , "message" => "Agency deleted!"]);
        } else {
            return Response::json(['response' => 'Error', 'message' => 'You dont have permision to access this!']);
        }
    }

    public function showAgency() {
      $user = Auth::user();
      if ($user->role == 0) {
          try {
              $user = User::select('users.*')->where('role', 2)->get();                           
              return view('admin.micasa.agency', compact('user','agency'));
          } catch (Exception $e) {
              return Response::json(['response' => 'Error', 'message' => "You can't get the data you're looking for!"]);
          }
      }
    }

  public function addNew(){
    $user = Auth::user();
    if( $user->role == 0 || $user->role == 2 ){
        try {
            $types = Types::all();
            $agency = Agency::all();
            return view('admin.micasa.addnew', compact('types', 'agency'));
        } catch ( QueryException $e ) {
            return Response::json(['response' => 'Error', 'message' => 'Can not get the offers available'. $e->getMessage()]);
        }
    }else{
        return Response::json(['respone' => 'Error', 'message' => 'You do not have any permission to access this page']);
    }
}

public function changePassword() {
    $user = Auth::user();
    if($user->role == 0) {
        $password = request('password');
        $confirmPassword = request('confirm_password');
        if($password == $confirmPassword)
        {
            try{
                $password = Hash::make($password);
                $updatePass = User::where('id_user', $user->id_user)->update(['password'=>$password]);
                return Response::json(['response' => 'Success', 'message' => 'Password updated!']);
            }catch(Exception $e){
                return Response::json(['response' => 'Error', 'message' => "Something went wrong!"]);
            }
        }
    }else {
        return Response::json(['respone' => 'Error', 'message' => 'You do not have any permission to access this page']);        
    }
}
public function changePass() {
    return view('admin.micasa.settings');
}
  
}
