<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Interes;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class InteresController extends Controller
{
    public function retrieve()
    {
        $user = Auth::user();
        if ($user->role == 0) {
            try {
                $interes = Interes::all()->where('active', 1);
                return view('admin.micasa.configuration', compact('interes'));
            } catch (Exception $e) {
                return Response::json(["response" => "Error", "message" => "Can't read the data"]);
            }
        } else {
            return Response::json(["response" => "Error", "message" => "You don't have permision to access this!"]);
        }
    }

    public function get(){
      try{
        $data = Interes::all()->where('active', 1);
        return $data;
      }catch(Exception $e){
        return Response::json(["response" => "Error", "message" => "Can't read the data"]);
      }
    }

    public function create()
    {
        $user = Auth::user();
        $first_year = request('first_year');
        $next_years = request('next_years');

        if ($user->role == 0) {
            try {
                $interes = Interes::create([
                    'first_year' => $first_year,
                    'next_years' => $next_years,
                    'active' => 1
                ]);
                if ($interes) {
                    return Response::json(["response" => "Success", "message" => "Interest Added!"]);
                }
            } catch (Exception $e) {
                return Response::json(["response" => "Error", "message" => "You can't add these interesses!"]);
            }
        } else {
            return Response::json(["response" => "Error", "message" => "You don't have permision to access this!"]);
        }
    }

    public function edit($id_interes)
    {
        $user = Auth::user();
        $first_year = request('first_year');
        $next_years = request('next_years');
            try{
                $interes = DB::table('interes')
                ->where('id_interes', '' . $id_interes . '')
                ->update(['first_year' => $first_year, 'next_years' => $next_years]);
                return Response::json(["response" => "Success", "message" => "Interes updated!"]);
            }catch(Exception $e){
                return Response::json(["response" => "Error", "message" => "Interes could not be updated!"]);
            }         
        
    }

    public function delete($id_interes)
    {
        $user = Auth::user();
        if ($user->role == 0) {
            $deleteInteres = DB::table('interes')
                ->where('id_interes', '' . $id_interes . '')
                ->update(['active' => 0]);
            if ($deleteInteres) {
                return Response::json(["response" => "Success", "message" => "Interes Deleted"]);
            } else {
                return Response::json(["response" => "Error", "message" => "Interes could not be deleted!"]);
            }
        } else {
            return Response::json(["response" => "Error", "message" => "You don't have permision to access this!"]);
        }
    }
}
