<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SiteController extends Controller
{
    public function index(){
        $projects = Project::where('user_id',Auth::user()->id)->get();
        return view('home', compact('projects'));
    }
}
