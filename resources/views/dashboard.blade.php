<x-app-layout>
    <x-slot name="header">
        <div class="grid gap-5 xl:grid-cols-[1.5fr_1fr]">
            <div>
                <h2 class="text-3xl font-semibold tracking-tight text-slate-900 dark:text-slate-100">Duck Farm Operations</h2>
                <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">A clean control panel for managing ducks, feed, production, and reports.</p>
                <div class="mt-4 flex flex-wrap gap-3">
                    <a href="{{ url('/') }}" class="inline-flex items-center rounded-3xl border border-slate-200 bg-slate-950 px-4 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-slate-800">Back to Landing Page</a>
                </div>
                <div class="mt-6 grid gap-3 sm:grid-cols-2 xl:grid-cols-3">
                    <a href="{{ route('ducks.create') }}" class="group rounded-3xl border border-slate-200 bg-white p-5 shadow-sm transition hover:-translate-y-0.5 hover:border-emerald-300 hover:bg-emerald-50 dark:border-slate-800 dark:bg-slate-950 dark:hover:border-emerald-500 dark:hover:bg-emerald-950/40">
                        <p class="text-sm font-semibold text-slate-900 dark:text-white">Add Duck</p>
                        <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">Register duck details and hatch date.</p>
                    </a>
                    <a href="{{ route('feeds.create') }}" class="group rounded-3xl border border-slate-200 bg-white p-5 shadow-sm transition hover:-translate-y-0.5 hover:border-emerald-300 hover:bg-emerald-50 dark:border-slate-800 dark:bg-slate-950 dark:hover:border-emerald-500 dark:hover:bg-emerald-950/40">
                        <p class="text-sm font-semibold text-slate-900 dark:text-white">Add Feed</p>
                        <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">Log new feed entries and consumption.</p>
                    </a>
                    <a href="{{ route('eggs.create') }}" class="group rounded-3xl border border-slate-200 bg-white p-5 shadow-sm transition hover:-translate-y-0.5 hover:border-emerald-300 hover:bg-emerald-50 dark:border-slate-800 dark:bg-slate-950 dark:hover:border-emerald-500 dark:hover:bg-emerald-950/40">
                        <p class="text-sm font-semibold text-slate-900 dark:text-white">Add Egg</p>
                        <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">Record daily egg production instantly.</p>
                    </a>
                    <a href="{{ route('reports.daily.eggs') }}" class="group rounded-3xl border border-slate-200 bg-white p-5 shadow-sm transition hover:-translate-y-0.5 hover:border-cyan-300 hover:bg-cyan-50 dark:border-slate-800 dark:bg-slate-950 dark:hover:border-cyan-500 dark:hover:bg-cyan-950/40">
                        <p class="text-sm font-semibold text-slate-900 dark:text-white">Egg Reports</p>
                        <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">Filter production data by date.</p>
                    </a>
                    <a href="{{ route('reports.daily.feeds') }}" class="group rounded-3xl border border-slate-200 bg-white p-5 shadow-sm transition hover:-translate-y-0.5 hover:border-cyan-300 hover:bg-cyan-50 dark:border-slate-800 dark:bg-slate-950 dark:hover:border-cyan-500 dark:hover:bg-cyan-950/40">
                        <p class="text-sm font-semibold text-slate-900 dark:text-white">Feed Reports</p>
                        <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">Track daily feed use per farm activity.</p>
                    </a>
                    <a href="{{ route('reports.sales') }}" class="group rounded-3xl border border-slate-200 bg-white p-5 shadow-sm transition hover:-translate-y-0.5 hover:border-emerald-300 hover:bg-emerald-50 dark:border-slate-800 dark:bg-slate-950 dark:hover:border-emerald-500 dark:hover:bg-emerald-950/40">
                        <p class="text-sm font-semibold text-slate-900 dark:text-white">Sales Reports</p>
                        <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">Open financial and order reports.</p>
                    </a>
                </div>
            </div>
            <div class="rounded-3xl border border-slate-200 bg-gradient-to-br from-emerald-500 to-cyan-500 p-6 text-white shadow-xl shadow-emerald-500/10 dark:border-transparent">
                <p class="text-sm font-semibold uppercase tracking-[0.24em] text-white/80">Farm Health</p>
                <h3 class="mt-4 text-3xl font-semibold">Quick insights</h3>
                <p class="mt-3 text-sm leading-6 text-white/90">Use this dashboard to quickly access core farm tasks and see the day's most important production summaries.</p>
                <div class="mt-8 grid gap-4 text-white">
                    <div class="rounded-3xl bg-white/10 p-4 backdrop-blur-sm">
                        <p class="text-sm text-white/80">Today’s Egg Production</p>
                        <p class="mt-2 text-2xl font-semibold">{{ number_format($dailyEggProduction) }}</p>
                    </div>
                    <div class="rounded-3xl bg-white/10 p-4 backdrop-blur-sm">
                        <p class="text-sm text-white/80">Today’s Feed Consumption</p>
                        <p class="mt-2 text-2xl font-semibold">{{ number_format($dailyFeedConsumption, 2) }} kg</p>
                    </div>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="mx-auto grid max-w-7xl gap-6 px-4 sm:px-6 lg:px-8 xl:grid-cols-4">
            <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900">
                <p class="text-sm font-semibold uppercase tracking-[0.16em] text-slate-500 dark:text-slate-400">Total Ducks</p>
                <p class="mt-4 text-3xl font-semibold text-slate-900 dark:text-slate-100">{{ number_format($totalDucks) }}</p>
                <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">Total ducks in the farm.</p>
            </div>
            <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900">
                <p class="text-sm font-semibold uppercase tracking-[0.16em] text-slate-500 dark:text-slate-400">Active Ducks</p>
                <p class="mt-4 text-3xl font-semibold text-slate-900 dark:text-slate-100">{{ number_format($activeDucks) }}</p>
                <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">Currently active ducks.</p>
            </div>
            <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900">
                <p class="text-sm font-semibold uppercase tracking-[0.16em] text-slate-500 dark:text-slate-400">Total Egg Production</p>
                <p class="mt-4 text-3xl font-semibold text-slate-900 dark:text-slate-100">{{ number_format($totalEggProduction) }}</p>
                <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">Egg batches created since launch.</p>
            </div>
            <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900">
                <p class="text-sm font-semibold uppercase tracking-[0.16em] text-slate-500 dark:text-slate-400">Feed Inventory</p>
                <p class="mt-4 text-3xl font-semibold text-slate-900 dark:text-slate-100">{{ number_format($totalFeedStock, 2) }}</p>
                <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">Total feed stock available across all supplies.</p>
            </div>
        </div>

        <div class="mx-auto mt-6 grid max-w-7xl gap-6 px-4 sm:px-6 lg:px-8 xl:grid-cols-2">
            <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900">
                <p class="text-sm font-semibold uppercase tracking-[0.16em] text-slate-500 dark:text-slate-400">Today's Egg Production</p>
                <p class="mt-4 text-3xl font-semibold text-slate-900 dark:text-slate-100">{{ number_format($dailyEggProduction) }}</p>
                <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">Total eggs recorded today.</p>
            </div>
            <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900">
                <p class="text-sm font-semibold uppercase tracking-[0.16em] text-slate-500 dark:text-slate-400">Today's Feed Consumption</p>
                <p class="mt-4 text-3xl font-semibold text-slate-900 dark:text-slate-100">{{ number_format($dailyFeedConsumption, 2) }}</p>
                <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">Kilograms of feed consumed today.</p>
            </div>
        </div>

        <div class="mx-auto mt-6 grid max-w-7xl gap-6 px-4 sm:px-6 lg:px-8 xl:grid-cols-[1.4fr_0.6fr]">
            <section class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900">
                <div class="flex items-center justify-between gap-4">
                    <div>
                        <h3 class="text-lg font-semibold text-slate-900 dark:text-slate-100">Sales Trend</h3>
                        <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">Net income progress for the last six months.</p>
                    </div>
                    <span class="rounded-full bg-emerald-100 px-3 py-1 text-sm font-semibold text-emerald-700 dark:bg-emerald-900/20 dark:text-emerald-300">{{ number_format($netIncome, 2) }} NET</span>
                </div>
                <div id="sales-trend-chart" class="mt-6 h-[320px]"></div>
            </section>

            <aside class="space-y-6">
                <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900">
                    <div class="flex items-center justify-between gap-3">
                        <div>
                            <p class="text-sm font-semibold uppercase tracking-[0.16em] text-slate-500 dark:text-slate-400">Performance</p>
                            <p class="mt-2 text-3xl font-semibold text-slate-900 dark:text-slate-100">{{ number_format($dailySales, 2) }}</p>
                        </div>
                        <div class="inline-flex items-center rounded-full bg-slate-100 px-3 py-1 text-sm text-slate-700 dark:bg-slate-800 dark:text-slate-200">Today</div>
                    </div>
                    <p class="mt-4 text-sm text-slate-500 dark:text-slate-400">Daily net sales from processed orders.</p>
                </div>

                <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900">
                    <p class="text-sm font-semibold uppercase tracking-[0.16em] text-slate-500 dark:text-slate-400">Low Stock Alerts</p>
                    <div class="mt-4 grid gap-3">
                        <div class="rounded-3xl bg-slate-50 p-4 dark:bg-slate-950">
                            <div class="flex items-center justify-between gap-2 text-sm text-slate-700 dark:text-slate-300">
                                <span>Egg items at risk</span>
                                <strong>{{ $lowStockEggs }}</strong>
                            </div>
                        </div>
                        <div class="rounded-3xl bg-slate-50 p-4 dark:bg-slate-950">
                            <div class="flex items-center justify-between gap-2 text-sm text-slate-700 dark:text-slate-300">
                                <span>Feed items at risk</span>
                                <strong>{{ $lowStockFeeds }}</strong>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900">
                    <p class="text-sm font-semibold uppercase tracking-[0.16em] text-slate-500 dark:text-slate-400">Notifications</p>
                    <div class="mt-4 space-y-3">
                        @forelse($recentNotifications as $notification)
                            <div class="rounded-2xl border border-slate-200 p-4 dark:border-slate-800 dark:bg-slate-950">
                                <p class="text-sm font-semibold text-slate-900 dark:text-slate-100">{{ $notification->title }}</p>
                                <p class="mt-1 text-sm text-slate-500 dark:text-slate-400">{{ \Illuminate\Support\Str::limit($notification->message, 80) }}</p>
                                <p class="mt-2 text-xs text-slate-400">{{ $notification->created_at->diffForHumans() }}</p>
                            </div>
                        @empty
                            <p class="text-sm text-slate-500 dark:text-slate-400">No active notifications yet.</p>
                        @endforelse
                    </div>
                </div>
            </aside>
        </div>

        <div class="mx-auto mt-6 max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900">
                <h3 class="text-lg font-semibold text-slate-900 dark:text-slate-100">Low Stock Breakdown</h3>
                <div class="mt-4 space-y-3">
                    @forelse($lowStockItems as $item)
                        <div class="flex items-center justify-between gap-4 rounded-3xl border border-slate-200 bg-slate-50 p-4 dark:border-slate-800 dark:bg-slate-950">
                            <div>
                                <p class="font-semibold text-slate-900 dark:text-slate-100">{{ $item['label'] }}</p>
                                <p class="text-sm text-slate-500 dark:text-slate-400">Min stock: {{ number_format($item['min_stock_level'], 2) }}</p>
                            </div>
                            <span class="rounded-full bg-rose-100 px-3 py-1 text-sm font-semibold text-rose-700 dark:bg-rose-900/20 dark:text-rose-300">Current: {{ number_format($item['current_stock'], 2) }}</span>
                        </div>
                    @empty
                        <p class="text-sm text-slate-500 dark:text-slate-400">Inventory is healthy. No low stock items.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const options = {
                    chart: {
                        type: 'area',
                        height: 320,
                        toolbar: { show: false },
                        animations: { enabled: true },
                    },
                    stroke: {
                        curve: 'smooth',
                        width: 3,
                    },
                    series: [{
                        name: 'Net Income',
                        data: @json($salesTrend),
                    }],
                    xaxis: {
                        categories: @json($salesTrendLabels),
                        labels: {
                            style: { colors: '#94a3b8' }
                        }
                    },
                    yaxis: {
                        labels: {
                            formatter: (value) => '$' + value.toFixed(0),
                            style: { colors: '#94a3b8' }
                        }
                    },
                    fill: {
                        opacity: 0.25,
                        gradient: { shade: 'light', type: 'vertical', opacityFrom: 0.4, opacityTo: 0.05 }
                    },
                    tooltip: {
                        y: {
                            formatter: (value) => '$' + parseFloat(value).toFixed(2)
                        }
                    },
                    grid: { strokeDashArray: 4, borderColor: '#0f172a33' },
                    colors: ['#10b981'],
                };

                new ApexCharts(document.querySelector('#sales-trend-chart'), options).render();
            });
        </script>
    @endpush
</x-app-layout>
