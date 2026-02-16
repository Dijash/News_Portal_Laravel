@extends('Layouts.adminApp')

@section('adminContent')
<main class="flex-1 px-6 py-8 space-y-6">
    <header class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold">Analytics</h1>
            <p class="text-sm text-gray-500">Snapshot of content and users</p>
        </div>
    </header>

    <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-white dark:bg-gray-900 rounded-xl shadow p-6">
            <p class="text-sm text-gray-500">Total News</p>
            <h3 class="text-3xl font-bold mt-2">{{ $totalNews ?? 0 }}</h3>
        </div>
        <div class="bg-white dark:bg-gray-900 rounded-xl shadow p-6">
            <p class="text-sm text-gray-500">Total Users</p>
            <h3 class="text-3xl font-bold mt-2">{{ $totalUsers ?? 0 }}</h3>
        </div>
        <div class="bg-white dark:bg-gray-900 rounded-xl shadow p-6">
            <p class="text-sm text-gray-500">Published News</p>
            <h3 class="text-3xl font-bold mt-2">{{ $publishedNews ?? 0 }}</h3>
        </div>
        <div class="bg-white dark:bg-gray-900 rounded-xl shadow p-6">
            <p class="text-sm text-gray-500">Active Users</p>
            <h3 class="text-3xl font-bold mt-2">{{ $activeUsers ?? 0 }}</h3>
        </div>
    </section>

    <section class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="bg-white dark:bg-gray-900 rounded-xl shadow p-6">
            <h3 class="text-lg font-bold mb-4">News Published Over Time</h3>
            <canvas id="newsChart" class="max-h-80"></canvas>
        </div>
        <div class="bg-white dark:bg-gray-900 rounded-xl shadow p-6">
            <h3 class="text-lg font-bold mb-4">User Growth Over Time</h3>
            <canvas id="userChart" class="max-h-80"></canvas>
        </div>
    </section>

    <section class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="bg-white dark:bg-gray-900 rounded-xl shadow p-6">
            <h3 class="text-lg font-bold mb-4">News by Category</h3>
            <canvas id="categoryChart" class="max-h-80"></canvas>
        </div>
        <div class="bg-white dark:bg-gray-900 rounded-xl shadow p-6">
            <h3 class="text-lg font-bold mb-4">News Status</h3>
            <canvas id="statusChart" class="max-h-80"></canvas>
        </div>
    </section>

    <section class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="bg-white dark:bg-gray-900 rounded-xl shadow p-6">
            <h3 class="text-lg font-bold mb-4">User Activity</h3>
            <canvas id="activityChart" class="max-h-80"></canvas>
        </div>
    </section>
</main>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', () => {
    const newsEl = document.getElementById('newsChart');
    if (newsEl) {
        new Chart(newsEl, {
            type: 'line',
            data: {
                labels: {!! json_encode($newsLabels ?? []) !!},
                datasets: [{
                    label: 'News Published',
                    data: {!! json_encode($newsData ?? []) !!},
                    borderColor: '#ef4444',
                    backgroundColor: 'rgba(239, 68, 68, 0.15)',
                    tension: 0.4,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: { legend: { display: true } }
            }
        });
    }

    const userEl = document.getElementById('userChart');
    if (userEl) {
        new Chart(userEl, {
            type: 'line',
            data: {
                labels: {!! json_encode($userLabels ?? []) !!},
                datasets: [{
                    label: 'User Growth',
                    data: {!! json_encode($userData ?? []) !!},
                    borderColor: '#3b82f6',
                    backgroundColor: 'rgba(59, 130, 246, 0.15)',
                    tension: 0.4,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: { legend: { display: true } }
            }
        });
    }

    const categoryEl = document.getElementById('categoryChart');
    if (categoryEl) {
        new Chart(categoryEl, {
            type: 'bar',
            data: {
                labels: {!! json_encode($categoryLabels ?? []) !!},
                datasets: [{
                    label: 'News Count',
                    data: {!! json_encode($categoryData ?? []) !!},
                    backgroundColor: '#f59e0b',
                    borderRadius: 8
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: { legend: { display: false } }
            }
        });
    }

    const statusEl = document.getElementById('statusChart');
    if (statusEl) {
        new Chart(statusEl, {
            type: 'doughnut',
            data: {
                labels: {!! json_encode($statusLabels ?? []) !!},
                datasets: [{
                    data: {!! json_encode($statusData ?? []) !!},
                    backgroundColor: ['#22c55e', '#f59e0b']
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: { legend: { position: 'bottom' } }
            }
        });
    }

    const activityEl = document.getElementById('activityChart');
    if (activityEl) {
        new Chart(activityEl, {
            type: 'doughnut',
            data: {
                labels: {!! json_encode($activityLabels ?? []) !!},
                datasets: [{
                    data: {!! json_encode($activityData ?? []) !!},
                    backgroundColor: ['#3b82f6', '#9ca3af']
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: { legend: { position: 'bottom' } }
            }
        });
    }
});
</script>
@endsection