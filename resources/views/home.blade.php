<x-app-layout>
    <div class="bg-gray-400 p-5 md:rounded-t-lg shadow-lg">
        <h1 class="text-xl font-bold">Seus projetos</h1>
    </div>
    <div class="bg-white p-5">
        <div class="flex flex-col gap-2">
            @foreach ($projects as $p)
            <h1 class="font-bold text-lg">{{ $p->title }}</h1>
            <p class="break-words">{{ $p->description }}</p>
            <div class="flex md:flex-row flex-col justify-between items-center">
                <div class="font-bold">{{ $p->start_date->format('d/m/Y') }} - {{ $p->end_date->format('d/m/Y') }}</div>
                <a href="{{ route('projects.show', $p) }}" class="font-bold shadow-md bg-gray-400 md:w-fit w-full text-center py-2 px-8 rounded-md hover:bg-gray-500 transition">Visualizar</a>
            </div>
            <hr>
            @endforeach
        </div>
    </div>
</x-app-layout>
