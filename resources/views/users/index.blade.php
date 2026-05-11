<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="text-2xl font-semibold tracking-tight text-slate-900 dark:text-slate-100">User Management</h2>
                <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">Manage user roles and access levels across the farm platform.</p>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm dark:border-slate-800 dark:bg-slate-900">
                <div class="px-6 py-4 border-b border-slate-200 dark:border-slate-800">
                    <h3 class="text-lg font-semibold text-slate-900 dark:text-slate-100">Active Users</h3>
                </div>
                <div class="p-6">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-slate-200 text-sm dark:divide-slate-800">
                            <thead class="bg-slate-50 text-left uppercase tracking-[0.16em] text-slate-500 dark:bg-slate-950 dark:text-slate-400">
                                <tr>
                                    <th class="px-6 py-3">Name</th>
                                    <th class="px-6 py-3">Email</th>
                                    <th class="px-6 py-3">Role</th>
                                    <th class="px-6 py-3">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-200 bg-white dark:divide-slate-800 dark:bg-slate-900">
                                @foreach($users as $user)
                                    <tr>
                                        <td class="px-6 py-4 text-slate-700 dark:text-slate-200">{{ $user->name }}</td>
                                        <td class="px-6 py-4 text-slate-700 dark:text-slate-200">{{ $user->email }}</td>
                                        <td class="px-6 py-4 text-slate-700 dark:text-slate-200">{{ $user->roles->pluck('name')->join(', ') ?: 'None' }}</td>
                                        <td class="px-6 py-4 text-slate-700 dark:text-slate-200">
                                            <form action="{{ route('users.role.update', $user) }}" method="POST" class="flex flex-wrap gap-2 sm:items-center">
                                                @csrf
                                                @method('PATCH')
                                                <select name="role" class="rounded-2xl border border-slate-300 bg-slate-50 px-3 py-2 text-sm text-slate-900 dark:border-slate-700 dark:bg-slate-950 dark:text-slate-100">
                                                    @foreach($roles as $role)
                                                        <option value="{{ $role }}" @selected($user->hasRole($role))>{{ $role }}</option>
                                                    @endforeach
                                                </select>
                                                <button type="submit" class="rounded-2xl bg-emerald-600 px-4 py-2 text-sm font-semibold text-white transition hover:bg-emerald-500">Update</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-6">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
