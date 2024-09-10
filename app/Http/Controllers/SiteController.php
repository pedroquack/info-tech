<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SiteController extends Controller
{
    public function index(){
        //Recupera todos os projetos do cliente autenticado
        $projects = Project::where('user_id',Auth::user()->id)->get();

        //Retorna a view listando os projetos
        return view('home', compact('projects'));
    }
}
