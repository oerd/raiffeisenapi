<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Types;
class TypeController extends Controller
{
    public function get () {
      $types = Types::all();
      return view('agency.add', compact('types'));
    }
}
