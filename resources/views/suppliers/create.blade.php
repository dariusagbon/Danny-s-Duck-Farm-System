<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-semibold tracking-tight text-slate-900 dark:text-slate-100">Add New Supplier</h2>
    </x-slot>

    <div class="py-6">
        <div class="mx-auto max-w-2xl px-4 sm:px-6 lg:px-8">
            <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900">
                <form action="{{ route('suppliers.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <div class="grid gap-6 md:grid-cols-2">
                        <div>
                            <label for="name" class="block text-sm font-semibold text-slate-700 dark:text-slate-200">Supplier Name *</label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}" required class="mt-2 block w-full rounded-3xl border border-slate-300 bg-slate-50 px-4 py-3 text-sm text-slate-900 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100">
                            @error('name')<span class="text-sm text-rose-600 dark:text-rose-400">{{ $message }}</span>@enderror
                        </div>

                        <div>
                            <label for="supplier_type" class="block text-sm font-semibold text-slate-700 dark:text-slate-200">Supplier Type *</label>
                            <input type="text" name="supplier_type" id="supplier_type" value="{{ old('supplier_type') }}" placeholder="e.g., Feed Supplier, Equipment" required class="mt-2 block w-full rounded-3xl border border-slate-300 bg-slate-50 px-4 py-3 text-sm text-slate-900 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100">
                            @error('supplier_type')<span class="text-sm text-rose-600 dark:text-rose-400">{{ $message }}</span>@enderror
                        </div>
                    </div>

                    <div class="grid gap-6 md:grid-cols-2">
                        <div>
                            <label for="contact_person" class="block text-sm font-semibold text-slate-700 dark:text-slate-200">Contact Person</label>
                            <input type="text" name="contact_person" id="contact_person" value="{{ old('contact_person') }}" class="mt-2 block w-full rounded-3xl border border-slate-300 bg-slate-50 px-4 py-3 text-sm text-slate-900 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100">
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-semibold text-slate-700 dark:text-slate-200">Email</label>
                            <input type="email" name="email" id="email" value="{{ old('email') }}" class="mt-2 block w-full rounded-3xl border border-slate-300 bg-slate-50 px-4 py-3 text-sm text-slate-900 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100">
                        </div>
                    </div>

                    <div class="grid gap-6 md:grid-cols-2">
                        <div>
                            <label for="phone" class="block text-sm font-semibold text-slate-700 dark:text-slate-200">Phone</label>
                            <input type="text" name="phone" id="phone" value="{{ old('phone') }}" class="mt-2 block w-full rounded-3xl border border-slate-300 bg-slate-50 px-4 py-3 text-sm text-slate-900 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100">
                        </div>
                    </div>

                    <div>
                        <label for="address" class="block text-sm font-semibold text-slate-700 dark:text-slate-200">Address</label>
                        <textarea name="address" id="address" rows="3" class="mt-2 block w-full rounded-3xl border border-slate-300 bg-slate-50 px-4 py-3 text-sm text-slate-900 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100">{{ old('address') }}</textarea>
                    </div>

                    <div>
                        <label for="notes" class="block text-sm font-semibold text-slate-700 dark:text-slate-200">Notes</label>
                        <textarea name="notes" id="notes" rows="3" class="mt-2 block w-full rounded-3xl border border-slate-300 bg-slate-50 px-4 py-3 text-sm text-slate-900 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100">{{ old('notes') }}</textarea>
                    </div>

                    <div class="flex gap-4">
                        <button type="submit" class="inline-flex items-center justify-center rounded-3xl bg-emerald-600 px-6 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-emerald-500">Save Supplier</button>
                        <a href="{{ route('suppliers.index') }}" class="inline-flex items-center justify-center rounded-3xl border border-slate-300 bg-white px-6 py-3 text-sm font-semibold text-slate-700 shadow-sm transition hover:bg-slate-50 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-200">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
