<canvas id="revenueChart"></canvas>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    new Chart(document.getElementById('revenueChart'), {
        type: 'line',
        data: {
            labels: @json($daily->pluck('day')),
            datasets: [{
                label: 'Pendapatan',
                data: @json($daily->pluck('revenue')),
                borderColor: '#6366f1',
                backgroundColor: 'rgba(99, 102, 241, 0.1)',
                fill: true,
                tension: 0.4,
            }]
        }
    });
</script>
@endpush