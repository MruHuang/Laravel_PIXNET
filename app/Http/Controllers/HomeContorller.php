<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Route;
use View;

class HomeContorller extends Controller
{
    //
    public function index() {
    	return route('restartGame',['Guess'=>4]);
    }
}
