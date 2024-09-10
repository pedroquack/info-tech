<x-app-layout>
    <div class="bg-gray-400 p-5 md:rounded-t-lg shadow-lg">
        <h1 class="text-xl font-bold">Editar projeto</h1>
    </div>
    <form action="{{ route('projects.update', $project->id) }}" method="post" class="flex flex-col gap-3 bg-white p-5">
        @csrf
        @method('PUT')
        <input type="hidden" name="project_id" value="{{ $project->id }}">
        <div class="flex flex-col">
            <x-input-label for="title">Titulo*</x-input-label>
            <x-text-input name="title" id="title"
                value="{{ $project->title }}"></x-text-input>
            @error('title')
            <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>
        <div class="flex flex-col">
            <x-input-label for="description">Descrição*</x-input-label>
            <x-textarea name="description" id="description">{{ $project->description }}
            </x-textarea>
            @error('description')
            <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>
        <div class="flex md:flex-row flex-col gap-3">
            <div class="flex flex-col w-full">
                <x-input-label>Data de Início*</x-label>
                    <x-date-input name="start_date"
                        value="{{ $project->start_date->format('Y-m-d') }}"></x-date-input>
                    @error('start_date')
                    <span class="text-red-500">{{ $message }}</span>
                    @enderror
            </div>
            <div class="flex flex-col w-full">
                <x-input-label>Data de Término*</x-label>
                    <x-date-input name="end_date"
                        value="{{ $project->end_date->format('Y-m-d') }}"></x-date-input>
                    @error('end_date')
                    <span class="text-red-500">{{ $message }}</span>
                    @enderror
            </div>
        </div>
        <div class="flex flex-col w-full">
            <x-input-label>Cliente*</x-label>
                <x-select name="client">
                    @foreach ($clients as $c)
                    <option @if($c->id == $project->user_id) {{ "selected" }} @endif value="{{ $c->id }}" >{{ $c->name }}</option>
                    @endforeach
                </x-select>
                @error('client')
                <span class="text-red-500">{{ $message }}</span>
                @enderror
        </div>
        <button class="bg-green-400 p-2 rounded-md hover:bg-green-500 transition" type="submit">Editar</button>
    </form>
</x-app-layout>
