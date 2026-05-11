<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="text-2xl font-semibold tracking-tight text-slate-900 dark:text-slate-100">Edit Feed Supply</h2>
                <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Update feed details, stock levels, and reorder settings.</p>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">
            <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900">
                @if ($errors->any())
                    <div class="mb-4 rounded-3xl bg-rose-50 p-4 text-sm text-rose-700 dark:bg-rose-950 dark:text-rose-200">
                        <ul class="list-disc pl-5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('feeds.update', $feed) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div class="grid gap-4 md:grid-cols-2">
                        <div>
                            <label for="name" class="block text-sm font-semibold text-slate-700 dark:text-slate-200">Feed Name</label>
                            <input id="name" name="name" type="text" value="{{ old('name', $feed->name) }}" class="mt-2 block w-full rounded-3xl border border-slate-300 bg-slate-50 px-4 py-3 text-sm text-slate-900 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100" required>
                        </div>
                        <div>
                            <label for="price" class="block text-sm font-semibold text-slate-700 dark:text-slate-200">Unit Price</label>
                            <input id="price" name="price" type="number" step="0.01" min="0" value="{{ old('price', $feed->price) }}" class="mt-2 block w-full rounded-3xl border border-slate-300 bg-slate-50 px-4 py-3 text-sm text-slate-900 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100" required>
                        </div>
                        <div>
                            <label for="current_stock" class="block text-sm font-semibold text-slate-700 dark:text-slate-200">Current Stock</label>
                            <input id="current_stock" name="current_stock" type="number" step="0.01" min="0" value="{{ old('current_stock', $feed->current_stock) }}" class="mt-2 block w-full rounded-3xl border border-slate-300 bg-slate-50 px-4 py-3 text-sm text-slate-900 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100">
                        </div>
                        <div>
                            <label for="min_stock_level" class="block text-sm font-semibold text-slate-700 dark:text-slate-200">Reorder Threshold</label>
                            <input id="min_stock_level" name="min_stock_level" type="number" step="0.01" min="0" value="{{ old('min_stock_level', $feed->min_stock_level) }}" class="mt-2 block w-full rounded-3xl border border-slate-300 bg-slate-50 px-4 py-3 text-sm text-slate-900 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100">
                        </div>
                    </div>

                    <div>
                        <label for="unit" class="block text-sm font-semibold text-slate-700 dark:text-slate-200">Unit</label>
                        <input id="unit" name="unit" type="text" value="{{ old('unit', $feed->unit) }}" class="mt-2 block w-full rounded-3xl border border-slate-300 bg-slate-50 px-4 py-3 text-sm text-slate-900 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100">
                    </div>

                    <div>
                        <label for="description" class="block text-sm font-semibold text-slate-700 dark:text-slate-200">Description</label>
                        <textarea id="description" name="description" rows="4" class="mt-2 block w-full rounded-3xl border border-slate-300 bg-slate-50 px-4 py-3 text-sm text-slate-900 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100">{{ old('description', $feed->description) }}</textarea>
                    </div>

                    <div class="flex flex-col gap-3 sm:flex-row sm:justify-between">
                        <a href="{{ route('feeds.index') }}" class="inline-flex items-center justify-center rounded-3xl border border-slate-300 px-5 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50 dark:border-slate-700 dark:text-slate-200 dark:hover:bg-slate-800">Cancel</a>
                        <button type="submit" class="inline-flex items-center justify-center rounded-3xl bg-emerald-600 px-6 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-emerald-500">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
