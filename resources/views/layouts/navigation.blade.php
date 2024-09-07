<nav x-data="{ burguer: false }" class="bg-gray-600 shadow-lg relative">
    <div class="flex md:justify-around justify-center items-center">
        <div class="logo w-32">
            <a href="{{ route('home') }}">
                <img src="https://infotech-solucoes.com/novo/public/img/logo_infotech.png" alt="">
            </a>
        </div>
        <div class="md:hidden flex">
            <button type="button" @click="burguer = !burguer" class="text-white hover:text-gray-400">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-8">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                </svg>
            </button>
        </div>
        <div class="hidden md:flex gap-5 text-gray-100">
            <a href="{{ route('projects.index') }}" class="hover:text-gray-300 hover:border-b">Projetos</a>
            @auth
            <div x-data="{isOpen: false} " class="relative">
                <button type="button" @click="isOpen = !isOpen" @click.outside="isOpen = false"
                    class="nav-item flex gap-1 items-center hover:text-gray-300 hover:border-b">
                    {{ Auth::user()->name }}
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                        <path fill-rule="evenodd"
                            d="M12.53 16.28a.75.75 0 0 1-1.06 0l-7.5-7.5a.75.75 0 0 1 1.06-1.06L12 14.69l6.97-6.97a.75.75 0 1 1 1.06 1.06l-7.5 7.5Z"
                            clip-rule="evenodd" />
                    </svg>
                </button>
                <div class="dropdown absolute bg-white text-black w-full z-30 flex flex-col border top-9" x-cloak
                    x-show="isOpen" x-transition>

                    <a href="{{ route('dashboard') }}" class="p-2 hover:bg-gray-200">Painel de Admin</a>

                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="text-start p-2 hover:bg-gray-200 w-full">Sair</button>
                    </form>
                </div>
            </div>
            @else
            <a href="{{ route('login') }}" class="hover:text-gray-300 flex items-center gap-1">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15M12 9l3 3m0 0-3 3m3-3H2.25" />
                </svg>
                Entrar
            </a>
            @endauth
        </div>
    </div>
    <!-- Menu Mobile -->
    <div class="md:hidden flex flex-col text-gray-100 bg-gray-500 absolute w-full" x-cloak x-show="burguer" x-transition>
        <a href="{{ route('projects.index') }}" class="hover:text-gray-300 hover:bg-gray-400 w-full p-2">Projetos</a>
        @auth
        <a href="{{ route('dashboard') }}" class="hover:bg-gray-400 w-full p-2">Painel de Admin</a>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="text-start hover:bg-gray-400 w-full p-2">Sair</button>
        </form>
        @else
        <a href="{{ route('login') }}" class="hover:bg-gray-400 flex items-center gap-1 w-full p-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15M12 9l3 3m0 0-3 3m3-3H2.25" />
            </svg>
            Entrar
        </a>
        @endauth
    </div>
</nav>
