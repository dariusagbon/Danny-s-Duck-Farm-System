<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="text-2xl font-semibold tracking-tight text-slate-900 dark:text-slate-100">Sales Reports</h2>
                <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Export monthly sales and financial summaries in PDF or Excel format.</p>
            </div>
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('reports.sales.pdf') }}" class="inline-flex items-center justify-center rounded-2xl bg-slate-950 px-4 py-2 text-sm font-semibold text-white transition hover:bg-slate-800">Download PDF</a>
                <a href="{{ route('reports.sales.excel') }}" class="inline-flex items-center justify-center rounded-2xl bg-emerald-600 px-4 py-2 text-sm font-semibold text-white transition hover:bg-emerald-500">Download Excel</a>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm dark:border-slate-800 dark:bg-slate-900">
                <div class="px-6 py-4 border-b border-slate-200 dark:border-slate-800">
                    <div class="flex flex-wrap items-center justify-between gap-3">
                        <h3 class="text-lg font-semibold text-slate-900 dark:text-slate-100">Sales records</h3>
                        <p class="text-sm text-slate-500 dark:text-slate-400">Showing the most recent 20 sales.</p>
                    </div>
                </div>

                <div class="p-6">
                    <div class="flow-root">
                        <div class="-mx-6 overflow-x-auto sm:-mx-0">
                            <table class="min-w-full divide-y divide-slate-200 text-sm dark:divide-slate-800">
                                <thead class="bg-slate-50 text-left text-xs uppercase tracking-[0.16em] text-slate-500 dark:bg-slate-950 dark:text-slate-400">
                                    <tr>
                                        <th class="px-6 py-3">Date</th>
                                        <th class="px-6 py-3">Customer</th>
                                        <th class="px-6 py-3">Eggs Sold</th>
                                        <th class="px-6 py-3">Gross</th>
                                        <th class="px-6 py-3">Expenses</th>
                                        <th class="px-6 py-3">Net Income</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-200 bg-white dark:divide-slate-800 dark:bg-slate-900">
                                    @forelse($sales as $sale)
                                        <tr>
                                            <td class="px-6 py-4 text-slate-700 dark:text-slate-200">{{ $sale->month_of->format('Y-m-d') }}</td>
                                            <td class="px-6 py-4 text-slate-700 dark:text-slate-200">{{ optional($sale->customer)->name ?? 'Walk-in' }}</td>
                                            <td class="px-6 py-4 text-slate-700 dark:text-slate-200">{{ number_format($sale->total_eggs_sold) }}</td>
                                            <td class="px-6 py-4 text-emerald-700 dark:text-emerald-300">{{ number_format($sale->gross_income, 2) }}</td>
                                            <td class="px-6 py-4 text-rose-700 dark:text-rose-300">{{ number_format($sale->total_expenses, 2) }}</td>
                                            <td class="px-6 py-4 text-slate-900 font-semibold dark:text-slate-100">{{ number_format($sale->net_income, 2) }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="px-6 py-8 text-center text-slate-500 dark:text-slate-400">No sales records found.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="mt-6">
                        {{ $sales->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
