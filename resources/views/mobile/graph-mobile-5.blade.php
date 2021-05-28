<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="{{ asset('/images/sipandu-logo.ico') }}">
    <title>Smart Posyandu 5.0 | @yield('title')</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
@if($js_berat != null)
    <canvas id="myChart"></canvas>
@else
        <p class="text-center fs-5 fw-bold mt-3">Data Grafik Tidak Tersedia</p>
@endif

                    
<script>
        const data = {
        labels: JSON.parse("{{$js_minggu}}"),
        data: JSON.parse("{{$js_berat}}") ,
        datasets: [
            {
                label: 'Perubahan Berat Badan',
                data: JSON.parse("{{$js_berat}}"),
                borderColor: '#111111',
                fill: false,
                // cubicInterpolationMode: 'monotone',
                // tension: 1
            }, 
            // {
            //     label: 'Cubic interpolation',
            //     data: datapoints,
            //     borderColor: '#36a2eb',
            //     fill: false,
            //     tension: 0.4
            // }, 
            // {
            //     label: 'Linear interpolation (default)',
            //     data: datapoints,
            //     borderColor: '#cc65fe',
            //     fill: false
            // }
        ]
    };

        const config = {
            type: 'line',
            data: data,
            options: {
                responsive: true,
                plugins: {
                    title: {
                        display: true,
                        text: 'Grafik Peningkatan Berat Badan'
                    },
                },
                interaction: {
                    intersect: false,
                },
                scales: {
                    x: {
                        display: true,
                        title: {
                            display: true,
                            text: 'Minggu ke-',
                        },  
                    },
                    y: {
                        display: true,
                        title: {
                            display: true,
                            text: 'Berat (kg)',
                        },
                        suggestedMin: 0,
                        suggestedMax: 23,
                        // labels: [-3, -2, -1, 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23]
                    }
                }
            },
        };
        
        var myChart = new Chart(
            document.getElementById('myChart'),
            config
        );
    </script>

</body>



</hmtl>