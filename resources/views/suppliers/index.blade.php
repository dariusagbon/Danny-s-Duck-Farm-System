<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="text-2xl font-semibold tracking-tight text-slate-900 dark:text-slate-100">Suppliers</h2>
                <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Manage supplier profiles and contact information.</p>
            </div>
            <a href="{{ route('suppliers.create') }}" class="inline-flex items-center justify-center rounded-3xl bg-emerald-600 px-6 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-emerald-500">+ New Supplier</a>
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
                        <h3 class="text-lg font-semibold text-slate-900 dark:text-slate-100">Supplier Directory</h3>
                        <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Search and manage all suppliers.</p>
                    </div>
                    <form method="GET" action="{{ route('suppliers.index') }}" class="flex items-center gap-3">
                        <input type="search" name="search" placeholder="Search by name" value="{{ $search ?? '' }}" class="rounded-full border border-slate-300 bg-slate-50 px-4 py-2 text-sm text-slate-900 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100">
                        <button type="submit" class="rounded-full bg-slate-950 px-4 py-2 text-sm font-semibold text-white transition hover:bg-slate-800">Search</button>
                    </form>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-200 text-sm dark:divide-slate-800">
                        <thead class="bg-slate-50 uppercase tracking-[0.16em] text-slate-500 dark:bg-slate-950 dark:text-slate-400">
                            <tr>
                                <th class="px-4 py-3 text-left">Name</th>
                                <th class="px-4 py-3 text-left">Type</th>
                                <th class="px-4 py-3 text-left">Contact</th>
                                <th class="px-4 py-3 text-left">Phone</th>
                                <th class="px-4 py-3 text-left">Email</th>
                                <th class="px-4 py-3 text-left">Status</th>
                                <th class="px-4 py-3 text-left">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-200 bg-white dark:divide-slate-800 dark:bg-slate-900">
                            @forelse($suppliers as $supplier)
                                <tr>
                                    <td class="px-4 py-4 text-slate-700 dark:text-slate-200">{{ $supplier->name }}</td>
                                    <td class="px-4 py-4 text-slate-700 dark:text-slate-200">
                                        <span class="rounded-full bg-slate-100 px-3 py-1 text-xs font-semibold capitalize text-slate-700 dark:bg-slate-800 dark:text-slate-300">{{ $supplier->supplier_type }}</span>
                                    </td>
                                    <td class="px-4 py-4 text-slate-700 dark:text-slate-200">{{ $supplier->contact_person ?? '-' }}</td>
                                    <td class="px-4 py-4 text-slate-700 dark:text-slate-200">{{ $supplier->phone ?? '-' }}</td>
                                    <td class="px-4 py-4 text-slate-700 dark:text-slate-200">{{ $supplier->email ?? '-' }}</td>
                                    <td class="px-4 py-4">
                                        <span class="rounded-full px-3 py-1 text-xs font-semibold @if($supplier->active) bg-emerald-100 text-emerald-700 dark:bg-emerald-950 dark:text-emerald-300 @else bg-slate-100 text-slate-700 dark:bg-slate-800 dark:text-slate-300 @endif">
                                            {{ $supplier->active ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-4 space-x-2">
                                        <a href="{{ route('suppliers.edit', $supplier) }}" class="rounded-full bg-slate-950 px-3 py-1 text-sm font-semibold text-white transition hover:bg-slate-800">Edit</a>
                                        <form action="{{ route('suppliers.destroy', $supplier) }}" method="POST" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="rounded-full bg-rose-600 px-3 py-1 text-sm font-semibold text-white transition hover:bg-rose-500" onclick="return confirm('Delete this supplier?');">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="px-4 py-8 text-center text-slate-500 dark:text-slate-400">No suppliers found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-6">
                    {{ $suppliers->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
