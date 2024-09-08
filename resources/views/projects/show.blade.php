<x-app-layout>
    <div class="bg-gray-100 p-5 rounded-t-lg">
            <div>
                <h1 class="text-xl font-bold">{{ $project->title }}</h1>
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
    <div class="bg-white p-5">
        <h2 class="text-lg font-bold">Tarefas</h2>
        @if($project->tasks->count() > 0)
            <table class="w-full">
                <thead class="bg-gray-100 border-b-2 border-gray-200">
                    <tr>
                        <th class="p-3 text-sm font-semibold tracking-wide text-left">Titulo</th>
                        <th class="p-3 text-sm font-semibold tracking-wide text-left">Descrição</th>
                        <th class="p-3 text-sm font-semibold tracking-wide text-left">Responsável</th>
                        <th class="p-3 text-sm font-semibold tracking-wide text-left w-48">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($project->tasks as $task)
                        <tr>
                            <td class="p-3 text-sm">{{ $task->title }}</td>
                            <td class="p-3 text-sm">{{ $task->description }}</td>
                            <td class="p-3 text-sm">{{ $task->responsible->name }}</td>
                            <td class="p-3 text-sm"><span class="p-2 text-xs font-bold uppercase tracking-wider rounded-lg bg-opacity-80 @if($task->status == "CONCLUIDO") bg-green-400 text-green-900 @else bg-yellow-200 text-yellow-900 @endif">{{ $task->status }}</span></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

    </div>
</x-app-layout>
