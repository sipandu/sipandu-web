
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="{{ asset('/images/sipandu-logo.ico') }}">
    <title>Smart Posyandu | @yield('title')</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    @if($js_usia != null || $js_lingkar != null)
        <div>
            <canvas id="bb_tb"></canvas>
        </div>
    @else 
            <p class="text-center fs-5 fw-bold mt-3">Data Grafik Tidak Tersedia</p>

    @endif

                    
<script>
        const lingkar = JSON.parse("{{$js_lingkar}}");
        const umur = JSON.parse("{{$js_usia}}");
        const datalingkar = {
            labels: lingkar,
            data: umur,
            datasets: [
                {
                    label: 'Umur',
                    data: umur,
                    borderColor: '#111111',
                    fill: false,
                },
            ]
        };
        
        const config4 = {
            type: 'line',
            data: datalingkar,
            options: {
                responsive: true,
                plugins: {
                    title: {
                        display: true,
                        text: 'Grafik pertumbuhan Lingkar Kepala Berdasarkan Usia Anak'
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
                            text: 'Lingkar Kepala'
                        },  
                    },
                    y: {
                        display: true,
                        title: {
                            display: true,
                            text: 'Usia'
                        },
                    }
                }
            },
        };

        var bb_tb = new Chart(
            document.getElementById('bb_tb'),
            config4
        );
</script>

</body>



</hmtl>