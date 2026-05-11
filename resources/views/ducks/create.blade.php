<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-semibold tracking-tight text-slate-900 dark:text-slate-100">Add New Duck</h2>
    </x-slot>

    <div class="py-6">
        <div class="mx-auto max-w-2xl px-4 sm:px-6 lg:px-8">
            <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900">
                <form action="{{ route('ducks.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <div class="grid gap-6 md:grid-cols-2">
                        <div>
                            <label for="name" class="block text-sm font-semibold text-slate-700 dark:text-slate-200">Duck Name *</label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}" required class="mt-2 block w-full rounded-3xl border border-slate-300 bg-slate-50 px-4 py-3 text-sm text-slate-900 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100">
                            @error('name')<span class="text-sm text-rose-600 dark:text-rose-400">{{ $message }}</span>@enderror
                        </div>

                        <div>
                            <label for="age" class="block text-sm font-semibold text-slate-700 dark:text-slate-200">Age (weeks) *</label>
                            <input type="number" name="age" id="age" value="{{ old('age') }}" required min="0" class="mt-2 block w-full rounded-3xl border border-slate-300 bg-slate-50 px-4 py-3 text-sm text-slate-900 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100">
                            @error('age')<span class="text-sm text-rose-600 dark:text-rose-400">{{ $message }}</span>@enderror
                        </div>
                    </div>

                    <div class="grid gap-6 md:grid-cols-2">
                        <div>
                            <label for="breed" class="block text-sm font-semibold text-slate-700 dark:text-slate-200">Breed</label>
                            <input type="text" name="breed" id="breed" value="{{ old('breed') }}" class="mt-2 block w-full rounded-3xl border border-slate-300 bg-slate-50 px-4 py-3 text-sm text-slate-900 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100">
                            @error('breed')<span class="text-sm text-rose-600 dark:text-rose-400">{{ $message }}</span>@enderror
                        </div>

                        <div>
                            <label for="hatch_date" class="block text-sm font-semibold text-slate-700 dark:text-slate-200">Hatch Date *</label>
                            <input type="date" name="hatch_date" id="hatch_date" value="{{ old('hatch_date') }}" required max="{{ date('Y-m-d') }}" class="mt-2 block w-full rounded-3xl border border-slate-300 bg-slate-50 px-4 py-3 text-sm text-slate-900 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100">
                            @error('hatch_date')<span class="text-sm text-rose-600 dark:text-rose-400">{{ $message }}</span>@enderror
                        </div>
                    </div>

                    <div>
                        <label for="status" class="block text-sm font-semibold text-slate-700 dark:text-slate-200">Status *</label>
                        <select name="status" id="status" required class="mt-2 block w-full rounded-3xl border border-slate-300 bg-slate-50 px-4 py-3 text-sm text-slate-900 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100">
                            <option value="active" @selected(old('status', 'active') === 'active')>Active</option>
                            <option value="sold" @selected(old('status') === 'sold')>Sold</option>
                            <option value="deceased" @selected(old('status') === 'deceased')>Deceased</option>
                        </select>
                        @error('status')<span class="text-sm text-rose-600 dark:text-rose-400">{{ $message }}</span>@enderror
                    </div>

                    <div class="flex justify-end gap-3">
                        <a href="{{ route('ducks.index') }}" class="rounded-3xl border border-slate-300 bg-white px-6 py-3 text-sm font-semibold text-slate-700 shadow-sm transition hover:bg-slate-50 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-200 dark:hover:bg-slate-800">Cancel</a>
                        <button type="submit" class="rounded-3xl bg-emerald-600 px-6 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-emerald-500">Add Duck</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>