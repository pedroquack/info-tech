<?php

namespace App\Http\Controllers;

use App\Enums\Roles;
use App\Models\Project;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class SiteController extends Controller
{
    public function home(){
        //Recupera todos os projetos do cliente autenticado
        $projects = Project::where('user_id',Auth::user()->id)->get();

        if(Auth::user()->role == Roles::ADM->value){
            return redirect()->route('projects.index');
        }
        //Retorna a view listando os projetos
        return view('home', compact('projects'));
    }

    public function users(){
        //Controle de acesso para admins
        Gate::authorize('isAdmin',User::class);

        //Recupera todos os usuários
        $users = User::orderBy('role')->get();
        return view('admin.users', compact('users'));
    }

    public function create_user(){
        //Controle de acesso para admins
        Gate::authorize('isAdmin',User::class);

        return view('admin.register');
    }

    public function store_user(Request $request)
    {
        //Controle de acesso para admins
        Gate::authorize('isAdmin',User::class);

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed'],
            'role' => 'required|in:CLIENTE,ADMIN'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => Roles::from($request->role),
            'password' => bcrypt($request->password),
        ]);

        event(new Registered($user));

        return redirect()->route('users.index')->with('success','Usuário cadastrado com sucesso!');
    }

    public function edit_user(int $id){
        //Controle de acesso para admins
        Gate::authorize('isAdmin',User::class);

        //Recupera o usuário pelo id passado no corpo da requisição
        $user = User::find($id);

        //Se o usuário não existir, retorna uma mensagem de erro
        if(!isset($user)){
            return redirect()->route('users.index')->with('error','Usuário especificado não existe!');
        }

        //Exibe o formulário de edição do usuário especificado
        return view('admin.edit', compact('user'));
    }

    public function update_user(Request $request)
    {
        //Controle de acesso para admins
        Gate::authorize('isAdmin',User::class);

        //Recupera o usuário pelo id especificado na requisição
        $user = User::find($request->id);

        //Se o usuário não existir, retorna uma mensagem de erro
        if(!isset($user)){
            return redirect()->route('users.index')->with('error','Usuário especificado não existe!');
        }

        //Valida os dados vindos na requisição
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique('users','email')->ignore($user->id)],
            'role' => 'required|in:CLIENTE,ADMIN',
            'user_id' => 'required',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = Roles::from($request->role);
        $user->save();

        //Retorna para a listagem de usuários com uma mensagem de sucesso
        return redirect()->route('users.index')->with('success','Usuário atualizado com sucesso!');
    }
    public function destroy_user(int $id){
        //Controle de acesso para admins
        Gate::authorize('isAdmin',User::class);

        //Recupera o usuário pelo id passado no corpo da requisição
        $user = User::find($id);

        //Se o usuário não existir, retorna uma mensagem de erro
        if(!isset($user)){
            return redirect()->route('users.index')->with('error','Usuário especificado não existe!');
        }
        //Deleta o usuário
        $user->delete();

        //Retorna para a listagem de usuários com uma mensagem de sucesso
        return redirect()->route('users.index')->with('success','Usuário excluído com sucesso!');
    }
}
