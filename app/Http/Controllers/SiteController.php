<?php

namespace App\Http\Controllers;

use App\Enums\Roles;
use App\Interfaces\ProjectRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class SiteController extends Controller
{
    protected $projectRepository;

    public function __construct(ProjectRepositoryInterface $projectRepository)
    {
        //Injeção de dependência do repository
        $this->projectRepository = $projectRepository;
    }

    public function home(){
        //Recupera todos os projetos do cliente autenticado
        $projects = $this->projectRepository->getByClient(Auth::user()->id);

        if(Auth::user()->role == Roles::ADM->value){
            return redirect()->route('projects.index');
        }
        //Retorna a view listando os projetos
        return view('home', compact('projects'));
    }
}
