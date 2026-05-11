<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="text-2xl font-semibold tracking-tight text-slate-900 dark:text-slate-100">Inventory Logs</h2>
                <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Track stock movements and adjustments in real time.</p>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm dark:border-slate-800 dark:bg-slate-900">
                <div class="px-6 py-4 border-b border-slate-200 dark:border-slate-800">
                    <h3 class="text-lg font-semibold text-slate-900 dark:text-slate-100">Movement History</h3>
                </div>
                <div class="p-6">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-slate-200 text-sm dark:divide-slate-800">
                            <thead class="bg-slate-50 text-left uppercase tracking-[0.16em] text-slate-500 dark:bg-slate-950 dark:text-slate-400">
                                <tr>
                                    <th class="px-6 py-3">Date</th>
                                    <th class="px-6 py-3">Item</th>
                                    <th class="px-6 py-3">Action</th>
                                    <th class="px-6 py-3">Change</th>
                                    <th class="px-6 py-3">Before</th>
                                    <th class="px-6 py-3">After</th>
                                    <th class="px-6 py-3">User</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-200 bg-white dark:divide-slate-800 dark:bg-slate-900">
                                @forelse($logs as $log)
                                    <tr>
                                        <td class="px-6 py-4 text-slate-700 dark:text-slate-200">{{ $log->created_at->format('Y-m-d H:i') }}</td>
                                        <td class="px-6 py-4 text-slate-700 dark:text-slate-200">{{ class_basename($log->item_type) }} #{{ $log->item_id }}</td>
                                        <td class="px-6 py-4 text-slate-700 dark:text-slate-200">{{ ucfirst($log->action) }}</td>
                                        <td class="px-6 py-4 text-rose-700 dark:text-rose-300">{{ number_format($log->quantity_change, 2) }}</td>
                                        <td class="px-6 py-4 text-slate-700 dark:text-slate-200">{{ number_format($log->quantity_before, 2) }}</td>
                                        <td class="px-6 py-4 text-slate-700 dark:text-slate-200">{{ number_format($log->quantity_after, 2) }}</td>
                                        <td class="px-6 py-4 text-slate-700 dark:text-slate-200">{{ optional($log->user)->name ?? 'System' }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="px-6 py-8 text-center text-slate-500 dark:text-slate-400">No inventory movements recorded yet.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-6">
                        {{ $logs->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
