@extends('layouts/admin/admin-layout')

@section('title', 'Laporan Tahunan')

@section('content')
@php
  $user_role = auth()->guard('admin')->user()->pegawai->jabatan;
@endphp
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap pt-3 pb-2 mb-3 border-bottom">
      <h1 class="h3 col-lg-auto text-center text-md-start">Laporan Tahunan</h1>
      <div class="col-auto ml-auto text-right mt-n1">
          <nav aria-label="breadcrumb text-center">
              <ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
                  <li class="breadcrumb-item"><a class="text-decoration-none" href="/">Smart Posyandu</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Laporan Tahunan</li>
              </ol>
          </nav>
      </div>
  </div>
  <div>

    <form class="d-flex flex-row justify-content-between">
      
      <div class="d-flex flex-row justify-content-md-center">
        <div>
          <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
              <a class="nav-link <?= (empty($_GET['l']) || $_GET['l'] === 'pemeriksaan') ? "active" : "" ?>" aria-current="page" href="?l=pemeriksaan">Pemeriksaan</a>
            </li>
            <li class="nav-item" role="presentation">
              <a class="nav-link <?= (isset($_GET['l']) && $_GET['l'] === 'vitamin') ? "active" : "" ?>" aria-current="page" href="?l=vitamin">Vitamin</a>
            </li>
            <li class="nav-item" role="presentation">
              <a class="nav-link <?= (isset($_GET['l']) && $_GET['l'] === 'konsul') ? "active" : "" ?>" aria-current="page" href="?l=konsul">Konsultasi</a>
            </li>
            <li class="nav-item" role="presentation">
              <a class="nav-link <?= (isset($_GET['l']) && $_GET['l'] === 'imunisasi') ? "active" : "" ?>" aria-current="page" href="?l=imunisasi">Imunisasi</a>
            </li>
          </ul>
        </div>
      </div>
      
      <div>
        <button type="button" class="btn btn-outline-primary" disabled id="filter_button" data-bs-toggle="modal" data-bs-target="#modalFilter" data-bs-whatever="@mdo">
          <span class="fa fa-filter"></span> <span id="_btn_txt_filter">Tunggu ...</span>
        </button>
        <button class="btn btn-outline-success" disabled id="generate_laporan_tahunan"> Tunggu ... </button>
      </div>

    </form>
    
    <div>
      <center><div id="wait" style="font-weight: bold; padding : 10px"></div></center>
      <center>
        <h4 style="padding: 20px 0px;" id="__default_text">Tekan Tombol Buat Laporan Untuk Menampilkan Grafik</h4>
      </center>
      <canvas id="myChart"></canvas>
    </div>

    <div class="modal fade" id="modalFilter" tabindex="-1" aria-labelledby="ModalFilter" aria-hidden="true">
      <div class="modal-dialog col-3">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Filter Laporan</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form>
            @if($user_role === 'super admin')
              <div class="mb-3">
                <label for="recipient-name" class="col-form-label">Posyandu :</label>
                <select id="posyandu_laporan_filter_super_admin" class="form-control">
                </select>
              </div>
            @endif
              <div class="mb-3">
                <label for="recipient-name" class="col-form-label">Tahun :</label>
                <div class="row">
                  <div class="col-5">
                    <label class="col-form-label">Dari :</label>
                    <select id="_year_selection_first_" class="form-control">
                    </select>
                  </div>
                  <div class="col-5">
                    <label class="col-form-label">Sampai :</label>
                    <select id="_year_selection_last_" class="form-control">
                    </select>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

  </div>
@endsection

@push('js')
<script>

  let ctx = document.getElementById('myChart').getContext("2d")

  const date = new Date();

  $.ajax({
    method: 'GET',
    url : '/admin/ajax/posyandu',
    success : ( data ) => {
      data.map( (val , i) => {
        $('#posyandu_laporan_filter_super_admin')
          .append(`<option value="${val.id}" ${i === 0 && "selected"}>${val.posyandu}</option>`)
      } )
    }
  }).done(() =>  $('#posyandu_laporan_filter_super_admin').removeAttr('disabled') )
  
  $.ajax({
    method : 'GET',
    url : `/admin/ajax/filter/l/year`,
    success : (res) => {
      res.map(val => {
        const isSelected = date.getFullYear() === val ;
        $('#_year_selection_first_')
          .append(`<option value="${val}" ${isSelected === true ? "selected" : "" } >${val}</option>`)
        $('#_year_selection_last_')
          .append(`<option value="${val}" >${val}</option>`)
      })
    }
  }).done(() => {
    $('#filter_button').removeAttr('disabled')
    $('#_btn_txt_filter').text('Filter')
    $('#generate_laporan_tahunan').text('Buat Laporan')
    $('#generate_laporan_tahunan').removeAttr('disabled')
  } )

  $('#generate_laporan_tahunan').on('click' , (e) => {
    
    e.preventDefault()
    $('#generate_laporan_tahunan').text('Tunggu ...')
    $('#__default_text').text('')

    const posyandu = $('#posyandu_laporan_filter_super_admin').val() ?? "{{$id_posyandu}}"
    const start_tahun = $('#_year_selection_first_').val()
    const end_tahun = $('#_year_selection_last_').val()
    const model = "{{ $_GET['l'] ?? 'pemeriksaan' }}"

    $.ajax({
      method : 'POST',
      url : '/admin/ajax/laporan/tahunan',
      data : {
        "_token" : "{{ csrf_token() }}",
        posyandu : posyandu,
        starttahun : start_tahun,
        endtahun : end_tahun,
        model : model
      },
      success : (res) => {

        var ChartKegiatan = new Chart( ctx , {
          type : 'bar',
          data : {
            labels : [...res.labels],
            datasets : [ ...res.datasets ]
          },
          options : {
            scales: {
              yAxes: [{
                ticks: {
                  beginAtZero: true,
                  stepSize : 3,
                  suggestedMax: 10,
                }
              }]
            }
          }
        } )

      }
    }).done(() => {
      $('#generate_laporan_tahunan').removeAttr('disabled')
      $('#generate_laporan_tahunan').text('Buat Laporan')
    })

    if(window.bar != undefined)
      window.bar.destroy();
      window.bar = new Chart(ctx , {});
  })

  $('#_year_selection_first_').on('change' , () => {
    const val = $('#_year_selection_first_').val()
    const val_end = $('#_year_selection_last_').val()

    let opt = '';
    for( let i = val; i <= "{{$currentyear}}"; i++ ){
      console.log(i)
      opt += `<option value="${i}"${ parseInt(val_end) === i ? " selected" : "" } >${i}</option>`
    }
    $('#_year_selection_last_').html(opt)
  })

</script>
@endpush

