
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
@if($js_berat != null || $js_usia != null)
    <div>
        <canvas id="bb_umur"></canvas>
    </div>
@else 
        <p class="text-center fs-5 fw-bold mt-3">Data Grafik Tidak Tersedia</p>
@endif

                    
<script>
        const berat = JSON.parse("{{$js_berat}}");
        const umur = JSON.parse("{{$js_usia}}");
        const databerum = {
            labels: berat,
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
        
        const config2 = {
            type: 'line',
            data: databerum,
            options: {
                responsive: true,
                plugins: {
                    title: {
                        display: true,
                        text: 'Grafik Peningkatan Berat Badan Berdasarkan Usia Anak'
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
                            text: 'Berat Badan'
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
            document.getElementById('bb_umur'),
            config2
        );
</script>

</body>



</hmtl>