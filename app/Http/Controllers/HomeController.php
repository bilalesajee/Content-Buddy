<?php

namespace App\Http\Controllers;

use App\Label;
use App\Photo;
use App\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;

class HomeController extends Controller {

    function home() {
        $data['title'] = 'My home page';
        $data['currentView'] = 'home';
        return view('frontend', $data);
    } 
}
