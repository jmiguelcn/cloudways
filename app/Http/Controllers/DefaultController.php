<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Http\Controllers\Cookie;

class DefaultController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    function home() 
    { 
      return view('default.home');
    }
    
    function deletecookies() 
    { 
      \Cookie::queue(\Cookie::forget('autor'));
      return view('default.home');
    }
}