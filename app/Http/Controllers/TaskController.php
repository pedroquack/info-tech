<?php

namespace App\Http\Controllers;

use App\Enums\Roles;
use App\Enums\Status;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class TaskController extends Controller
{

    //GET tasks/create
    //Exibe o formulário de criação da tarefa
    public function create(int $project_id)
    {
        //Controle de acesso para admins
        Gate::authorize('isAdmin',User::class);

        //Recupera o projeto passado no corpo da requisição
        $project = Project::find($project_id);
        //Se o projeto não existir, retorna uma mensagem de erro
        if(!isset($project)){
            return redirect()->back()->with('error','Esse projeto não existe!');
        }

        //Recupera os usuários com o cargo de admin para exibir no select do formulário
        $admins = User::where('role', Roles::ADM->value)->get();

        return view('tasks.create',compact('admins','project'));
    }

    //POST tasks
    //Cria uma tarefa
    public function store(Request $request)
    {
        //Controle de acesso para admins
        Gate::authorize('isAdmin',User::class);

        //Valida os dados vindos na requisição
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'responsible' => 'required|exists:users,id',
        ]);

        $user = User::find($request->responsible);
        //Checa se o usuário apontado como responsável na requisição é um admin
        if($user->role !== Roles::ADM->value){
            return redirect()->back()->with('error', 'Somente administradores podem ser associados ás tarefas!');
        }

        //Cria a tarefa
        $task = new Task();
        $task->title = $request->title;
        $task->description = $request->description;
        $task->status = Status::AND->value;
        $task->user_id = $request->responsible;
        $task->project_id = $request->project_id;
        $task->save();

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
        $task = Task::find($id);
        if(!isset($task)){
            return redirect()->back()->with('error', 'Essa tarefa não existe!');
        }
        //Recupera todos os admins para exibir no select do formulário
        $admins = User::where('role', Roles::ADM->value)->get();

        return view('tasks.edit',compact('admins','task'));
    }

    //PUT tasks/{id}
    //Atualiza uma tarefa
    public function update(Request $request)
    {
        //Controle de acesso para admins
        Gate::authorize('isAdmin',User::class);

        //Valida os dados vindos na requisição
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'responsible' => 'required|exists:users,id',
            'task_id' => 'required',
        ]);

        //Checa se o usuário apontado como responsável na requisição é um admin
        $user = User::find($request->responsible);
        if($user->role !== Roles::ADM->value){
            return redirect()->back()->with('error', 'Somente administradores podem ser associados ás tarefas!');
        }

        //Recupera a tarefa passada no corpo da requisição e edita seus dados
        $task = Task::find($request->task_id);

        //Se a tarefa não existir, retorna uma mensagem de erro
        if(!isset($task)){
            return redirect()->back()->with('error','A tarefa especificada não existe');
        }

        $task->title = $request->title;
        $task->description = $request->description;
        //Checa se o usuário autenticado é o responsável pela tarefa
        if(Auth::user()->id == $task->responsible->id){
            //Se sim atualiza os status da tarefa
            $task->status = Status::from($request->status);
        }
        $task->user_id = $request->responsible;
        $task->save();

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
        $task = Task::find($id);
        //Se a tarefa não existir, retorna uma mensagem de erro
        if(!isset($task)){
            return redirect()->back()->with('error','A tarefa especificada não existe');
        }

        //Deleta a tarefa
        $task->delete();

        //Redireciona para a pagina do projeto
        return redirect()->route('projects.show',$task->project_id)->with('success', 'Tarefa excluída com sucesso!');
    }
}
