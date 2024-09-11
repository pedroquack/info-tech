<x-app-layout>
    <div class="bg-gray-400 p-6 md:rounded-t-lg">
        <div class="flex md:flex-row flex-col-reverse justify-between items-center">
            <div class="flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                    <path fill-rule="evenodd" d="M8.25 6.75a3.75 3.75 0 1 1 7.5 0 3.75 3.75 0 0 1-7.5 0ZM15.75 9.75a3 3 0 1 1 6 0 3 3 0 0 1-6 0ZM2.25 9.75a3 3 0 1 1 6 0 3 3 0 0 1-6 0ZM6.31 15.117A6.745 6.745 0 0 1 12 12a6.745 6.745 0 0 1 6.709 7.498.75.75 0 0 1-.372.568A12.696 12.696 0 0 1 12 21.75c-2.305 0-4.47-.612-6.337-1.684a.75.75 0 0 1-.372-.568 6.787 6.787 0 0 1 1.019-4.38Z" clip-rule="evenodd" />
                    <path d="M5.082 14.254a8.287 8.287 0 0 0-1.308 5.135 9.687 9.687 0 0 1-1.764-.44l-.115-.04a.563.563 0 0 1-.373-.487l-.01-.121a3.75 3.75 0 0 1 3.57-4.047ZM20.226 19.389a8.287 8.287 0 0 0-1.308-5.135 3.75 3.75 0 0 1 3.57 4.047l-.01.121a.563.563 0 0 1-.373.486l-.115.04c-.567.2-1.156.349-1.764.441Z" />
                  </svg>
                <h1 class="font-bold text-lg">Usuários cadastrados</h1>
            </div>
            <a class="bg-green-400 py-2 px-6 rounded-lg shadow hover:bg-green-500 transition flex items-center justify-center gap-2" href="{{ route('users.create') }}">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                    <path fill-rule="evenodd"
                        d="M12 3.75a.75.75 0 0 1 .75.75v6.75h6.75a.75.75 0 0 1 0 1.5h-6.75v6.75a.75.75 0 0 1-1.5 0v-6.75H4.5a.75.75 0 0 1 0-1.5h6.75V4.5a.75.75 0 0 1 .75-.75Z"
                        clip-rule="evenodd" />
                </svg>
                Registrar Usuário
            </a>
        </div>
    </div>
    <div class="bg-white p-6">
        <!-- Tabela de Tarefas em Desktop -->
        <div class="overflow-auto rounded-lg shadow">
            <table class="w-full">
                <thead class="bg-gray-100 border-b-2 border-gray-200">
                    <tr>
                        <th class="p-3 text-sm font-semibold tracking-wide text-left">Id</th>
                        <th class="p-3 text-sm font-semibold tracking-wide text-left">Nome</th>
                        <th class="p-3 text-sm font-semibold tracking-wide text-left">E-Mail</th>
                        <th class="p-3 text-sm font-semibold tracking-wide text-left">Cargo</th>
                        <th class="p-3 text-sm font-semibold tracking-wide text-left">Ações</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($users as $user)
                    <tr>
                        <td class="p-3 text-sm whitespace-nowrap uppercase">{{ $user->id }}</td>
                        <td class="p-3 text-sm whitespace-nowrap uppercase">{{ $user->name }}</td>
                        <td class="p-3 text-sm whitespace-nowrap">{{ $user->email }}</td>
                        <td class="p-3 text-sm whitespace-nowrap">
                            <span
                                class="p-2 text-xs font-bold uppercase tracking-wider rounded-lg bg-opacity-80 @if($user->role == "ADMIN") bg-red-400 text-red-900 @else bg-green-200 text-green-900 @endif">{{
                                $user->role }}
                            </span>
                        </td>
                        <td class="p-3 text-sm font-semibold tracking-wide text-left flex gap-3">
                            <a href="{{ route('users.edit',$user->id) }}"
                                class="bg-yellow-300 p-2 rounded-lg hover:bg-yellow-400 transition">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                    class="size-5">
                                    <path
                                        d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75 0 0 0 .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32L19.513 8.2Z" />
                                </svg>
                            </a>
                            <form action="{{ route('users.destroy',$user->id) }}" method="post">
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
                    </tr>
                    @endforeach
                </tbody>
            </table>
    </div>
</x-app-layout>
