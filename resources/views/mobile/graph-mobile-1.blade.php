
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
    @if($js_berat != null || $js_tinggi != null)
        <div>
            <canvas id="bb_tb"></canvas>
        </div>
    @else 
        <li class="list-group-item">
            <p class="text-center fs-5 fw-bold mt-3">Data Grafik Tidak Tersedia</p>
        </li>
    @endif

                    
<script>
        const tinggi = JSON.parse("{{$js_tinggi}}");
        const berat = JSON.parse("{{$js_berat}}");
        const datatingber = {
            labels: tinggi,
            data: berat,
            datasets: [
                {
                    label: 'Data Berat Berdasarkan Tinggi Badan',
                    data: berat,
                    borderColor: '#111111',
                    fill: false,
                },
            ]
        };
        
        const config1 = {
            type: 'line',
            data: datatingber,
            options: {
                responsive: true,
                plugins: {
                    title: {
                        display: true,
                        text: 'Grafik Peningkatan Berat Badan Berdasarkan Tinggi Badan Anak'
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
                            text: 'Berat Badan'
                        },
                    }
                }
            },
        };

        var bb_tb = new Chart(
            document.getElementById('bb_tb'),
            config1
        );
</script>

</body>



</hmtl>