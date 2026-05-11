<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-semibold tracking-tight text-slate-900 dark:text-slate-100">Record New Expense</h2>
    </x-slot>

    <div class="py-6">
        <div class="mx-auto max-w-2xl px-4 sm:px-6 lg:px-8">
            <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900">
                <form action="{{ route('expenses.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <div class="grid gap-6 md:grid-cols-2">
                        <div>
                            <label for="category" class="block text-sm font-semibold text-slate-700 dark:text-slate-200">Expense Category *</label>
                            <select name="category" id="category" required class="mt-2 block w-full rounded-3xl border border-slate-300 bg-slate-50 px-4 py-3 text-sm text-slate-900 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100">
                                <option value="">Select Category</option>
                                <option value="Feed" @selected(old('category') === 'Feed')>Feed</option>
                                <option value="Utilities" @selected(old('category') === 'Utilities')>Utilities</option>
                                <option value="Maintenance" @selected(old('category') === 'Maintenance')>Maintenance</option>
                                <option value="Medical" @selected(old('category') === 'Medical')>Medical</option>
                                <option value="Equipment" @selected(old('category') === 'Equipment')>Equipment</option>
                                <option value="Labor" @selected(old('category') === 'Labor')>Labor</option>
                                <option value="Other" @selected(old('category') === 'Other')>Other</option>
                            </select>
                            @error('category')<span class="text-sm text-rose-600 dark:text-rose-400">{{ $message }}</span>@enderror
                        </div>

                        <div>
                            <label for="amount" class="block text-sm font-semibold text-slate-700 dark:text-slate-200">Amount *</label>
                            <input type="number" step="0.01" name="amount" id="amount" value="{{ old('amount') }}" required class="mt-2 block w-full rounded-3xl border border-slate-300 bg-slate-50 px-4 py-3 text-sm text-slate-900 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100">
                            @error('amount')<span class="text-sm text-rose-600 dark:text-rose-400">{{ $message }}</span>@enderror
                        </div>
                    </div>

                    <div class="grid gap-6 md:grid-cols-2">
                        <div>
                            <label for="expense_date" class="block text-sm font-semibold text-slate-700 dark:text-slate-200">Date *</label>
                            <input type="date" name="expense_date" id="expense_date" value="{{ old('expense_date', now()->format('Y-m-d')) }}" required class="mt-2 block w-full rounded-3xl border border-slate-300 bg-slate-50 px-4 py-3 text-sm text-slate-900 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100">
                            @error('expense_date')<span class="text-sm text-rose-600 dark:text-rose-400">{{ $message }}</span>@enderror
                        </div>
                    </div>

                    <div>
                        <label for="description" class="block text-sm font-semibold text-slate-700 dark:text-slate-200">Description</label>
                        <textarea name="description" id="description" rows="3" class="mt-2 block w-full rounded-3xl border border-slate-300 bg-slate-50 px-4 py-3 text-sm text-slate-900 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100">{{ old('description') }}</textarea>
                    </div>

                    <div>
                        <label for="notes" class="block text-sm font-semibold text-slate-700 dark:text-slate-200">Notes</label>
                        <textarea name="notes" id="notes" rows="3" class="mt-2 block w-full rounded-3xl border border-slate-300 bg-slate-50 px-4 py-3 text-sm text-slate-900 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100">{{ old('notes') }}</textarea>
                    </div>

                    <div class="flex gap-4">
                        <button type="submit" class="inline-flex items-center justify-center rounded-3xl bg-emerald-600 px-6 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-emerald-500">Record Expense</button>
                        <a href="{{ route('expenses.index') }}" class="inline-flex items-center justify-center rounded-3xl border border-slate-300 bg-white px-6 py-3 text-sm font-semibold text-slate-700 shadow-sm transition hover:bg-slate-50 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-200">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
