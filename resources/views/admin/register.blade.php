<x-app-layout>
    <div class="bg-white md:w-2/3 w-full p-6 rounded-lg flex flex-col m-auto">
        <h1 class="font-bold text-xl mb-4 md:text-start text-center">Cadastar usuário</h1>
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div>
                <x-input-label for="name">Nome</x-input-label>
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{ old('name') }}" required
                    autofocus />
                @error('name')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <div class="mt-4">
                <x-input-label for="email">E-mail</x-input-label>
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" value="{{ old('email') }}"
                    required />
                @error('email')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <div class="mt-4">
                <x-input-label for="password">Senha</x-input-label>

                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required />

                @error('password')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <div class="mt-4">
                <x-input-label for="password_confirmation">Confirmação de Senha</x-input-label>

                <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                    name="password_confirmation" required autocomplete="new-password" />

                @error('password_confirmation')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <div class="mt-4">
                <x-input-label for="role">Cargo</x-input-label>
                <x-select name="role" class="block mt-1 w-full">
                    <option value="CLIENTE" selected>CLIENTE</option>
                    <option value="ADMIN">ADMINISTRADOR</option>
                </x-select>
            </div>
                <button class="mt-4 w-full bg-green-400 shadow py-2 px-4 rounded-lg hover:bg-green-500 transition" type="submit">CADASTRAR</button>
        </form>
    </div>
</x-app-layout>
