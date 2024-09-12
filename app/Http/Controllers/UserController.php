<?php

namespace App\Http\Controllers;

use App\Interfaces\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        //Injeção de depêndencia do repository;
        $this->userRepository = $userRepository;
        //Controle de acesso para admins
        Gate::authorize('isAdmin',User::class);
    }

    public function index(){
        //Recupera todos os usuários
        $users = $this->userRepository->getAll();
        return view('admin.users', compact('users'));
    }

    public function create(){

        return view('admin.register');
    }

    public function store(Request $request)
    {

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

    public function edit(int $id){

        //Recupera o usuário pelo id passado no corpo da requisição
        $user = $this->userRepository->findById($id);

        //Se o usuário não existir, retorna uma mensagem de erro
        if(!isset($user)){
            return redirect()->route('users.index')->with('error','Usuário especificado não existe!');
        }

        //Exibe o formulário de edição do usuário especificado
        return view('admin.edit', compact('user'));
    }

    public function update(Request $request)
    {

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
    public function destroy(int $id){

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
