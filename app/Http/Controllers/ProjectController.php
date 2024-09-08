<?php

namespace App\Http\Controllers;

use App\Enums\Roles;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('projects.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clients = User::where('role', 'CLIENTE')->get();
        return view('projects.create',compact('clients'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'start_date' => 'date|required',
            'end_date' => 'date|after:start_date|required',
            'client' => 'required|exists:users,id',
        ]);

        $user = User::find($request->client);
        if($user->role !== Roles::CLI->value){
            return redirect()->back()->with('error', 'Somente clientes podem ser associados a projetos!');
        }

        $project = new Project();
        $project->title = $request->title;
        $project->description = $request->description;
        $project->start_date = $request->start_date;
        $project->end_date = $request->end_date;
        $project->user_id = $request->client;
        $project->save();

        return redirect()->route('projects.index')->with('success','Projeto criado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $project = Project::find($id);
        return view('projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'start_date' => 'date|required',
            'end_date' => 'date|after:start_date|required',
            'client' => 'required|exists:users,id',
        ]);

        $user = User::find($request->client);
        if($user->role !== Roles::CLI->value){
            return redirect()->back()->with('error', 'Somente clientes podem ser associados a projetos!');
        }

        $project->title = $request->title;
        $project->description = $request->description;
        $project->start_date = $request->start_date;
        $project->end_date = $request->end_date;
        $project->user_id = $request->client;
        $project->save();

        return redirect()->route('projects.index')->with('success','Projeto editado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        if(!isset($project)){
            return redirect()->back()->with('error','Esse projeto não existe');
        }
        return redirect()->route('projects.index')->with('success','Projeto excluído com sucesso!');
    }
}
