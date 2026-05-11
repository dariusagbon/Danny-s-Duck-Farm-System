<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="text-2xl font-semibold tracking-tight text-slate-900 dark:text-slate-100">Feed Management</h2>
                <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Capture feed inventory, suppliers, and current stock levels with low-stock insights.</p>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid gap-6 xl:grid-cols-[0.9fr_1.1fr]">
                <section class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900">
                    <h3 class="text-lg font-semibold text-slate-900 dark:text-slate-100">Add Feed Supply</h3>
                    <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">Track feed pricing, quantity, and reorder triggers.</p>

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

                    <form action="{{ route('feeds.store') }}" method="POST" class="mt-6 space-y-4">
                        @csrf
                        <div class="grid gap-4 md:grid-cols-2">
                            <div>
                                <label for="name" class="block text-sm font-semibold text-slate-700 dark:text-slate-200">Feed Name</label>
                                <input id="name" name="name" type="text" value="{{ old('name') }}" class="mt-2 block w-full rounded-3xl border border-slate-300 bg-slate-50 px-4 py-3 text-sm text-slate-900 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100" required>
                            </div>
                            <div>
                                <label for="price" class="block text-sm font-semibold text-slate-700 dark:text-slate-200">Unit Price</label>
                                <input id="price" name="price" type="number" step="0.01" min="0" value="{{ old('price') }}" class="mt-2 block w-full rounded-3xl border border-slate-300 bg-slate-50 px-4 py-3 text-sm text-slate-900 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100" required>
                            </div>
                            <div>
                                <label for="current_stock" class="block text-sm font-semibold text-slate-700 dark:text-slate-200">Current Stock</label>
                                <input id="current_stock" name="current_stock" type="number" step="0.01" min="0" value="{{ old('current_stock') }}" class="mt-2 block w-full rounded-3xl border border-slate-300 bg-slate-50 px-4 py-3 text-sm text-slate-900 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100">
                            </div>
                            <div>
                                <label for="min_stock_level" class="block text-sm font-semibold text-slate-700 dark:text-slate-200">Reorder Threshold</label>
                                <input id="min_stock_level" name="min_stock_level" type="number" step="0.01" min="0" value="{{ old('min_stock_level', 5) }}" class="mt-2 block w-full rounded-3xl border border-slate-300 bg-slate-50 px-4 py-3 text-sm text-slate-900 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100">
                            </div>
                        </div>

                        <div>
                            <label for="unit" class="block text-sm font-semibold text-slate-700 dark:text-slate-200">Unit</label>
                            <input id="unit" name="unit" type="text" value="{{ old('unit', 'kg') }}" class="mt-2 block w-full rounded-3xl border border-slate-300 bg-slate-50 px-4 py-3 text-sm text-slate-900 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100">
                        </div>

                        <div>
                            <label for="description" class="block text-sm font-semibold text-slate-700 dark:text-slate-200">Description</label>
                            <textarea id="description" name="description" rows="4" class="mt-2 block w-full rounded-3xl border border-slate-300 bg-slate-50 px-4 py-3 text-sm text-slate-900 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100">{{ old('description') }}</textarea>
                        </div>

                        <div class="flex justify-end">
                            <button type="submit" class="inline-flex items-center justify-center rounded-3xl bg-emerald-600 px-6 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-emerald-500">Save Feed</button>
                        </div>
                    </form>
                </section>

                <section class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900">
                    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                        <div>
                            <h3 class="text-lg font-semibold text-slate-900 dark:text-slate-100">Feed Supplies</h3>
                            <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Search your feed inventory and monitor low stock levels.</p>
                        </div>
                        <form method="GET" action="{{ route('feeds.index') }}" class="flex items-center gap-3">
                            <input type="search" name="search" placeholder="Search feed name" value="{{ $search ?? '' }}" class="rounded-full border border-slate-300 bg-slate-50 px-4 py-2 text-sm text-slate-900 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100">
                            <button type="submit" class="rounded-full bg-slate-950 px-4 py-2 text-sm font-semibold text-white transition hover:bg-slate-800">Search</button>
                        </form>
                    </div>

                    <div class="mt-6 overflow-x-auto">
                        <table class="min-w-full divide-y divide-slate-200 text-sm dark:divide-slate-800">
                            <thead class="bg-slate-50 uppercase tracking-[0.16em] text-slate-500 dark:bg-slate-950 dark:text-slate-400">
                                <tr>
                                    <th class="px-4 py-3 text-left">Name</th>
                                    <th class="px-4 py-3 text-left">Stock</th>
                                    <th class="px-4 py-3 text-left">Unit</th>
                                    <th class="px-4 py-3 text-left">Price</th>
                                    <th class="px-4 py-3 text-left">Status</th>
                                    <th class="px-4 py-3 text-left">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-200 bg-white dark:divide-slate-800 dark:bg-slate-900">
                                @forelse($feeds as $feed)
                                    <tr>
                                        <td class="px-4 py-4 text-slate-700 dark:text-slate-200">{{ $feed->name }}</td>
                                        <td class="px-4 py-4 text-slate-700 dark:text-slate-200">{{ number_format($feed->current_stock, 2) }}</td>
                                        <td class="px-4 py-4 text-slate-700 dark:text-slate-200">{{ $feed->unit }}</td>
                                        <td class="px-4 py-4 text-emerald-700 dark:text-emerald-300">{{ number_format($feed->price, 2) }}</td>
                                        <td class="px-4 py-4 text-slate-700 dark:text-slate-200">
                                            @if($feed->current_stock <= $feed->min_stock_level)
                                                <span class="inline-flex rounded-full bg-rose-100 px-3 py-1 text-xs font-semibold text-rose-700 dark:bg-rose-900/20 dark:text-rose-300">Low stock</span>
                                            @else
                                                <span class="inline-flex rounded-full bg-emerald-100 px-3 py-1 text-xs font-semibold text-emerald-700 dark:bg-emerald-900/20 dark:text-emerald-300">Healthy</span>
                                            @endif
                                        </td>
                                        <td class="px-4 py-4 space-x-2">
                                            <a href="{{ route('feeds.edit', $feed) }}" class="rounded-full bg-slate-950 px-3 py-1 text-sm font-semibold text-white transition hover:bg-slate-800">Edit</a>
                                            <form action="{{ route('feeds.destroy', $feed) }}" method="POST" class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="rounded-full bg-rose-600 px-3 py-1 text-sm font-semibold text-white transition hover:bg-rose-500" onclick="return confirm('Delete this feed record?');">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-4 py-8 text-center text-slate-500 dark:text-slate-400">No feed supplies found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-6">
                        {{ $feeds->links() }}
                    </div>
                </section>
            </div>
        </div>
    </div>
</x-app-layout>