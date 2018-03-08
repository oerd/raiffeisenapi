<?php

namespace App\Http\Controllers;

use App\Offer;
use App\Types;
use App\Photos;
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



class AgencyController extends Controller
{
    public function getTypes () {
      $user = Auth::user();
      if( $user->role == 2 ){
        try {
          $types = Types::all();
          return view('agency.add', compact('types'));
        } catch ( QueryException $e ) {
          return Response::json(['response' => 'Error', 'message' => 'Can not get the offers available'. $e->getMessage()]);
        }
      }else{
        return Response::json(['respone' => 'Error', 'message' => 'You do not have any permission to access this page']);
      }
    }

    public function getOffers () {
      $user = Auth::user();
      if( $user->role == 2 ){
        try {
          $data = Offer::where('user_id', $user->id_user)->where('active', 0)->get();
          $dataActive = Offer::where('user_id', $user->id_user)->where('active', 1)->get();
          return view('agency.agency', compact('data', 'dataActive'));
        } catch ( QueryException $e ) {
          return Response::json(['response' => 'Error', 'message' => 'Can not get the offers available'. $e->getMessage()]);
        }
      }else{
        return Response::json(['respone' => 'Error', 'message' => 'You do not have any permission to access this page']);
      }
    }

    public function show ($offer_id) {
      $user = Auth::user();
      if ( $user->role ==2 ) {
        try{
          $offer = Offer::where('id_offer', $offer_id)->get();
          $type = Types::where('id_types', $offer[0]->type_id)->get();
          return view('agency.show', compact('offer', 'type'))->with('photos');
        } catch (Exception $e) {
          return Response::json(['response' => 'Error', 'message' => 'You cant get the data you are looking for!']);
        }
      }
    }

    public function add () {
      $user = Auth::user();
      $name = request('name');
      $address = request('address');
      $description = request('description');
      $leke = request('leke');
      $euro = 1.35 * $leke;
      $note = request('note');
      $active = 1;
      $latitude = request('latitude');
      $longitude = request('longitude');
      $inspectionTime = request('inspectionTime');
      $bedrooms = request('bedrooms');
      $bathrooms = request('bathrooms');
      $parking_spaces = request('parking_spaces');
      $size = request('size');
      $air_conditioning = request('air_conditioning');
      $heating = request('heating');
      $solar_panel = request('solar_panel');
      $water_tank = request('water_tank');
      $type_id = request('type');

      if ( $user->role == 2 ) {
          try {
              $offer = Offer::create([
                  'name' => $name,
                  'address' => $address,
                  'active' => 0,
                  'euro' => $euro,
                  'leke' => $leke,
                  'note' => $note,
                  'description' => $description,
                  'created_at' => date('Y-m-d H:i:s'),
                  'latitude' => $latitude,
                  'longitude' => $longitude,
                  'inspectionTime' => $inspectionTime,
                  'bedrooms' => $bedrooms,
                  'bathrooms' => $bathrooms,
                  'parking_space' => $parking_spaces,
                  'size' => $size,
                  'air_conditioning' => $air_conditioning,
                  'heating' => $heating,
                  'solar_panel' => $solar_panel,
                  'water_tank' => $water_tank,
                  'user_id' => $user->id_user,
                  'type_id' => $type_id
              ]);
              if ($offer) {
                  return Response::json(["response" => "Success", "message" => "Offer Added!"]);
              }
          } catch (Exception $e) {
              return Response::json(["response" => "Error", "message" => "Can not add this offer!"]);
          }
      } else {
          return Response::json(["response" => "Error", "message" => "You don't have permision to access this!"]);
      }
    }

    public function edit( $offer_id) {
      $user = Auth::user();
      $user_id = $user->id_user;
      $offer = Offer::find($offer_id);
      if($user->role == 2){
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

    public function getEdit( $id_offer ) {
      $user = Auth::user();
      if( $user->role == 2 ){
        try {
          $types = Types::all();
          $offers = Offer::where('id_offer', $id_offer)->get();
          return view('agency.edit', compact('types', 'offers'));
        } catch ( QueryException $e ) {
          return Response::json(['response' => 'Error', 'message' => 'Can not get the offers available'. $e->getMessage()]);
        }
      } else {
        return Response::json(['response' => 'Error', 'message' => 'You do not have any permission to access this page']);
      }
    }

    public function upload(UploadRequest $request, $offer_id){
      try {
        foreach ($request->photos  as $photo) {
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
          try{
            Photos::create([
              'photo' => $name,
              'offer_id' => $offer_id
            ]);
          } catch (Exception $e) {
            return Response::json(['response' => 'Error', 'message' => 'Could not upload photo in database!']);
          }
        }
        return  Response::json(['response' => 'Success', 'message' => 'Upload successful!']);
      } catch (Exception $e) {
        return  Response::json(['response' => 'Error', 'message' => 'Something went wrong!']);
      }
    }

    public function upload_floor_plan (UploadRequest $request, $offer_id) {
      try {
//          $path = $request->floor_plan->hashName('public/uploads/floor');
//          $name = $request->floor_plan->hashName('uploads/floor');
//          $image = Image::make($request->floor_plan->getRealPath())->resize(500,500);
//          Storage::disk('uploads')->put($path, (string) $image->encode());
          $widthdef = 600;
          $heightdef = 480;
          $photo = $request->floor_plan;
          $name = $photo->hashName();
          $path = '/home/shtepiai/public_html/storage/floor/' . $name;
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
          try{
            $qr = DB::select(DB::raw("UPDATE offers SET floor_plan = '$name' WHERE offers.id_offer = '$offer_id'"));
            return  Response::json(['response' => 'Success', 'message' => 'Upload successful!']);
          } catch (Exception $e) {
            return Response::json(['response' => 'Error', 'message' => 'Could not upload photo in database!']);
          }
      } catch (Exception $e) {
        return  Response::json(['response' => 'Error', 'message' => 'Something went wrong!']);
      }
    }

    public function delete ( $offer_id ) {
      $user = Auth::user();
      $user_id = $user->id_user;
      if ($user->role == 2) {
        Offer::destroy($offer_id);
        return Response::json(['response' => 'Success', 'message' => 'Offer Deleted!']);
      } else{
        return Response::json(['response' => 'Error', 'message' => 'You dont have permision to access this!']);
      }
    }
}
