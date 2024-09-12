<?php

namespace App\Http\Controllers;

use App\Enums\Roles;
use App\Interfaces\ProjectRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;
use App\Models\Project;
use App\Models\User;
use App\Repositories\ProjectRepository;
use App\Repositories\UserRepository;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class SiteController extends Controller
{
    protected $projectRepository;
    protected $userRepository;

    public function __construct(ProjectRepositoryInterface $projectRepository, UserRepositoryInterface $userRepository)
    {
        $this->projectRepository = $projectRepository;
        $this->userRepository = $userRepository;
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

    public function users(){
        //Controle de acesso para admins
        Gate::authorize('isAdmin',User::class);

        //Recupera todos os usuários
        $users = $this->userRepository->getAll();
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

        $userData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed'],
            'role' => 'required|in:CLIENTE,ADMIN'
        ]);

        $user = $this->userRepository->create($userData);

        event(new Registered($user));

        return redirect()->route('users.index')->with('success','Usuário cadastrado com sucesso!');
    }

    public function edit_user(int $id){
        //Controle de acesso para admins
        Gate::authorize('isAdmin',User::class);

        //Recupera o usuário pelo id passado no corpo da requisição
        $user = $this->userRepository->findById($id);

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
        $user = $this->userRepository->findById($request->id);

        //Se o usuário não existir, retorna uma mensagem de erro
        if(!isset($user)){
            return redirect()->route('users.index')->with('error','Usuário especificado não existe!');
        }

        //Valida os dados vindos na requisição
        $userData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique('users','email')->ignore($user->id)],
            'role' => 'required|in:CLIENTE,ADMIN',
            'user_id' => 'required',
        ]);

        $user = $this->userRepository->update($userData['user_id'],$userData);

        //Retorna para a listagem de usuários com uma mensagem de sucesso
        return redirect()->route('users.index')->with('success','Usuário atualizado com sucesso!');
    }
    public function destroy_user(int $id){
        //Controle de acesso para admins
        Gate::authorize('isAdmin',User::class);

        //Recupera o usuário pelo id passado no corpo da requisição
        $user = $this->userRepository->findById($id);

        //Se o usuário não existir, retorna uma mensagem de erro
        if(!isset($user)){
            return redirect()->route('users.index')->with('error','Usuário especificado não existe!');
        }
        //Deleta o usuário
        $this->userRepository->delete($user->id);

        //Retorna para a listagem de usuários com uma mensagem de sucesso
        return redirect()->route('users.index')->with('success','Usuário excluído com sucesso!');
    }
}
