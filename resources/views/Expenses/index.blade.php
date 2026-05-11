<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="text-2xl font-semibold tracking-tight text-slate-900 dark:text-slate-100">Expenses</h2>
                <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Track and manage farm operational expenses.</p>
            </div>
            <a href="{{ route('expenses.create') }}" class="inline-flex items-center justify-center rounded-3xl bg-emerald-600 px-6 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-emerald-500">+ Record Expense</a>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900">
                @if (session('success'))
                    <div class="mb-4 rounded-3xl bg-emerald-50 p-4 text-sm text-emerald-700 dark:bg-emerald-950 dark:text-emerald-200">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <h3 class="text-lg font-semibold text-slate-900 dark:text-slate-100">Expense Records</h3>
                        <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Search and manage all expenses.</p>
                    </div>
                    <form method="GET" action="{{ route('expenses.index') }}" class="flex items-center gap-3">
                        <input type="search" name="search" placeholder="Search by category" value="{{ $search ?? '' }}" class="rounded-full border border-slate-300 bg-slate-50 px-4 py-2 text-sm text-slate-900 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100">
                        <button type="submit" class="rounded-full bg-slate-950 px-4 py-2 text-sm font-semibold text-white transition hover:bg-slate-800">Search</button>
                    </form>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-200 text-sm dark:divide-slate-800">
                        <thead class="bg-slate-50 uppercase tracking-[0.16em] text-slate-500 dark:bg-slate-950 dark:text-slate-400">
                            <tr>
                                <th class="px-4 py-3 text-left">Category</th>
                                <th class="px-4 py-3 text-left">Description</th>
                                <th class="px-4 py-3 text-left">Amount</th>
                                <th class="px-4 py-3 text-left">Date</th>
                                <th class="px-4 py-3 text-left">Recorded By</th>
                                <th class="px-4 py-3 text-left">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-200 bg-white dark:divide-slate-800 dark:bg-slate-900">
                            @forelse($expenses as $expense)
                                <tr>
                                    <td class="px-4 py-4 text-slate-700 dark:text-slate-200">
                                        <span class="rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold capitalize text-slate-700 dark:bg-slate-800 dark:text-slate-300">{{ $expense->category }}</span>
                                    </td>
                                    <td class="px-4 py-4 text-slate-700 dark:text-slate-200">{{ Str::limit($expense->description, 40) ?? '-' }}</td>
                                    <td class="px-4 py-4 text-rose-700 dark:text-rose-300 font-semibold">{{ number_format($expense->amount, 2) }}</td>
                                    <td class="px-4 py-4 text-slate-700 dark:text-slate-200">{{ $expense->expense_date->format('M d, Y') }}</td>
                                    <td class="px-4 py-4 text-slate-700 dark:text-slate-200">{{ $expense->user->name }}</td>
                                    <td class="px-4 py-4 space-x-2">
                                        <a href="{{ route('expenses.edit', $expense) }}" class="rounded-full bg-slate-950 px-3 py-1 text-sm font-semibold text-white transition hover:bg-slate-800">Edit</a>
                                        <form action="{{ route('expenses.destroy', $expense) }}" method="POST" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="rounded-full bg-rose-600 px-3 py-1 text-sm font-semibold text-white transition hover:bg-rose-500" onclick="return confirm('Delete this expense?');">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-4 py-8 text-center text-slate-500 dark:text-slate-400">No expenses found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-6">
                    {{ $expenses->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
