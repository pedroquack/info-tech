<x-app-layout>
    <form method="POST" action="{{ route('login') }}" class="bg-white p-6 rounded-lg">
        @csrf
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
            <button class="mt-4 w-full bg-green-400 shadow py-2 px-4 rounded-lg hover:bg-green-500 transition" type="submit">ENTRAR</button>
    </form>
</x-app-layout>
