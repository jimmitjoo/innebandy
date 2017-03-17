<?php

namespace App\Http\Controllers;

use App\Club;
use Illuminate\Http\Request;

class ClubController extends Controller
{
    public function index()
    {
        return Club::all();
    }
}
