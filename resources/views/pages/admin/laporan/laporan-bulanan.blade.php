@extends('layouts/admin/admin-layout')

@section('title', 'Laporan Bulanan')

@section('content')
@php
  $user_role = auth()->guard('admin')->user()->role;
@endphp
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap pt-3 pb-2 mb-3 border-bottom">
      <h1 class="h3 col-lg-auto text-center text-md-start">Laporan Bulanan</h1>
      <div class="col-auto ml-auto text-right mt-n1">
          <nav aria-label="breadcrumb text-center">
              <ol class="breadcrumb bg-transparent p-0 mt-1 mb-0">
                  <li class="breadcrumb-item"><a class="text-decoration-none" href="/">Smart Posyandu 5.0</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Laporan Bulanan</li>
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
        <button class="btn btn-outline-success" disabled id="generate_laporan_bulanan"> Tunggu ... </button>
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
      <h2> Tabel Bulanan </h2>

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
      <table class="table table-responsive-sm table-bordered table-hover" style="display : none" id="tabel-bulanan">
        
        <thead class="text-center">
          <tr>
            <th rowspan="2" class="align-middle">No</th>
            <th rowspan="2" class="align-middle">Posyandu</th>
            <th rowspan="2" class="align-middle">Kecamatan</th>
            <th colspan="3" class="align-middle">Pemeriksaan</th>
            <th colspan="2" class="align-middle">J.K</th>
            <th rowspan="2" class="align-middle">Total</th>
          </tr>
          <tr>
            <th>Ibu</th>
            <th>Anak</th>
            <th>Lansia</th>
            <th>P</th>
            <th>L</th>
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
                <label for="recipient-name" class="col-form-label">Tahun :</label>
                <select id="_year_selection_" class="form-control">
                </select>
              </div>
              <div class="mb-3">
                <label for="message-text" class="col-form-label">Bulan:</label>
                <div class="row">
                  <div class="col-5">
                    <label class="col-form-label">Dari :</label>
                    <select id="_month_selection_first_" class="form-control">
                    </select>
                  </div>
                  <div class="col-5">
                    <label class="col-form-label">Sampai :</label>
                    <select id="_month_selection_last_" class="form-control">
                    </select>
                  </div>
                </div>
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

  let ctx = document.getElementById('myChart').getContext("2d")

  const date = new Date();
  const modelDefault = "{{ $_GET['l'] ?? 'pemeriksaan' }}"

  $.ajax({
    method: 'GET',
    url : '/admin/ajax/posyandu?tk={{ $user_role === "tenaga kesehatan" ? 1 : 0 }}',
    success : ( data ) => {
      data.map( (val , i) => {
        $('#posyandu_laporan_filter_super_admin')
          .append(`<option value="${val.id}" ${i === 0 && "selected"}>${val.posyandu}</option>`)
      } )
    }
  }).done(() =>  $('#posyandu_laporan_filter_super_admin').removeAttr('disabled') )
  
  $.ajax({
    method : 'POST',
    url : '/admin/ajax/default/bulanan?tk={{ $user_role === "tenaga kesehatan" ? 1 : 0 }}',
    data : {
      "_token" : "{{ csrf_token() }}",
      model : modelDefault,
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
    method : 'GET',
    url : `/admin/ajax/filter/l/month`,
    success : (res) => {
      res['year'].map(val => {
        const isSelected = date.getFullYear() === val ;
        $('#_year_selection_')
          .append(`<option value="${val}" ${isSelected === true ? "selected" : "" } >${val}</option>`)
      })
      res['month'].map((val , i) => {
        const isSelected = (date.getMonth() + 1) === (i+1);
        $('#_month_selection_first_')
          .append(`<option value="${i+1}">${val}</option>`)
        $('#_month_selection_last_')
          .append(`<option value="${i+1}" ${isSelected === true ? "selected" : "" } >${val}</option>`)
      })
    }
  }).done(() => {
    $('#filter_button').removeAttr('disabled')
    $('#_btn_txt_filter').text('Filter')
    $('#generate_laporan_bulanan').text('Buat Laporan')
    $('#generate_laporan_bulanan').removeAttr('disabled')
  } )

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

  $('#generate_laporan_bulanan').on('click' , (e) => {
    
    e.preventDefault()
    $('#generate_laporan_bulanan').text('Tunggu ...')
    $('#__default_text').text('')
    $('#loader-laporan').css({ display : 'block' })
    $('#loader-tabel').css({ display : 'block' })
    $('#tabel-bulanan').attr('style' , 'display : none')

    const posyandu = $('#posyandu_laporan_filter_super_admin').val() ?? "{{$id_posyandu}}"
    const tahun = $('#_year_selection_').val()
    const start_bulan = $('#_month_selection_first_').val()
    const end_bulan = $('#_month_selection_last_').val()
    const model = "{{ $_GET['l'] ?? 'pemeriksaan' }}"

    if(window.bar != undefined) window.bar.destroy();

    $.ajax({
      method : 'POST',
      url : '/admin/ajax/laporan/bulanan',
      data : {
        "_token" : "{{ csrf_token() }}",
        posyandu : posyandu,
        startbulan : start_bulan,
        endbulan : end_bulan,
        tahun : tahun,
        model : model
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
      $('#generate_laporan_bulanan').removeAttr('disabled')
      $('#generate_laporan_bulanan').text('Buat Laporan')
      $('#filter_type_laporan_kegiatan').removeAttr('disabled')
      $('#loader-laporan').css({ display : 'none' })
    })

    $.ajax({
      method : 'POST',
      url : '/admin/ajax/table/bulanan',
      data : {
        "_token" : "{{ csrf_token() }}",
        posyandu : posyandu,
        startbulan : start_bulan,
        endbulan : end_bulan,
        tahun : tahun,
        model : model
      },
      success : (res) => {
        let htmlTabel = ''
        let i = 1
        if( Object.keys(res).length === 0 ){
          htmlTabel = `
            <tr>
              <td colspan="9"><center>Tidak Ada Laporan Bulanan</center></td>
            </tr>
          `
        }else{
          Object.values(res).map( res => {
            htmlTabel += `
              <tr>
                <td><center>${i++}</center></td>
                <td>${res.posyandu}</td>
                <td>${res.kecamatan}</td>
                <td><center>${res.ibu}</center></td>
                <td><center>${res.anak}</center></td>
                <td><center>${res.lansia}</center></td>
                <td><center>${res.perempuan}</center></td>
                <td><center>${res.laki}</center></td>
                <td><center>${res.total}</center></td>
              </tr>
            `
          } )
        }
        $('#tabel-bulanan tbody').html(htmlTabel)
      }
    }).done(() => {
      $('#loader-tabel').css({ display : 'none' })
      $('#tabel-bulanan').removeAttr('style')
    })

  })

  $('#_month_selection_first_').on('change' , () => {
    const val = $('#_month_selection_first_').val()
    const val_end = $('#_month_selection_last_').val()
    let opt = '';
    
    const month = [ 'January', 'February', 'March','April','May','June','July','August','September','October', 'November','December']

    for( let i = val; i <= month.length; i++ ){
      opt += `<option value="${i}"${ parseInt(val_end) === i ? " selected" : "" }>${month[i-1]}</option>`
    }

    $('#_month_selection_last_').html(opt)

  })

  $('#simpan_filter_tabel').on('click' , (e) => {
    e.preventDefault();

    const type = $('#filter_type_tabel').val()
    const value = $('#options-filter').val()

    $('#loader-tabel').css({ display : 'block' })
    $('#tabel-bulanan').attr('style' , 'display : none')
    $('#simpan_filter_tabel').text('Tunggu ...')
    $('#simpan_filter_tabel').attr( 'disabled' , true )
    
    $.ajax({
      url : '/admin/ajax/default/table/bulanan?tk={{ $user_role === "tenaga kesehatan" ? 1 : 0 }}',
      method : 'POST',
      data : {
        "_token" : "{{ csrf_token() }}",
        type : type,
        value : value,
        posyandu : "{{$id_posyandu}}",
        model    : modelDefault
      },
      success : ( res ) => {
        let htmlTabel = ''
        let i = 1
        if( Object.keys(res).length === 0 ){
          htmlTabel = `
            <tr>
              <td colspan="9"><center>Tidak Ada Laporan Bulanan</center></td>
            </tr>
          `
        }else{
          Object.values(res).map( res => {
            htmlTabel += `
              <tr>
                <td><center>${i++}</center></td>
                <td>${res.posyandu}</td>
                <td>${res.kecamatan}</td>
                <td><center>${res.ibu}</center></td>
                <td><center>${res.anak}</center></td>
                <td><center>${res.lansia}</center></td>
                <td><center>${res.perempuan}</center></td>
                <td><center>${res.laki}</center></td>
                <td><center>${res.total}</center></td>
              </tr>
            `
          } )

        }

        $('#tabel-bulanan tbody').html(htmlTabel)
      }
    }).done(() => {
      $('#simpan_filter_tabel').text('Filter')
      $('#simpan_filter_tabel').removeAttr( 'disabled' , true )
      $('#tabel-bulanan').removeAttr('style')
      $('#loader-tabel').css({ display : 'none' })
    })


  })

  $.ajax({
    method : 'POST',
    url : '/admin/ajax/default/table/bulanan?tk={{ $user_role === "tenaga kesehatan" ? 1 : 0 }}',
    data : {
      "_token" : "{{ csrf_token() }}",
      posyandu : "{{$id_posyandu}}",
      model    : modelDefault
    },
    success : (res) => {

      let htmlTabel = ''
      let i = 1
      if( Object.keys(res).length === 0 ){
        htmlTabel = `
          <tr>
            <td colspan="9"><center>Tidak Ada Laporan Bulanan</center></td>
          </tr>
        `
      }else{
        Object.values(res).map( res => {
          htmlTabel += `
            <tr>
              <td><center>${i++}</center></td>
              <td>${res.posyandu}</td>
              <td>${res.kecamatan}</td>
              <td><center>${res.ibu}</center></td>
              <td><center>${res.anak}</center></td>
              <td><center>${res.lansia}</center></td>
              <td><center>${res.perempuan}</center></td>
              <td><center>${res.laki}</center></td>
              <td><center>${res.total}</center></td>
            </tr>
          `
        } )

      }

      $('#tabel-bulanan tbody').html(htmlTabel)
    }
  }).done(() => {
    $('#loader-tabel').css({ display : 'none' })
    $('#tabel-bulanan').removeAttr('style')
    $('#simpan_filter_tabel').text('Simpan')
    $('#simpan_filter_tabel').removeAttr('disabled')
  })

</script>
@endpush

