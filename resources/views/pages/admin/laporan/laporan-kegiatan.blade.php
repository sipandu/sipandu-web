@extends('layouts/admin/admin-layout')

@section('title', 'Laporan Kegiatan')

@section('content')
@php
  $user_role = auth()->guard('admin')->user()->role;
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
      <center>
        <div id="wait" style="font-weight: bold; padding : 10px">
          <img src="{{url('/images/loader.gif')}}" id="loader-laporan" />
        </div>
      </center>
      <canvas id="myChart"></canvas>
      <hr />
      <h2> Tabel Kegiatan </h2>

      @if($user_role === 'super admin' || $user_role === 'tenaga kesehatan')
        <form class="d-flex flex-row justify-content-between">
          <div>
          </div>
          <div>
            <button type="button" class="btn btn-outline-primary" id="filter_button_tabel" disabled data-bs-toggle="modal" data-bs-target="#modalFilterTable">
              <span class="fa fa-filter"></span> <span id="_btn_txt_filter_tabel">Tunggu ...</span>
            </button>
            <button class="btn btn-outline-success" disabled id="simpan_filter_tabel"> Tunggu ... </button>
          </div>

        </form>
      @endif
      
      <center>
        <div id="wait" style="font-weight: bold; padding : 10px">
          <img src="{{url('/images/loader.gif')}}" id="loader-tabel" />
        </div>
      </center>
      <table class="table table-responsive-sm table-bordered table-hover" style="display : none" id="tabel-kegiatan">
        
        <thead class="text-center">
          <tr>
            <th rowspan="2" class="align-middle">No</th>
            <th rowspan="2" class="align-middle">Posyandu</th>
            <th rowspan="2" class="align-middle">Kecamatan</th>
            <th colspan="4" class="align-middle">Kegiatan</th>
          </tr>
          <tr>
            <th>Terlaksana</th>
            <th>Belum Terlaksana</th>
            <th>Batal</th>
            <th>Sedang Terlaksana</th>
          </tr>
        </thead>

        <tbody>
        </tbody>

      </table>
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
              @if($user_role === 'super admin' || $user_role === 'tenaga kesehatan')
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

    <div class="modal fade" id="modalFilterTable" tabindex="-1" aria-labelledby="ModalFilterTabel" aria-hidden="true">
      <div class="modal-dialog col-3">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Filter Tabel</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form>

              <div class="mb-3">
                <label for="recipient-name" class="col-form-label">Pilih Filter :</label>
                <select  class="form-control full-width" id="filter_type_tabel">
                  <option value="kecamatan" selected>Kecamatan</option>
                  <option value="kabupaten" >Kabupaten</option>
                </select>
              </div>
              <div id="filter_value_container_tabel">
                <select id="options-filter" class="form-control full-width"></select>
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
    url : '/admin/ajax/posyandu?tk={{ $user_role === "tenaga kesehatan" ? 1 : 0 }}',
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

  $.ajax({
    method : 'POST',
    url : '/admin/ajax/default/kegiatan?tk={{ $user_role === "tenaga kesehatan" ? 1 : 0 }}',
    data : {
      "_token" : "{{ csrf_token() }}",
      posyandu : "{{$id_posyandu}}"
    },
    success : (res) => {
      if(window.bar != undefined) window.bar.destroy();
      window.bar = new Chart( ctx , {
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
    $('#loader-laporan').css({ display : 'none' })
  })

  $.ajax({
    url : '/admin/ajax/tabel/filter?tk={{ $user_role === "tenaga kesehatan" ? 1 : 0 }}&type=kecamatan',
    method : 'GET',
    success : ( res ) => {
      let optSelect = ''
      Object.values(res).map( v => {
        $('#options-filter').append(`<option value=${v.id}>${v.nama}</option>`)
      })
    }
  }).done(() => {
    $('#filter_button_tabel').removeAttr('disabled')
    $('#_btn_txt_filter_tabel').text('Filter')
  })

  $('#filter_type_tabel').on('change' , () => {

    const valueType = $('#filter_type_tabel').val()

    $('#options-filter').attr('disabled' , true);
    
    $.ajax({
      url : '/admin/ajax/tabel/filter?tk={{ $user_role === "tenaga kesehatan" ? 1 : 0 }}&type='+valueType,
      method : 'GET',
      success : ( res ) => {
        
        $('#options-filter').html('')
        let optSelect = ''
        Object.values(res).map( v => {
          $('#options-filter').append(`<option value=${v.id}>${v.nama}</option>`)
        })

      } 
    }).done(() => {
      $('#options-filter').removeAttr('disabled');
    })

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
    
    $('#loader-laporan').css({ display : 'block' })

    $('#__default_text').text('')
    $('#generate_laporan_kegiatan').attr('disabled' , true)
    $('#generate_laporan_kegiatan').text('Memuat ...')
    $('#filter_type_laporan_kegiatan').attr('disabled' , true)
    $('#loader-tabel').css({ display : 'block' })
    $('#tabel-kegiatan').attr('style' , 'display : none')

    const posyandu = $('#posyandu_laporan_filter_super_admin').val()
    const filter = $('#filter_type_laporan_kegiatan').val()
    const tahun = $('#filter_value_year_laporan_kegiatan').val()
    const bulan = $('#filter_value_month_laporan_kegiatan').val()

    if(window.bar != undefined) window.bar.destroy();
    
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
        
        window.bar = new Chart( ctx , {
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
      $('#loader-laporan').css({ display : 'none' })
    })

    $.ajax({
      method : 'POST',
      url : '/admin/ajax/table/kegiatan',
      data : {
        "_token" : "{{ csrf_token() }}",
        posyandu : posyandu ?? "{{ $id_posyandu }}",
        filter : filter,
        tahun : tahun,
        bulan : bulan,
      },
      success : (res) => {
        let htmlTabel = ''
        let i = 1

        if( Object.keys(res).length === 0 ){
          htmlTabel = `
            <tr>
              <td colspan="7"><center>Tidak Ada Kegiatan</center></td>
            </tr>
          `
        }else{
          Object.values(res).map( res => {
            htmlTabel += `
              <tr>
                <td><center>${i++}</center></td>
                <td>${res.posyandu}</td>
                <td>${res.kecamatan}</td>
                <td><center>${res.lewat}</center></td>
                <td><center>${res.belum}</center></td>
                <td><center>${res.batal}</center></td>
                <td><center>${res.terlaksana}</center></td>
              </tr>
            `
          } )

        }
        $('#tabel-kegiatan tbody').html(htmlTabel)
      }
    }).done(() => {
      $('#loader-tabel').css({ display : 'none' })
      $('#tabel-kegiatan').removeAttr('style')
    })

  })

  $('#simpan_filter_tabel').on('click' , (e) => {
    e.preventDefault();

    const type = $('#filter_type_tabel').val()
    const value = $('#options-filter').val()

    $('#loader-tabel').css({ display : 'block' })
    $('#tabel-kegiatan').attr('style' , 'display : none')
    $('#simpan_filter_tabel').text('Tunggu ...')
    $('#simpan_filter_tabel').attr( 'disabled' , true )
    
    $.ajax({
      url : '/admin/ajax/default/table/kegiatan?tk={{ $user_role === "tenaga kesehatan" ? 1 : 0 }}',
      method : 'POST',
      data : {
        "_token" : "{{ csrf_token() }}",
        type : type,
        value : value,
        posyandu : "{{$id_posyandu}}"
      },
      success : ( res ) => {
        let htmlTabel = ''
        let i = 1
        if( Object.keys(res).length === 0 ){
          htmlTabel = `
            <tr>
              <td colspan="7"><center>Tidak Ada Kegiatan</center></td>
            </tr>
          `
        }else{
          Object.values(res).map( res => {
            htmlTabel += `
              <tr>
                <td><center>${i++}</center></td>
                <td>${res.posyandu}</td>
                <td>${res.kecamatan}</td>
                <td><center>${res.lewat}</center></td>
                <td><center>${res.belum}</center></td>
                <td><center>${res.batal}</center></td>
                <td><center>${res.terlaksana}</center></td>
              </tr>
            `
          } )

        }

        $('#tabel-kegiatan tbody').html(htmlTabel)
      }
    }).done(() => {
      $('#simpan_filter_tabel').text('Filter')
      $('#simpan_filter_tabel').removeAttr( 'disabled' , true )
      $('#tabel-kegiatan').removeAttr('style')
      $('#loader-tabel').css({ display : 'none' })
    })


  })

  // Tabel Laporan 

  $.ajax({
    method : 'POST',
    url : '/admin/ajax/default/table/kegiatan?tk={{ $user_role === "tenaga kesehatan" ? 1 : 0 }}',
    data : {
      "_token" : "{{ csrf_token() }}",
      posyandu : "{{$id_posyandu}}"
    },
    success : (res) => {

      let htmlTabel = ''
      let i = 1
      if( Object.keys(res).length === 0 ){
        htmlTabel = `
          <tr>
            <td colspan="7"><center>Tidak Ada Kegiatan</center></td>
          </tr>
        `
      }else{
        Object.values(res).map( res => {
          htmlTabel += `
            <tr>
              <td><center>${i++}</center></td>
              <td>${res.posyandu}</td>
              <td>${res.kecamatan}</td>
              <td><center>${res.lewat}</center></td>
              <td><center>${res.belum}</center></td>
              <td><center>${res.batal}</center></td>
              <td><center>${res.terlaksana}</center></td>
            </tr>
          `
        } )

      }

      $('#tabel-kegiatan tbody').html(htmlTabel)
    }
  }).done(() => {
    $('#loader-tabel').css({ display : 'none' })
    $('#tabel-kegiatan').removeAttr('style')
    $('#simpan_filter_tabel').text('Simpan')
    $('#simpan_filter_tabel').removeAttr('disabled')
  })
  
</script>
@endpush

