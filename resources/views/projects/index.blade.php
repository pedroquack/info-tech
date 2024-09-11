<x-app-layout>
    <div class="bg-gray-400 p-5 md:rounded-t-lg shadow-lg flex items-center justify-between">
        <h1 class="text-xl font-bold">Todos os projetos</h1>
        <a class="bg-green-400 py-2 px-6 rounded-lg shadow hover:bg-green-500 transition flex items-center justify-center gap-2" href="{{ route('projects.create') }}">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                <path fill-rule="evenodd"
                    d="M12 3.75a.75.75 0 0 1 .75.75v6.75h6.75a.75.75 0 0 1 0 1.5h-6.75v6.75a.75.75 0 0 1-1.5 0v-6.75H4.5a.75.75 0 0 1 0-1.5h6.75V4.5a.75.75 0 0 1 .75-.75Z"
                    clip-rule="evenodd" />
            </svg>
            Criar um Projeto
        </a>
    </div>
    <div class="bg-white p-5">
        <div class="flex flex-col gap-3">
            @if ($projects->count() > 0)
                @foreach ($projects as $p)
                <div>
                    <div class="flex md:flex-row flex-col justify-between items-center">
                        <h1 class="font-bold text-lg">{{ $p->title }}</h1>
                        <h2 class="font-bold">Cliente: <span class="font-normal text-sm">{{ $p->client->name }}</span></h2>
                    </div>
                    <p class="break-words my-2">{{ $p->description }}</p>
                    <div class="flex md:flex-row flex-col justify-between items-center">
                        <div class="font-bold">{{ $p->start_date->format('d/m/Y') }} - {{ $p->end_date->format('d/m/Y') }}
                        </div>
                        <a href="{{ route('projects.show', $p) }}"
                            class="font-bold shadow-md bg-green-300 md:w-fit w-full text-center py-2 px-8 rounded-md hover:bg-green-400 transition">Visualizar</a>
                    </div>
                </div>
                <hr class="border border-gray-300">
                @endforeach
            @else
                <h2 class="font-bold">Nenhum projeto encontrado...</h2>
            @endif
        </div>
    </div>
</x-app-layout>
