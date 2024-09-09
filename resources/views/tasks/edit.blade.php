<x-app-layout>
    <div class="bg-gray-400 p-5 md:rounded-t-lg shadow-lg">
        <h1 class="text-xl font-bold">Criar uma tarefa</h1>
    </div>
    <form action="{{ route('tasks.update',$task->id) }}" method="post" class="flex flex-col gap-3 bg-white p-5">
        @csrf
        @method('PUT')
        <input type="hidden" name="task_id" value="{{ $task->id }}">
        <div class="flex flex-col">
            <x-input-label for="title">Titulo*</x-input-label>
            <x-text-input name="title" id="title"
                value="{{$task->title}}"></x-text-input>
            @error('title')
            <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>
        <div class="flex flex-col">
            <x-input-label for="description">Descrição*</x-input-label>
            <x-textarea name="description" id="description">{{$task->description}}
            </x-textarea>
            @error('description')
            <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>
        <div class="flex md:flex-row flex-col gap-3">
            @can('isResponsible', $task)
                <div class="flex flex-col w-full">
                    <x-input-label>Status*</x-label>
                        <x-select name="status">
                            <option value="EM ANDAMENTO" @if($task->status == "EM ANDAMENTO") selected @endif>EM ANDAMENTO</option>
                            <option value="CONCLUIDO" @if($task->status == "CONCLUIDO") selected @endif>CONCLUIDO</option>
                        </x-select>
                    @error('client')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
            @endcan
            <div class="flex flex-col w-full">
                <x-input-label>Responsavel*</x-label>
                    <x-select name="responsible">
                        @foreach ($admins as $adm)
                        <option value="{{ $adm->id }}" @if($task->responsible === $adm->id) selected @endif>{{ $adm->name }}</option>
                        @endforeach
                    </x-select>
                    @error('client')
                    <span class="text-red-500">{{ $message }}</span>
                    @enderror
            </div>
        </div>
        <button class="bg-green-400 p-2 rounded-md hover:bg-green-500 transition" type="submit">Editar</button>
    </form>
</x-app-layout>
