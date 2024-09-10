<x-app-layout>
    <div class="bg-gray-400 p-5 md:rounded-t-lg shadow-lg">
        <h1 class="text-xl font-bold">Todos os projetos</h1>
    </div>
    <div class="bg-white p-5">
        <div class="flex flex-col gap-3">
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
        </div>
    </div>
</x-app-layout>
