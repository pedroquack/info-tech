<x-app-layout>
    <div class="bg-gray-400 p-5 md:rounded-t-lg shadow-lg">
        <h1 class="text-xl font-bold">Criar uma tarefa</h1>
    </div>
    <form action="{{ route('tasks.store') }}" method="post" class="flex flex-col gap-3 bg-white p-5">
        @csrf
        <input type="hidden" name="project_id" value="{{ $project->id }}">
        <div class="flex flex-col">
            <x-input-label for="title">Titulo*</x-input-label>
            <x-text-input name="title" id="title"
                value="{{ old('title') }}"></x-text-input>
            @error('title')
            <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>
        <div class="flex flex-col">
            <x-input-label for="description">Descrição*</x-input-label>
            <x-textarea name="description" id="description">{{
                old('description') }}
            </x-textarea>
            @error('description')
            <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>
        <div class="flex flex-col w-full">
            <x-input-label>Responsavel*</x-label>
                <x-select name="responsible_id">
                    <option value="" selected>Selecione um responsável</option>
                    @foreach ($admins as $adm)
                    <option value="{{ $adm->id }}">{{ $adm->name }}</option>
                    @endforeach
                </x-select>
                @error('responsible_id')
                <span class="text-red-500">{{ $message }}</span>
                @enderror
        </div>
        <button class="bg-green-400 p-2 rounded-md hover:bg-green-500 transition" type="submit">Criar</button>
    </form>
</x-app-layout>
