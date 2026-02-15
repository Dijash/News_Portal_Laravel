@extends('Layouts.adminApp')
@section('adminContent')
<div class="flex-1 flex flex-col">
    <!-- Top Header -->
    <header class="bg-white dark:bg-gray-900 shadow px-6 py-4 flex justify-between items-center">
        <h1 class="text-xl font-bold">Dashboard</h1>
        <span class="text-sm text-gray-600 dark:text-gray-400">
            System Overview
        </span>
    </header>

    <!-- Dashboard Content -->
    <main class="flex-1 px-6 py-8 space-y-8">
        <!-- Stats -->
        <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="bg-white dark:bg-gray-900 rounded-xl shadow p-6">
                <p class="text-sm text-gray-500">Total News</p>
                <h3 class="text-3xl font-bold mt-2">{{ $totalNews }}</h3>
            </div>
            <div class="bg-white dark:bg-gray-900 rounded-xl shadow p-6">
                <p class="text-sm text-gray-500">Published</p>
                <h3 class="text-3xl font-bold mt-2">{{ $publishedNews }}</h3>
            </div>
            <div class="bg-white dark:bg-gray-900 rounded-xl shadow p-6">
                <p class="text-sm text-gray-500">Drafts</p>
                <h3 class="text-3xl font-bold mt-2">{{ $draftNews }}</h3>
            </div>
            <div class="bg-white dark:bg-gray-900 rounded-xl shadow p-6">
                <p class="text-sm text-gray-500">Categories</p>
                <h3 class="text-3xl font-bold mt-2">{{ $totalCategories }}</h3>
            </div>
        </section>

        <!-- Charts Section -->
        <section class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div class="bg-white dark:bg-gray-900 rounded-xl shadow p-6">
                <h3 class="text-lg font-bold mb-4">News Distribution by Category</h3>
                <div class="flex justify-center items-center">
                    <canvas id="pieChart" class="max-h-80"></canvas>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-900 rounded-xl shadow p-6">
                <h3 class="text-lg font-bold mb-4">News Count by Category</h3>
                <div class="flex justify-center items-center">
                    <canvas id="barChart" class="max-h-80"></canvas>
                </div>
            </div>
        </section>
    </main>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
    const categories = @json($categories);
    const newsCounts = @json($newsCounts);
    
    const colors = [
        'rgba(59, 130, 246, 0.8)',
        'rgba(16, 185, 129, 0.8)',
        'rgba(251, 146, 60, 0.8)',
        'rgba(239, 68, 68, 0.8)',
        'rgba(168, 85, 247, 0.8)',
        'rgba(236, 72, 153, 0.8)'
    ];

    const borderColors = [
        'rgb(59, 130, 246)',
        'rgb(16, 185, 129)',
        'rgb(251, 146, 60)',
        'rgb(239, 68, 68)',
        'rgb(168, 85, 247)',
        'rgb(236, 72, 153)'
    ];

    // Pie Chart
    const pieCtx = document.getElementById('pieChart').getContext('2d');
    new Chart(pieCtx, {
        type: 'pie',
        data: {
            labels: categories,
            datasets: [{
                data: newsCounts,
                backgroundColor: colors,
                borderColor: borderColors,
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: { padding: 15, font: { size: 12 } }
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            const value = context.parsed || 0;
                            const total = context.dataset.data.reduce((a, b) => a + b, 0);
                            const percentage = ((value / total) * 100).toFixed(1);
                            return `${context.label}: ${value} (${percentage}%)`;
                        }
                    }
                }
            }
        }
    });

    // Bar Chart
    const barCtx = document.getElementById('barChart').getContext('2d');
    new Chart(barCtx, {
        type: 'bar',
        data: {
            labels: categories,
            datasets: [{
                label: 'Number of News Articles',
                data: newsCounts,
                backgroundColor: colors,
                borderColor: borderColors,
                borderWidth: 2,
                borderRadius: 8
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: { legend: { display: false } },
            scales: {
                y: { beginAtZero: true, ticks: { stepSize: 5 } },
                x: { grid: { display: false } }
            }
        }
    });
</script>
@endsection
