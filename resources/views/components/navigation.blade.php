<header class="bg-slate-900">
    <nav class="max-w-7xl mx-auto flex items-center justify-between px-2 py-3">
        <span class="text-sm font-semibold tracking-wide text-white">
                <h3>
                    Welcome,
                     {{ auth()->user()->username }} :  {{ auth()->user()->role }}
                </h3>
        </span>

        @auth
            <div class="flex items-center gap-3">

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button
                        type="submit"
                        class="rounded-full border border-slate-600 px-4 py-1 text-sm text-slate-200
                               hover:bg-slate-800 hover:border-slate-500 transition"
                    >
                        Izrakstīties
                    </button>
                </form>
            </div>
        @else
            <span class="text-sm text-slate-400">
                Guest
            </span>
        @endauth
    </nav>
</header>
