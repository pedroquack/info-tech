<?php

namespace App\Http\Controllers;

use App\Enums\Roles;
use App\Interfaces\ProjectRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;
use App\Models\Project;
use App\Models\User;
use App\Repositories\ProjectRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ProjectController extends Controller
{
    protected $projectRepository;
    protected $userRepository;

    public function __construct(ProjectRepositoryInterface $projectRepository, UserRepositoryInterface $userRepository){
        $this->projectRepository = $projectRepository;
        $this->userRepository = $userRepository;
    }

    //Retorna aview contendo todos os projetos cadastrados
    public function index()
    {
        //Controle de acesso para admins
        Gate::authorize('isAdmin', User::class);
        //Recupera todos os projetos
        $projects = $this->projectRepository->getAll();

        //Retorna a listagem de projetos
        return view('projects.index', compact('projects'));
    }

    //Retorna a view contendo o formulário de criação de um projeto
    public function create()
    {
        //Controle de acesso para admins
        Gate::authorize('isAdmin', User::class);
        //Recupera todos os usuários cadastrados como CLIENTE, para exibir no select do formulário
        $clients = $this->userRepository->getAllClients();
        //Exibe o formulario de criação de projeto
        return view('projects.create',compact('clients'));
    }

    //Valida e armazena um projeto
    public function store(Request $request)
    {
        //Controle de acesso para admins
        Gate::authorize('isAdmin', User::class);

        //Faz a validações dos campos vindos da requisição
        $projectData = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'start_date' => 'date|required',
            'end_date' => 'date|after:start_date|required',
            'client_id' => 'required|exists:users,id',
        ]);

        //Recupera o usuário marcado como cliente na requisição
        $user = $this->userRepository->findById($projectData['client_id']);

        //Checa se o usuário selecionado não é um cliente
        if($user->role !== Roles::CLI->value){
            //Se não for um cliente, retorna uma mensagem de erro
            return redirect()->back()->with('error', 'Somente clientes podem ser associados a projetos!');
        }

        //Cria um projeto e define seus atributos
        $project = $this->projectRepository->create($projectData);

        //Retorna para a listagem de projetos com uma mensagem de sucesso
        return redirect()->route('projects.show', $project->id)->with('success','Projeto criado com sucesso!');
    }

    //Exibe um projeto especifico
    public function show(int $id)
    {
        //Recupera o projeto pelo id passado no corpo da requisição
        $project = $this->projectRepository->findById($id);

        //Testa se o projeto existe
        if(!isset($project)){
            //Se não existir, retorna uma mensagem de erro
            return redirect()->back()->with('error', 'O projeto especificado não existe!');
        }

        //Controle de acesso para admins e para o cliente do projeto
        Gate::authorize('show',$project, Project::class);

        //Retorna a view contendo as informações do projeto
        return view('projects.show', compact('project'));
    }

    //Retorna a view contendo o formulário de edição de um projeto
    public function edit(int $id)
    {
        //Controle de acesso para admins
        Gate::authorize('isAdmin', User::class);

        //Recupera o projeto pelo id passado no corpo da requisição
        $project = $this->projectRepository->findById($id);
        //Recupera todos os usuários cadastrados como CLIENTE, para exibir no select do formulário
        $clients = $this->userRepository->getAllClients();
        //Exibe o formulario de edição do projeto especificado
        return view('projects.edit',compact('clients','project'));
    }

    //Valida e atualiza um projeto
    public function update(Request $request)
    {
        //Controle de acesso para admins
        Gate::authorize('isAdmin', User::class);

        //Faz a validações dos campos vindos da requisição
        $projectData = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'start_date' => 'date|required',
            'end_date' => 'date|after:start_date|required',
            'client_id' => 'required|exists:users,id',
            'project_id' => 'required'
        ]);

        //Recupera o usuário marcado como cliente na requisição
        $user = $this->userRepository->findById($projectData['client_id']);
        //Checa se o usuário selecionado não é um cliente
        if($user->role !== Roles::CLI->value){
            //Se não for um cliente, retorna uma mensagem de erro
            return redirect()->back()->with('error', 'Somente clientes podem ser associados a projetos!');
        }

        //Recupera o projeto pelo id vindo do formulário
        $project = $this->projectRepository->findById($projectData['project_id']);

        //Testa se o projeto existe
        if(!isset($project)){
            //Se não existir, retorna uma mensagem de erro
            return redirect()->back()->with('error', 'O projeto especificado não existe!');
        }

        //Atualiza e salva os dados do projeto
        $project = $this->projectRepository->update($projectData['project_id'], $projectData);

        //Retorna para rota de exibição do projeto editado
        return redirect()->route('projects.show', $project->id)->with('success','Projeto editado com sucesso!');
    }

    //Deleta um projeto especifico
    public function destroy(int $id)
    {
        //Controle de acesso para admins
        Gate::authorize('isAdmin', User::class);

        //Recupera o projeto pelo id passado no corpo da requisição
        $project = $this->projectRepository->findById($id);
        //Testa se o projeto existe
        if(!isset($project)){
            //Se não existe, retorna uma mensagem de erro
            return redirect()->back()->with('error','O projeto especificado não existe!');
        }
        //Deleta o projeto
        $this->projectRepository->delete($id);
        return redirect()->route('projects.index')->with('success','Projeto excluído com sucesso!');
    }
}
