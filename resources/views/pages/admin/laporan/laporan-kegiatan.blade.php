@extends('layouts/admin/admin-layout')

@section('title', 'Laporan Kegiatan')

@section('content')
@php
  $user_role = auth()->guard('admin')->user()->pegawai->jabatan;
@endphp
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap pt-3 pb-2 mb-3 border-bottom">
      <h1 class="h3 col-lg-auto text-center text-md-start">Laporan Kegiatan</h1>
      <div class="col-auto ml-auto text-right mt-n1">
          <nav aria-label="breadcrumb text-center">
              <ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
                  <li class="breadcrumb-item"><a class="text-decoration-none" href="/">Smart Posyandu 5.0</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Laporan Kegiatan</li>
              </ol>
          </nav>
      </div>
  </div>
  <div>

    <form class="d-flex flex-row justify-content-between">
      <div>
      </div>
      <div>
        <button type="button" class="btn btn-outline-primary" disabled id="filter_button" data-bs-toggle="modal" data-bs-target="#modalFilter" data-bs-whatever="@mdo">
          <span class="fa fa-filter"></span> <span id="_btn_txt_filter">Tunggu ...</span>
        </button>
        <button class="btn btn-outline-success" id="generate_laporan_kegiatan"> Buat Laporan </button>
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
                <label for="recipient-name" class="col-form-label">Pilih Filter :</label>
                <select  class="form-control full-width" id="filter_type_laporan_kegiatan">
                  <option value="year" selected>Tahun</option>
                  <option value="monthly" >Bulan</option>
                  <option value="weekly" >Mingguan</option>
                </select>
              </div>
              <div id="filter_value_container_laporan_kegiatan">
          
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
  
  var ctx = document.getElementById('myChart').getContext("2d");

  $.ajax({
    method: 'GET',
    url : '/admin/ajax/posyandu',
    success : ( data ) => {
      data.map( (val , i) => {
        $('#posyandu_laporan_filter_super_admin')
          .append(`<option value="${val.id}" ${i === 0 && "selected"}>${val.posyandu}</option>`)
      } )
    }
  }).done(() => { 
    $('#posyandu_laporan_filter_super_admin').removeAttr('disabled')
    $('#_btn_txt_filter').text('Filter')
    $('#filter_button').removeAttr('disabled')
  })

  $('#filter_type_laporan_kegiatan').on('change' , () => {
    const type = $('#filter_type_laporan_kegiatan').val()
    const valueFilter = $('#filter_value_container_laporan_kegiatan .form-control')
    const valueContainer = $('#filter_value_container_laporan_kegiatan')

    valueFilter.attr('disabled' , true)
    $('#generate_laporan_kegiatan').text('Tunggu ...')
    $('#generate_laporan_kegiatan').attr('disabled' , true)

    $.ajax({
      method : 'GET',
      url : `/admin/ajax/filter/${type}`,
      success : (res) => {
        
        if(type === 'year'){
          valueContainer.html(``)
        }

        if( type === 'monthly' ) {
          let yearval = ''

          res.map(val => {
            yearval += `<option value="${val}">${val}</option>`
          })

          valueContainer
          .html(`
            <div class="mb-3">
              <label for="recipient-name" class="col-form-label">Tahun :</label>
              <select class="form-control" id="filter_value_year_laporan_kegiatan">
                ${yearval}
              </select>
            <div>
          `)
        }

        if( type === 'weekly' ){

          let yearval = ''
          let monthval = ''

          res['month'].map((val , i) => {
            monthval += `<option value="${ i+1 < 10 ? '0' : '' }${i+1}">${val}</option>`
          })

          res['year'].map(val => {
            yearval += `<option value="${val}">${val}</option>`
          })

          valueContainer
          .html(`
            <div class="mb-3">
              <label for="recipient-name" class="col-form-label">Tahun :</label>
              <select class="form-control full-width" id="filter_value_year_laporan_kegiatan">
                ${yearval}
              </select>
            </div>
            <div class="mb-3">
              <label for="recipient-name" class="col-form-label">Bulan :</label>
              <select class="form-control full-width" id="filter_value_month_laporan_kegiatan">
                ${monthval}
              </select>
            </div>
          `)
        }

      }
    }).done(() =>  {
      valueFilter.removeAttr('disabled')
      $('#generate_laporan_kegiatan').text('Buat Laporan')
      $('#generate_laporan_kegiatan').removeAttr('disabled')
    } )

  })

  $('#generate_laporan_kegiatan').on('click' , (e) => {
    
    e.preventDefault()

    $('#__default_text').text('')
    $('#generate_laporan_kegiatan').attr('disabled' , true)
    $('#generate_laporan_kegiatan').text('Memuat ...')
    $('#filter_type_laporan_kegiatan').attr('disabled' , true)

    const posyandu = $('#posyandu_laporan_filter_super_admin').val()
    const filter = $('#filter_type_laporan_kegiatan').val()
    const tahun = $('#filter_value_year_laporan_kegiatan').val()
    const bulan = $('#filter_value_month_laporan_kegiatan').val()
    
    $.ajax({
      method : 'POST',
      url : '/admin/ajax/laporan/kegiatan',
      data : {
        "_token" : "{{ csrf_token() }}",
        posyandu : posyandu ?? "{{ $id_posyandu }}",
        filter : filter,
        tahun : tahun,
        bulan : bulan,
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
      $('#generate_laporan_kegiatan').removeAttr('disabled')
      $('#generate_laporan_kegiatan').text('Buat Laporan')
      $('#filter_type_laporan_kegiatan').removeAttr('disabled')
    })

    if(window.bar != undefined)
      window.bar.destroy();
      window.bar = new Chart(ctx , {});
  })

</script>
@endpush

