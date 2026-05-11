<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="text-2xl font-semibold tracking-tight text-slate-900 dark:text-slate-100">Sales Records</h2>
                <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Log each sale and monitor revenue, quantity, and transaction date.</p>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="grid gap-6 xl:grid-cols-[0.9fr_1.1fr]">
                <section class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900">
                    <h3 class="text-lg font-semibold text-slate-900 dark:text-slate-100">Record a Sale</h3>
                    <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">Capture sale details for inventory tracking and analytics.</p>

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

                    <form action="{{ route('sales.store') }}" method="POST" class="mt-6 space-y-4">
                        @csrf
                        <div class="grid gap-4 md:grid-cols-2">
                            <div>
                                <label for="egg_type" class="block text-sm font-semibold text-slate-700 dark:text-slate-200">Egg Type</label>
                                <input id="egg_type" name="egg_type" type="text" value="{{ old('egg_type') }}" class="mt-2 block w-full rounded-3xl border border-slate-300 bg-slate-50 px-4 py-3 text-sm text-slate-900 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100" required>
                            </div>
                            <div>
                                <label for="quantity" class="block text-sm font-semibold text-slate-700 dark:text-slate-200">Quantity Sold</label>
                                <input id="quantity" name="quantity" type="number" min="0" value="{{ old('quantity') }}" class="mt-2 block w-full rounded-3xl border border-slate-300 bg-slate-50 px-4 py-3 text-sm text-slate-900 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100" required>
                            </div>
                            <div>
                                <label for="unit_price" class="block text-sm font-semibold text-slate-700 dark:text-slate-200">Unit Price</label>
                                <input id="unit_price" name="unit_price" type="number" step="0.01" min="0" value="{{ old('unit_price') }}" class="mt-2 block w-full rounded-3xl border border-slate-300 bg-slate-50 px-4 py-3 text-sm text-slate-900 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100" required>
                            </div>
                            <div>
                                <label for="sold_at" class="block text-sm font-semibold text-slate-700 dark:text-slate-200">Sale Date</label>
                                <input id="sold_at" name="sold_at" type="date" value="{{ old('sold_at') }}" class="mt-2 block w-full rounded-3xl border border-slate-300 bg-slate-50 px-4 py-3 text-sm text-slate-900 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100" required>
                            </div>
                        </div>

                        <div class="grid gap-4 md:grid-cols-2">
                            <div>
                                <label for="customer_id" class="block text-sm font-semibold text-slate-700 dark:text-slate-200">Customer ID</label>
                                <input id="customer_id" name="customer_id" type="text" value="{{ old('customer_id') }}" class="mt-2 block w-full rounded-3xl border border-slate-300 bg-slate-50 px-4 py-3 text-sm text-slate-900 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100">
                            </div>
                            <div>
                                <label for="notes" class="block text-sm font-semibold text-slate-700 dark:text-slate-200">Notes</label>
                                <input id="notes" name="notes" type="text" value="{{ old('notes') }}" class="mt-2 block w-full rounded-3xl border border-slate-300 bg-slate-50 px-4 py-3 text-sm text-slate-900 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100">
                            </div>
                        </div>

                        <div class="flex justify-end">
                            <button type="submit" class="inline-flex items-center justify-center rounded-3xl bg-emerald-600 px-6 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-emerald-500">Save Sale</button>
                        </div>
                    </form>
                </section>

                <section class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900">
                    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                        <div>
                            <h3 class="text-lg font-semibold text-slate-900 dark:text-slate-100">Recent Sales</h3>
                            <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Search by egg type and review sales revenue at a glance.</p>
                        </div>
                        <form method="GET" action="{{ route('sales.index') }}" class="flex items-center gap-3">
                            <input type="search" name="search" placeholder="Search egg type" value="{{ $search ?? '' }}" class="rounded-full border border-slate-300 bg-slate-50 px-4 py-2 text-sm text-slate-900 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100">
                            <button type="submit" class="rounded-full bg-slate-950 px-4 py-2 text-sm font-semibold text-white transition hover:bg-slate-800">Search</button>
                        </form>
                    </div>

                    <div class="mt-6 overflow-x-auto">
                        <table class="min-w-full divide-y divide-slate-200 text-sm dark:divide-slate-800">
                            <thead class="bg-slate-50 uppercase tracking-[0.16em] text-slate-500 dark:bg-slate-950 dark:text-slate-400">
                                <tr>
                                    <th class="px-4 py-3 text-left">Type</th>
                                    <th class="px-4 py-3 text-left">Quantity</th>
                                    <th class="px-4 py-3 text-left">Unit Price</th>
                                    <th class="px-4 py-3 text-left">Total</th>
                                    <th class="px-4 py-3 text-left">Date</th>
                                    <th class="px-4 py-3 text-left">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-200 bg-white dark:divide-slate-800 dark:bg-slate-900">
                                @forelse($sales as $sale)
                                    <tr>
                                        <td class="px-4 py-4 text-slate-700 dark:text-slate-200">{{ $sale->egg_type }}</td>
                                        <td class="px-4 py-4 text-slate-700 dark:text-slate-200">{{ $sale->quantity }}</td>
                                        <td class="px-4 py-4 text-emerald-700 dark:text-emerald-300">{{ number_format($sale->unit_price, 2) }}</td>
                                        <td class="px-4 py-4 text-slate-700 dark:text-slate-200">{{ number_format($sale->quantity * $sale->unit_price, 2) }}</td>
                                        <td class="px-4 py-4 text-slate-700 dark:text-slate-200">{{ $sale->sold_at->format('M d, Y') }}</td>
                                        <td class="px-4 py-4 space-x-2">
                                            <a href="{{ route('sales.edit', $sale) }}" class="rounded-full bg-slate-950 px-3 py-1 text-sm font-semibold text-white transition hover:bg-slate-800">Edit</a>
                                            <form action="{{ route('sales.destroy', $sale) }}" method="POST" class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="rounded-full bg-rose-600 px-3 py-1 text-sm font-semibold text-white transition hover:bg-rose-500" onclick="return confirm('Delete this sale record?');">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-4 py-8 text-center text-slate-500 dark:text-slate-400">No sales records found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-6">
                        {{ $sales->links() }}
                    </div>
                </section>
            </div>
        </div>
    </div>
</x-app-layout>
