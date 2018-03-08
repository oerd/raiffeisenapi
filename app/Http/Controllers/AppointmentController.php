<?php

namespace App\Http\Controllers;

use App\Appointment;
use App\Appointments;
use Illuminate\Support\Facades\Response;
use DB;

class AppointmentController extends Controller
{
    public function make_appointment()
    {
      $title = request('title');
      $name = request('name');
      $lastname = request('lastname');
      $phone = request('phone');
      $email = request('email');
      $liked = request('liked');
      $preferences = request('preferences');
      $description = request('description');
      $postcode = request('postcode');
      $select = DB::table('appointments')->where('email', $email)->count();
      if($select == 0){
        $appointment = Appointments::create([
            'title' => $title,
            'name' => $name,
            'lastname' => $lastname,
            'phone' => $phone,
            'email' => $email,
            'liked' => $liked,
            'preferences' => $preferences,
            'description' => $description,
            'postcode' => $postcode
        ]);
        if ($appointment) {
          return Response::json(["response" => "Success", "message" => "Appointment Addedd!"]);
        } else {
          return Response::json(["response" => "Error", "message" => "Could not add the appointment"]);
        }
      }else {
        return Response::json(["response"=> "Error", "message"=> "Already exists!"]);
      }
    }
}
