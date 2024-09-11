<x-app-layout>
    <div class="bg-gray-400 p-5 md:rounded-t-lg shadow-lg">
        <h1 class="text-xl font-bold">Seus projetos</h1>
    </div>
    <div class="bg-white p-5">
        @if ($projects->count() > 0)
        <div class="flex flex-col gap-2">
            @foreach ($projects as $p)
            <div>
                <h1 class="font-bold text-lg">{{ $p->title }}</h1>
                <p class="break-words">{{ $p->description }}</p>
                <div class="flex md:flex-row flex-col justify-between items-center">
                    <div class="font-bold">{{ $p->start_date->format('d/m/Y') }} - {{ $p->end_date->format('d/m/Y') }}
                    </div>
                    <a href="{{ route('projects.show', $p) }}"
                        class="font-bold shadow-md bg-green-300 md:w-fit w-full text-center py-2 px-8 rounded-md hover:bg-green-400 transition">Visualizar</a>
                </div>
            </div>
            <hr class="border border-gray-300">
            @endforeach
        </div>
        @else
        <h2 class="font-bold">Nenhum projeto encontrado...</h2>
        @endif
    </div>
</x-app-layout>
