<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="text-2xl font-semibold tracking-tight text-slate-900 dark:text-slate-100">Egg Inventory</h2>
                <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Create new production entries and manage egg stock with low-stock alerts.</p>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid gap-6 xl:grid-cols-[0.9fr_1.1fr]">
                <section class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900">
                    <h3 class="text-lg font-semibold text-slate-900 dark:text-slate-100">Add New Egg Batch</h3>
                    <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">Track production, pricing, and current stock in one place.</p>

                    @if (session('success'))
                        <div class="mt-4 rounded-3xl bg-emerald-50 p-4 text-sm text-emerald-700 dark:bg-emerald-950 dark:text-emerald-200">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="mt-4 rounded-3xl bg-rose-50 p-4 text-sm text-rose-700 dark:bg-rose-950 dark:text-rose-200">
                            <ul class="list-disc pl-5">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('eggs.store') }}" method="POST" class="mt-6 space-y-4">
                        @csrf
                        <div class="grid gap-4 md:grid-cols-2">
                            <div>
                                <label for="egg_type" class="block text-sm font-semibold text-slate-700 dark:text-slate-200">Egg Type</label>
                                <select name="egg_type" id="egg_type" class="mt-2 block w-full rounded-3xl border border-slate-300 bg-slate-50 px-4 py-3 text-sm text-slate-900 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100">
                                    <option value="">Select Egg Type</option>
                                    <option value="Normal" @selected(old('egg_type') === 'Normal')>Normal</option>
                                    <option value="Cracked" @selected(old('egg_type') === 'Cracked')>Cracked</option>
                                    <option value="Small" @selected(old('egg_type') === 'Small')>Small</option>
                                </select>
                            </div>
                            <div>
                                <label for="quantity" class="block text-sm font-semibold text-slate-700 dark:text-slate-200">Trays Produced</label>
                                <input id="quantity" name="quantity" type="number" min="0" value="{{ old('quantity') }}" class="mt-2 block w-full rounded-3xl border border-slate-300 bg-slate-50 px-4 py-3 text-sm text-slate-900 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100" required>
                            </div>
                            <div>
                                <label for="price" class="block text-sm font-semibold text-slate-700 dark:text-slate-200">Price per Tray</label>
                                <input id="price" name="price" type="number" step="0.01" min="0" value="{{ old('price') }}" class="mt-2 block w-full rounded-3xl border border-slate-300 bg-slate-50 px-4 py-3 text-sm text-slate-900 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100" required>
                            </div>
                            <div>
                                <label for="date" class="block text-sm font-semibold text-slate-700 dark:text-slate-200">Delivery Date</label>
                                <input id="date" name="date" type="date" value="{{ old('date') }}" class="mt-2 block w-full rounded-3xl border border-slate-300 bg-slate-50 px-4 py-3 text-sm text-slate-900 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100" required>
                            </div>
                        </div>

                        <div class="grid gap-4 md:grid-cols-2">
                            <div>
                                <label for="current_stock" class="block text-sm font-semibold text-slate-700 dark:text-slate-200">Current Stock</label>
                                <input id="current_stock" name="current_stock" type="number" min="0" value="{{ old('current_stock') }}" class="mt-2 block w-full rounded-3xl border border-slate-300 bg-slate-50 px-4 py-3 text-sm text-slate-900 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100">
                            </div>
                            <div>
                                <label for="min_stock_level" class="block text-sm font-semibold text-slate-700 dark:text-slate-200">Low Stock Threshold</label>
                                <input id="min_stock_level" name="min_stock_level" type="number" min="0" value="{{ old('min_stock_level', 10) }}" class="mt-2 block w-full rounded-3xl border border-slate-300 bg-slate-50 px-4 py-3 text-sm text-slate-900 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100">
                            </div>
                        </div>

                        <div class="flex justify-end">
                            <button type="submit" class="inline-flex items-center justify-center rounded-3xl bg-emerald-600 px-6 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-emerald-500">Save Batch</button>
                        </div>
                    </form>
                </section>

                <section class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900">
                    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                        <div>
                            <h3 class="text-lg font-semibold text-slate-900 dark:text-slate-100">Egg Records</h3>
                            <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Search production history and monitor stock movements.</p>
                        </div>
                        <form method="GET" action="{{ route('eggs.index') }}" class="flex items-center gap-3">
                            <input type="search" name="search" placeholder="Search egg type" value="{{ $search ?? '' }}" class="rounded-full border border-slate-300 bg-slate-50 px-4 py-2 text-sm text-slate-900 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100">
                            <button type="submit" class="rounded-full bg-slate-950 px-4 py-2 text-sm font-semibold text-white transition hover:bg-slate-800">Search</button>
                        </form>
                    </div>

                    <div class="mt-6 overflow-x-auto">
                        <table class="min-w-full divide-y divide-slate-200 text-sm dark:divide-slate-800">
                            <thead class="bg-slate-50 uppercase tracking-[0.16em] text-slate-500 dark:bg-slate-950 dark:text-slate-400">
                                <tr>
                                    <th class="px-4 py-3 text-left">Type</th>
                                    <th class="px-4 py-3 text-left">Stock</th>
                                    <th class="px-4 py-3 text-left">Threshold</th>
                                    <th class="px-4 py-3 text-left">Price</th>
                                    <th class="px-4 py-3 text-left">Date</th>
                                    <th class="px-4 py-3 text-left">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-200 bg-white dark:divide-slate-800 dark:bg-slate-900">
                                @forelse($eggs as $egg)
                                    <tr>
                                        <td class="px-4 py-4 text-slate-700 dark:text-slate-200">{{ $egg->egg_type }}</td>
                                        <td class="px-4 py-4 text-slate-700 dark:text-slate-200">{{ $egg->current_stock }}</td>
                                        <td class="px-4 py-4 text-slate-700 dark:text-slate-200">{{ $egg->min_stock_level }}</td>
                                        <td class="px-4 py-4 text-emerald-700 dark:text-emerald-300">{{ number_format($egg->price, 2) }}</td>
                                        <td class="px-4 py-4 text-slate-700 dark:text-slate-200">{{ $egg->date->format('M d, Y') }}</td>
                                        <td class="px-4 py-4 space-x-2">
                                            <a href="{{ route('eggs.edit', $egg) }}" class="rounded-full bg-slate-950 px-3 py-1 text-sm font-semibold text-white transition hover:bg-slate-800">Edit</a>
                                            <form action="{{ route('eggs.destroy', $egg) }}" method="POST" class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="rounded-full bg-rose-600 px-3 py-1 text-sm font-semibold text-white transition hover:bg-rose-500" onclick="return confirm('Delete this egg record?');">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-4 py-8 text-center text-slate-500 dark:text-slate-400">No egg records found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-6">
                        {{ $eggs->links() }}
                    </div>
                </section>
            </div>
        </div>
    </div>
</x-app-layout>
