<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="text-2xl font-semibold tracking-tight text-slate-900 dark:text-slate-100">Daily Egg Production Reports</h2>
                <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">View and export daily egg production records with summaries.</p>
            </div>
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('reports.daily.eggs.pdf', ['date' => $date]) }}" class="inline-flex items-center justify-center rounded-2xl bg-slate-950 px-4 py-2 text-sm font-semibold text-white transition hover:bg-slate-800">Download PDF</a>
                <a href="{{ route('reports.daily.eggs.excel', ['date' => $date]) }}" class="inline-flex items-center justify-center rounded-2xl bg-emerald-600 px-4 py-2 text-sm font-semibold text-white transition hover:bg-emerald-500">Download Excel</a>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mb-6 rounded-3xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900">
                <form method="GET" action="{{ route('reports.daily.eggs') }}" class="flex items-center gap-3">
                    <label for="date" class="text-sm font-semibold text-slate-700 dark:text-slate-200">Select Date:</label>
                    <input type="date" name="date" id="date" value="{{ $date }}" class="rounded-3xl border border-slate-300 bg-slate-50 px-4 py-2 text-sm text-slate-900 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100">
                    <button type="submit" class="rounded-3xl bg-emerald-600 px-4 py-2 text-sm font-semibold text-white transition hover:bg-emerald-500">Filter</button>
                </form>
                <div class="mt-4">
                    <p class="text-lg font-semibold text-slate-900 dark:text-slate-100">Total Production on {{ \Carbon\Carbon::parse($date)->format('M d, Y') }}: {{ number_format($totalProduction) }} eggs</p>
                </div>
            </div>

            <div class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm dark:border-slate-800 dark:bg-slate-900">
                <div class="px-6 py-4 border-b border-slate-200 dark:border-slate-800">
                    <div class="flex flex-wrap items-center justify-between gap-3">
                        <h3 class="text-lg font-semibold text-slate-900 dark:text-slate-100">Egg Production Records</h3>
                        <p class="text-sm text-slate-500 dark:text-slate-400">Records for the selected date.</p>
                    </div>
                </div>

                <div class="p-6">
                    <div class="flow-root">
                        <div class="-mx-6 overflow-x-auto sm:-mx-0">
                            <table class="min-w-full divide-y divide-slate-200 text-sm dark:divide-slate-800">
                                <thead class="bg-slate-50 text-left text-xs uppercase tracking-[0.16em] text-slate-500 dark:bg-slate-950 dark:text-slate-400">
                                    <tr>
                                        <th class="px-6 py-3">Date</th>
                                        <th class="px-6 py-3">Egg Type</th>
                                        <th class="px-6 py-3">Quantity</th>
                                        <th class="px-6 py-3">Price</th>
                                        <th class="px-6 py-3">Current Stock</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-200 bg-white dark:divide-slate-800 dark:bg-slate-900">
                                    @forelse($eggs as $egg)
                                        <tr>
                                            <td class="px-6 py-4 text-slate-700 dark:text-slate-200">{{ $egg->date->format('Y-m-d') }}</td>
                                            <td class="px-6 py-4 text-slate-700 dark:text-slate-200">{{ $egg->egg_type }}</td>
                                            <td class="px-6 py-4 text-slate-700 dark:text-slate-200">{{ number_format($egg->quantity) }}</td>
                                            <td class="px-6 py-4 text-slate-700 dark:text-slate-200">{{ number_format($egg->price, 2) }}</td>
                                            <td class="px-6 py-4 text-slate-700 dark:text-slate-200">{{ number_format($egg->current_stock) }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="px-6 py-8 text-center text-slate-500 dark:text-slate-400">No egg production records found for this date.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="mt-6">
                        {{ $eggs->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>