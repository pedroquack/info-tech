@if(session()->has('success') || session()->has('error'))
<div class="fixed bg-black flex flex-col items-center bg-opacity-30 top-0 left-0 w-full h-full p-16" x-cloak
    x-data="{message: true}" x-show="message">
    <div class="bg-white w-fit p-4 flex items-center justify-center gap-3 rounded-lg @if(session()->get('success')) text-green-400 @else text-red-400 @endif "
        x-cloak x-show="message" x-transition @click.outside="message = false">
        @if (session()->get('success'))
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-12">
            <path fill-rule="evenodd"
                d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12Zm13.36-1.814a.75.75 0 1 0-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 0 0-1.06 1.06l2.25 2.25a.75.75 0 0 0 1.14-.094l3.75-5.25Z"
                clip-rule="evenodd" />
        </svg>
        @else
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-12">
            <path fill-rule="evenodd"
                d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12ZM12 8.25a.75.75 0 0 1 .75.75v3.75a.75.75 0 0 1-1.5 0V9a.75.75 0 0 1 .75-.75Zm0 8.25a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z"
                clip-rule="evenodd" />
        </svg>
        @endif
        <span class="text-black font-bold text-xl">@if(session()->get('success')) {{ session()->get('success') }} @else
            {{ session()->get('error') }} @endif</span>
    </div>
</div>
@endif
