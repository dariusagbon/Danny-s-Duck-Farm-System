<nav x-data="{ open: false, settingsOpen: false }" class="bg-slate-950 text-slate-100 shadow-sm border-b border-slate-800">
    <div class="mx-auto flex h-16 max-w-7xl items-center justify-between px-4 sm:px-6 lg:px-8">
        <div class="flex items-center gap-4">
            <button @click="open = !open" class="inline-flex items-center justify-center rounded-xl border border-slate-700 bg-slate-900/90 p-2 text-slate-200 shadow-sm transition hover:bg-slate-800 sm:hidden">
                <span class="sr-only">Open sidebar</span>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M3 5h14a1 1 0 100-2H3a1 1 0 100 2zm14 4H3a1 1 0 000 2h14a1 1 0 100-2zm0 6H3a1 1 0 000 2h14a1 1 0 100-2z" clip-rule="evenodd" />
                </svg>
            </button>

            <a href="{{ route('dashboard') }}" class="flex items-center gap-3 text-base font-semibold text-slate-100">
                <x-application-logo class="block h-9 w-auto fill-current text-slate-100" />
                <span>Duck Farm MIS</span>
            </a>
        </div>

        <div class="flex items-center gap-3">
            <button type="button" @click="darkMode = !darkMode; localStorage.theme = darkMode ? 'dark' : 'light'; document.documentElement.classList.toggle('dark', darkMode);"
                class="inline-flex items-center gap-2 rounded-xl border border-slate-700 bg-slate-900/90 px-3 py-2 text-sm font-medium text-slate-200 transition hover:bg-slate-800">
                <svg x-show="!darkMode" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zM4.22 4.22a1 1 0 011.415 0l.707.707a1 1 0 11-1.414 1.414l-.708-.707a1 1 0 010-1.414zM17 9a1 1 0 110 2h-1a1 1 0 110-2h1zM5.64 15.36a1 1 0 011.414 0l.707.708a1 1 0 01-1.414 1.414l-.707-.707a1 1 0 010-1.415zM10 16a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1z" />
                </svg>
                <svg x-show="darkMode" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M17.293 13.293a8 8 0 11-10.586-10.586 1 1 0 00-1.416-1.416 10 10 0 1014.142 14.142 1 1 0 00-1.415-1.414z" />
                </svg>
                <span class="hidden sm:inline">Theme</span>
            </button>
        </div>
    </div>

    <div x-show="open" class="sm:hidden">
        <div class="space-y-1 border-t border-slate-800 bg-slate-950 px-4 py-4">
            <a href="{{ route('dashboard') }}" class="block rounded-xl px-3 py-2 text-sm text-slate-200 hover:bg-slate-800">Dashboard</a>
            <a href="{{ route('ducks.index') }}" class="block rounded-xl px-3 py-2 text-sm text-slate-200 hover:bg-slate-800">Duck Management</a>
            <a href="{{ route('eggs.index') }}" class="block rounded-xl px-3 py-2 text-sm text-slate-200 hover:bg-slate-800">Egg Management</a>
            <a href="{{ route('feeds.index') }}" class="block rounded-xl px-3 py-2 text-sm text-slate-200 hover:bg-slate-800">Feed Management</a>
            <a href="{{ route('sales.index') }}" class="block rounded-xl px-3 py-2 text-sm text-slate-200 hover:bg-slate-800">Sales</a>
            <a href="{{ route('inventory-logs.index') }}" class="block rounded-xl px-3 py-2 text-sm text-slate-200 hover:bg-slate-800">Inventory Logs</a>
            <div class="border-t border-slate-700 pt-2 mt-2">
                <span class="block px-3 py-1 text-xs font-semibold uppercase tracking-[0.16em] text-slate-400">Reports</span>
                <a href="{{ route('reports.daily.eggs') }}" class="block rounded-xl px-3 py-2 text-sm text-slate-200 hover:bg-slate-800">Daily Egg Production</a>
                <a href="{{ route('reports.daily.feeds') }}" class="block rounded-xl px-3 py-2 text-sm text-slate-200 hover:bg-slate-800">Daily Feed Consumption</a>
                <a href="{{ route('reports.sales') }}" class="block rounded-xl px-3 py-2 text-sm text-slate-200 hover:bg-slate-800">Sales Reports</a>
            </div>
            <a href="{{ route('users.index') }}" class="block rounded-xl px-3 py-2 text-sm text-slate-200 hover:bg-slate-800">User Management</a>
        </div>
    </div>
</nav>
