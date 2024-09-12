<?php

namespace App\Http\Controllers;

use App\Enums\Roles;
use App\Enums\Status;
use App\Interfaces\ProjectRepositoryInterface;
use App\Interfaces\TaskRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use App\Repositories\ProjectRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class TaskController extends Controller
{

    protected $taskRepository;
    protected $userRepository;
    protected $projectRepository;

    public function __construct(TaskRepositoryInterface $taskRepository, UserRepositoryInterface $userRepository, ProjectRepositoryInterface $projectRepository)
    {
        $this->taskRepository = $taskRepository;
        $this->userRepository = $userRepository;
        $this->projectRepository = $projectRepository;
    }

    //GET tasks/create
    //Exibe o formulário de criação da tarefa
    public function create(int $project_id)
    {
        //Controle de acesso para admins
        Gate::authorize('isAdmin',User::class);

        //Recupera o projeto passado no corpo da requisição
        $project = $this->projectRepository->findById($project_id);
        //Se o projeto não existir, retorna uma mensagem de erro
        if(!isset($project)){
            return redirect()->back()->with('error','Esse projeto não existe!');
        }

        //Recupera os usuários com o cargo de admin para exibir no select do formulário
        $admins = $this->userRepository->getAllAdmins();

        return view('tasks.create',compact('admins','project'));
    }

    //POST tasks
    //Cria uma tarefa
    public function store(Request $request)
    {
        //Controle de acesso para admins
        Gate::authorize('isAdmin',User::class);

        //Valida os dados vindos na requisição
        $taskData = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'responsible_id' => 'required|exists:users,id',
            'project_id' => 'required|exists:projects,id',
        ]);

        $user = $this->userRepository->findById($taskData['responsible_id']);
        //Checa se o usuário apontado como responsável na requisição é um admin
        if($user->role !== Roles::ADM->value){
            return redirect()->back()->with('error', 'Somente administradores podem ser associados ás tarefas!');
        }

        //Cria a tarefa
        $task = $this->taskRepository->create($taskData);

        //Redireciona para a pagina do projeto
        return redirect()->route('projects.show',$task->project_id)->with('success', 'Tarefa criada com sucesso!');
    }


    //GET /tasks/edit/{id}
    //Exibe o formulário de edição da tarefa
    public function edit(int $id)
    {
        //Controle de acesso para admins
        Gate::authorize('isAdmin',User::class);

        //Recupera a tarefa passada no corpo da requisição
        $task = $this->taskRepository->findById($id);
        if(!isset($task)){
            return redirect()->back()->with('error', 'Essa tarefa não existe!');
        }
        //Recupera todos os admins para exibir no select do formulário
        $admins = $this->userRepository->getAllAdmins();

        return view('tasks.edit',compact('admins','task'));
    }

    //PUT tasks/{id}
    //Atualiza uma tarefa
    public function update(Request $request)
    {
        //Controle de acesso para admins
        Gate::authorize('isAdmin',User::class);

        //Valida os dados vindos na requisição
        $taskData = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'responsible_id' => 'required|exists:users,id',
            'task_id' => 'required',
            'status' => 'required'
        ]);

        //Checa se o usuário apontado como responsável na requisição é um admin
        $user = $this->userRepository->findById($taskData['responsible_id']);
        if($user->role !== Roles::ADM->value){
            return redirect()->back()->with('error', 'Somente administradores podem ser associados ás tarefas!');
        }

        //Recupera a tarefa passada no corpo da requisição e edita seus dados
        $task = $this->taskRepository->findById($taskData['task_id']);

        //Se a tarefa não existir, retorna uma mensagem de erro
        if(!isset($task)){
            return redirect()->back()->with('error','A tarefa especificada não existe');
        }

        $task = $this->taskRepository->update($taskData['task_id'],$taskData);

        //Redireciona para a pagina do projeto
        return redirect()->route('projects.show',$task->project_id)->with('success', 'Tarefa atualizada com sucesso!');;
    }

    //DELETE tasks/{id}
    //Deleta uma tarefa
    public function destroy(int $id)
    {
        //Controle de acesso para admins
        Gate::authorize('isAdmin',User::class);

        //Recupera a tarefa passada no corpo da requisição
        $task = $this->taskRepository->findById($id);
        //Se a tarefa não existir, retorna uma mensagem de erro
        if(!isset($task)){
            return redirect()->back()->with('error','A tarefa especificada não existe');
        }

        //Deleta a tarefa
        $this->taskRepository->delete($task->id);

        //Redireciona para a pagina do projeto
        return redirect()->route('projects.show',$task->project_id)->with('success', 'Tarefa excluída com sucesso!');
    }
}
