<div>
    <canvas id="myChart"></canvas>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('livewire:load', function () {
        var ctx = document.getElementById('myChart').getContext('2d');
        var chartData = @json($chartData);

        var myChart = new Chart(ctx, {
            type: 'line',
            data: chartData,
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        Livewire.on('chartDataUpdated', (data) => {
            myChart.data = data;
            myChart.update();
        });
    });
</script>
@endpush
