<x-app-layout>
    <form method="POST" action="{{ route('users.update', $user->id) }}" class="bg-white p-6 rounded-lg">
        @csrf
        @method('PUT')
        <input type="hidden" name="user_id" value="{{ $user->id }}">
        <div>
            <x-input-label for="name">Nome</x-input-label>
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{ $user->name }}" required
                autofocus />
            @error('name')
            <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <div class="mt-4">
            <x-input-label for="email">E-mail</x-input-label>
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" value="{{ $user->email }}"
                required />
            @error('email')
                <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <div class="mt-4">
            <x-input-label for="role">Cargo</x-input-label>
            <x-select name="role" class="block mt-1 w-full">
                <option value="CLIENTE" @if($user->role == 'CLIENTE') selected @endif>CLIENTE</option>
                <option value="ADMIN" @if($user->role == 'ADMIN') selected @endif>ADMINISTRADOR</option>
            </x-select>
        </div>
            <button class="mt-4 w-full bg-green-400 shadow py-2 px-4 rounded-lg hover:bg-green-500 transition" type="submit">EDITAR USUÁRIO</button>
    </form>
</x-app-layout>
