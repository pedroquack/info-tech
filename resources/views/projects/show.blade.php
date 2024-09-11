<x-app-layout>
    <div class="bg-gray-100 p-5 rounded-t-lg">
        <div>
            <div class="flex md:flex-row flex-reverse-col justify-between items-center">
                <h1 class="text-xl font-bold">{{ $project->title }}</h1>
                @can('isAdmin','App\Models\User')
                <div class="flex items-center justify-center gap-3">
                    <a href="{{ route('projects.edit',$project->id) }}"
                        class="bg-yellow-300 p-2 rounded-lg hover:bg-yellow-400 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                            class="size-5">
                            <path
                                d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75 0 0 0 .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32L19.513 8.2Z" />
                        </svg>
                    </a>
                    <form action="{{ route('projects.destroy',$project->id) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-400 p-2 rounded-lg hover:bg-red-500 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                class="size-5">
                                <path fill-rule="evenodd"
                                    d="M16.5 4.478v.227a48.816 48.816 0 0 1 3.878.512.75.75 0 1 1-.256 1.478l-.209-.035-1.005 13.07a3 3 0 0 1-2.991 2.77H8.084a3 3 0 0 1-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 0 1-.256-1.478A48.567 48.567 0 0 1 7.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 0 1 3.369 0c1.603.051 2.815 1.387 2.815 2.951Zm-6.136-1.452a51.196 51.196 0 0 1 3.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 0 0-6 0v-.113c0-.794.609-1.428 1.364-1.452Zm-.355 5.945a.75.75 0 1 0-1.5.058l.347 9a.75.75 0 1 0 1.499-.058l-.346-9Zm5.48.058a.75.75 0 1 0-1.498-.058l-.347 9a.75.75 0 0 0 1.5.058l.345-9Z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                    </form>
                </div>
                @endcan
            </div>
            <h2><span class="font-bold">Cliente: </span>{{ $project->client->name }}</h2>
            <div class="flex gap-1">
                <h3 class="font-bold">Inicio: </h3>
                <h4>{{ $project->start_date->format('d/m/Y') }}</h4>
            </div>
            <div class="flex gap-1">
                <h3 class="font-bold">Término: </h3>
                <h4>{{ $project->end_date->format('d/m/Y') }}</h4>
            </div>
            <div>
                <h2 class="font-bold">Descrição:</h2>
                <p>
                    {{ $project->description }}
                </p>
            </div>
        </div>
    </div>
    <!-- Tarefas associadas ao Projeto -->
    <div class="bg-white p-5">
        <div class="flex md:flex-row flex-col md:gap-0 gap-3 items-center justify-between mb-5">
            <h2 class="text-lg font-bold">Tarefas</h2>
            @can('isAdmin', 'App\Models\User')
            <a href="{{ route('tasks.create',$project->id) }}"
                class="bg-green-400 bg-opacity-80 hover:bg-green-500 transition py-1 px-3 rounded-lg flex items-center gap-1 md:w-fit w-full justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                    <path fill-rule="evenodd"
                        d="M12 3.75a.75.75 0 0 1 .75.75v6.75h6.75a.75.75 0 0 1 0 1.5h-6.75v6.75a.75.75 0 0 1-1.5 0v-6.75H4.5a.75.75 0 0 1 0-1.5h6.75V4.5a.75.75 0 0 1 .75-.75Z"
                        clip-rule="evenodd" />
                </svg>
                Adicionar Tarefa
            </a>
            @endcan
        </div>
        <hr>
        @if($project->tasks->count() > 0)
        <!-- Tabela de Tarefas em Desktop -->
        <div class="overflow-auto rounded-lg shadow md:block hidden">
            <table class="w-full">
                <thead class="bg-gray-100 border-b-2 border-gray-200">
                    <tr>
                        <th class="p-3 text-sm font-semibold tracking-wide text-left">Titulo</th>
                        <th class="p-3 text-sm font-semibold tracking-wide text-left">Descrição</th>
                        <th class="p-3 text-sm font-semibold tracking-wide text-left">Responsável</th>
                        <th class="p-3 text-sm font-semibold tracking-wide text-left">Status</th>
                        @can('isAdmin', 'App\Models\User')
                        <th class="p-3 text-sm font-semibold tracking-wide text-left">Ações</th>
                        @endcan
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($project->tasks as $task)
                    <tr>
                        <td class="p-3 text-sm whitespace-nowrap">{{ $task->title }}</td>
                        <td class="p-3 text-sm" x-data="{isOpen: false}"">
                                    <button type=" button" @click="isOpen = true">
                            <p class="break-all line-clamp-1 text-gray-600 hover:text-black cursor-pointer underline">
                                {{ $task->description }}
                            </p>
                            </button>
                            <!-- Modal para exibir a descrição completa da tarefa -->
                            <div x-cloak x-show="isOpen"
                                class="bg-black bg-opacity-20 absolute w-full h-full top-0 left-0 p-48">
                                <div class="bg-white p-8 rounded" x-cloak x-show="isOpen" x-transition
                                    @click.outside="isOpen = false">
                                    <h3 class="font-bold text-lg">Descrição da tarefa</h3>
                                    <p class="break-words mt-2">
                                        {{ $task->description }}
                                    </p>
                                </div>
                            </div>
                        </td>
                        <td class="p-3 text-sm whitespace-nowrap uppercase">{{ $task->responsible->name }}</td>
                        <td class="p-3 text-sm whitespace-nowrap"><span
                                class="p-2 text-xs font-bold uppercase tracking-wider rounded-lg bg-opacity-80 @if($task->status == "CONCLUIDO") bg-green-400 text-green-900 @else bg-yellow-200 text-yellow-900 @endif">{{
                                $task->status }}</span></td>
                        @can('isAdmin', 'App\Models\User')
                        <td class="p-3 text-sm font-semibold tracking-wide text-left flex gap-3">
                            <a href="{{ route('tasks.edit',$task->id) }}"
                                class="bg-yellow-300 p-2 rounded-lg hover:bg-yellow-400 transition">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    class="size-5">
                                    <path
                                        d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75 0 0 0 .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32L19.513 8.2Z" />
                                </svg>
                            </a>
                            <form action="{{ route('tasks.destroy',$task->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-400 p-2 rounded-lg hover:bg-red-500 transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                        class="size-5">
                                        <path fill-rule="evenodd"
                                            d="M16.5 4.478v.227a48.816 48.816 0 0 1 3.878.512.75.75 0 1 1-.256 1.478l-.209-.035-1.005 13.07a3 3 0 0 1-2.991 2.77H8.084a3 3 0 0 1-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 0 1-.256-1.478A48.567 48.567 0 0 1 7.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 0 1 3.369 0c1.603.051 2.815 1.387 2.815 2.951Zm-6.136-1.452a51.196 51.196 0 0 1 3.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 0 0-6 0v-.113c0-.794.609-1.428 1.364-1.452Zm-.355 5.945a.75.75 0 1 0-1.5.058l.347 9a.75.75 0 1 0 1.499-.058l-.346-9Zm5.48.058a.75.75 0 1 0-1.498-.058l-.347 9a.75.75 0 0 0 1.5.058l.345-9Z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </form>
                        </td>
                        @endcan
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- Tarefas em Mobile -->
        <div class="md:hidden flex flex-col gap-4">
            @foreach ($project->tasks as $task)
            <div>
                <span class="py-1 px-3 bg-gray-300 shadow w-fit text-s flex items-center gap-1 uppercase">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-4">
                        <path fill-rule="evenodd"
                            d="M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.751 20.105a8.25 8.25 0 0 1 16.498 0 .75.75 0 0 1-.437.695A18.683 18.683 0 0 1 12 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 0 1-.437-.695Z"
                            clip-rule="evenodd" />
                    </svg>
                    {{ $task->responsible->name }}
                </span>
                <div class="bg-gray-200 shadow-lg rounded-b-lg">

                    <div class="p-4 flex items-center justify-between gap-3 flex-wrap">
                        <h3 class="font-semibold">{{ $task->title }}</h3>
                        <span
                            class="p-1.5 text-xs font-bold uppercase tracking-wider rounded-lg bg-opacity-80 @if($task->status == "CONCLUIDO") bg-green-400 text-green-900 @else bg-yellow-200 text-yellow-900 @endif">{{
                            $task->status }}</span>
                    </div>

                    <div class="p-4 bg-white">
                        <p class="break-words">{{ $task->description }}</p>
                    </div>
                    @can('isAdmin','App\Models\User')
                    <div class="flex">
                        <a href="{{ route('tasks.edit',$task->id) }}"
                            class="bg-green-400 hover:bg-green-500 transition p-2 w-full text-center">Editar Tarefa</a>
                        <form action="{{ route('tasks.destroy',$task->id) }}" method="POST" class="flex w-full">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-400 p-2 hover:bg-red-500 transition w-full">
                                Excluir Tarefa
                            </button>
                        </form>
                    </div>
                    @endcan
                </div>
            </div>
            <hr class="border-2 border-gray-300">
            @endforeach
        </div>
        @else
            <h4 class="mt-3 text-center md:text-start">Nenhuma tarefa adicionada!</span>
        @endif
    </div>
</x-app-layout>
