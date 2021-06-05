
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
@if($js_tinggi != null || $js_usia != null)
    <div>
        <canvas id="tb_umur"></canvas>
    </div>
@else 
        <p class="text-center fs-5 fw-bold mt-3">Data Grafik Tidak Tersedia</p>
@endif

                    
<script>
        const tinggi = JSON.parse("{{$js_tinggi}}");
        const umur = JSON.parse("{{$js_usia}}");
        const datatingmur = {
            labels: tinggi,
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
        
        const config3 = {
            type: 'line',
            data: datatingmur,
            options: {
                responsive: true,
                plugins: {
                    title: {
                        display: true,
                        text: 'Grafik Peningkatan Tinggi Badan Berdasarkan Usia Anak'
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
                            text: 'Tinggi Badan'
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
            document.getElementById('tb_umur'),
            config3
        );
</script>

</body>



</hmtl>