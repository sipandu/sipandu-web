@extends('layouts/admin/admin-layout')

@section('title', 'Data Kesehatan Ibu')

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h3 col-lg-auto text-center text-md-start">Data Kesehatan Ibu</h1>
        <div class="col-auto ml-auto text-right mt-n1">
            <nav aria-label="breadcrumb text-center">
                <ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
                    <li class="breadcrumb-item"><a class="text-decoration-none" href="/">Kesehatan Keluarga</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Data Kehatan Ibu</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="container-fluid px-0">
        <div class="row">
            <div class="col-12">
                <div class="mb-5">
                    <canvas id="myChart"></canvas>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script type="text/javascript">
        $(document).ready(function(){
            $('#list-admin-dashboard').removeClass('menu-open');
            $('#list-kesehatan').addClass('menu-is-opening menu-open');
            $('#kesehatan').addClass('active');
            $('#data-kesehatan-keluarga').addClass('active');
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
    const DATA_COUNT = 12;
    const labels = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];
    // for (let i = 0; i < DATA_COUNT; ++i) {
    //     labels.push(i.toString());
    // }
    const datapoints = [0, 20, 20, 60, 60, 120, NaN, 180, 120, 125, 105, 110, 170];
    const data = {
    labels: labels,
    datasets: [
        {
        label: 'Cubic interpolation (monotone)',
        data: datapoints,
        borderColor: '#111111',
        fill: false,
        cubicInterpolationMode: 'monotone',
        tension: 0.4
        }, {
        label: 'Cubic interpolation',
        data: datapoints,
        borderColor: '#36a2eb',
        fill: false,
        tension: 0.4
        }, {
        label: 'Linear interpolation (default)',
        data: datapoints,
        borderColor: '#cc65fe',
        fill: false
        }
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
                text: 'Chart.js Line Chart - Cubic interpolation mode'
            },
            },
            interaction: {
            intersect: false,
            },
            scales: {
            x: {
                display: true,
                title: {
                    display: true
                }
            },
            y: {
                display: true,
                title: {
                display: true,
                text: 'Value'
                },
                suggestedMin: -10,
                suggestedMax: 200
            }
            }
        },
        };
        
        var myChart = new Chart(
            document.getElementById('myChart'),
            config
        );
    </script>
  
@endpush
