<?php

namespace App\Http\Controllers\Admin\Laporan;

use App\Http\Controllers\Controller;
use App\Kegiatan;
use App\PemberianImunisasi;
use App\PemberianVitamin;
use App\PemeriksaanAnak;
use App\PemeriksaanIbu;
use App\PemeriksaanLansia;
use App\Posyandu;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    
    public function laporankegiatan()
    {

      $id_posyandu = null;
      
      if( in_array(auth('admin')->user()->role , ['super admin' , 'tenaga kesehatan']) === false ){
        $id_posyandu = auth('admin')->user()->pegawai->posyandu->id;
      }
      
      return view('pages.admin.laporan.laporan-kegiatan' , compact('id_posyandu'));
    } 

    public function laporanbulanan()
    {
      $id_posyandu = null;
      if( in_array(auth('admin')->user()->role , ['super admin' , 'tenaga kesehatan']) === false  ){
        $id_posyandu = auth('admin')->user()->pegawai->posyandu->id;
      }
      
      return view('pages.admin.laporan.laporan-bulanan' , compact('id_posyandu'));
    } 

    public function laporantahunan()
    {
      $id_posyandu = null;
      
      if( in_array(auth('admin')->user()->role , ['super admin' , 'tenaga kesehatan']) === false  ){
        $id_posyandu = auth('admin')->user()->pegawai->posyandu->id;
      }

      if( ($this->getCurrentYear() - $this->getLastYear()) <= 3){
        $latestyear = $this->getCurrentYear() - 3;
        $currentyear = $this->getCurrentYear();
      }else{
       $latestyear = $this->getLastYear();
       $currentyear = $this->getCurrentYear();
      }
      
      return view('pages.admin.laporan.laporan-tahunan' , compact('latestyear' , 'currentyear' , 'id_posyandu'));
    } 
    
    public function ajaxposyandu(Request $request)
    {

      $posyandu = new Posyandu();
      $arr_posyandu = [];
      
      if( $request->tk == 1 ) {
        $id = auth('admin')->user()->nakes->id;
        $posyandu = $posyandu->whereHas('nakesPosyandu' , function($nakes) use ($id) {
          $nakes->where('id' , $id);
        })->get();

        foreach($posyandu as $posyandu_){
          $arr_posyandu[] = [
            'id' => $posyandu_->id,
            'posyandu' => $posyandu_->nama_posyandu
          ];
        }
      }else{
        foreach($posyandu->all() as $posyandu_){
          $arr_posyandu[] = [
            'id' => $posyandu_->id,
            'posyandu' => $posyandu_->nama_posyandu
          ];
        }
      }

      return response()->json( $arr_posyandu , 200 );

    }

    public function ajaxfilter( $type )
    {

      for( $i = $this->getCurrentYear(); $i >= $this->getLastYear() ; $i-- ){
        $data['monthly'][] = $i;
      }

      $data['weekly'] = [
        'month' => [
          'January',
          'February',
          'March',
          'April',
          'May',
          'June',
          'July',
          'August',
          'September',
          'October',
          'November',
          'December'
        ],
        'year' => $data['monthly']
      ];

      return response()->json($type === 'year' ? [] : $data[$type] , 200);
    
    }

    public function filter( $type )
    {
      if( ($this->getCurrentYear() - $this->getLastYear()) <= 3){
        for( $i =( $this->getCurrentYear()); $i >= ($this->getLastYear() - 3) ; $i-- ){
          $data['year'][] = $i;
        }
      }else{
        for( $i = $this->getCurrentYear(); $i >= $this->getLastYear() ; $i-- ){
          $data['year'][] = $i;
        }
      }

      $data['month'] = [
        'month' => [
          'January',
          'February',
          'March',
          'April',
          'May',
          'June',
          'July',
          'August',
          'September',
          'October',
          'November',
          'December'
        ],
        'year' => $data['year']
      ];

      return response()->json( $data[$type]  ,200);
    }

    public function ajaxchartkegiatan(Request $request){
      $arr_chart = [];
      $kegiatan = new Kegiatan();
      
      $arr_chart_value = [];

      if($request->filter === 'year'){

        if(($this->getCurrentYear() - $this->getLastYear()) <= 4 ){
          for($i = $this->getCurrentYear() + 2; $i >= $this->getCurrentYear() - 3; $i--){
            $arr_chart['labels'][] = $i;
          }
        }else{
          for($i = $this->getCurrentYear() + 2; $i >= $this->getLastYear(); $i--){
            $arr_chart['labels'][] = $i;
          }
        }

        foreach($arr_chart['labels'] as $main_ ){

          $queryYear = $kegiatan->whereYear('start_at' , $main_);
          
          if($request->posyandu !== null ){
            $queryYear = $queryYear->where('id_posyandu' , $request->posyandu);
          }

          $queryYear = $queryYear->withTrashed()->get();
          
          if( $queryYear->isEmpty() === false ){
            $temp_arr = [ 'cancel' => [] , 'passed' => [] , 'not_yet' => [] , 'in_progress' => [] ];
            foreach( $queryYear as $kegiatan_){
              if($kegiatan_->trashed()){
               $temp_arr['cancel'][] = $kegiatan_;
              }else if ( $kegiatan_->end_at < date('Y-m-d') ){
                $temp_arr['passed'][] = $kegiatan_;
              }else if ($kegiatan_->start_at > date('Y-m-d')) {
                $temp_arr['not_yet'][] = $kegiatan_;
              }else{
                $temp_arr['in_progress'][] = $kegiatan_;
              }
            }
            $arr_chart_value['cancel'][] = count($temp_arr['cancel']) ?? 0;
            $arr_chart_value['passed'][] = count($temp_arr['passed']) ?? 0;
            $arr_chart_value['not_yet'][] = count($temp_arr['not_yet']) ?? 0;
            $arr_chart_value['in_progress'][] = count($temp_arr['in_progress']) ?? 0;
          }else{
            $arr_chart_value['cancel'][] = 0;
            $arr_chart_value['passed'][] = 0;
            $arr_chart_value['not_yet'][] = 0;
            $arr_chart_value['in_progress'][] = 0;
          }
          
  
        }
        
      }

      if($request->filter === 'monthly' ){
        
        $arr_chart['labels'] = [
          'Jan',
          'Feb',
          'Mar',
          'Apr',
          'May',
          'Jun',
          'Jul',
          'Aug',
          'Sep',
          'Oct',
          'Nov',
          'Des'
        ];
        
        foreach (array_keys($arr_chart['labels']) as $month){

          $monthIndex = $month < 10 ? '0'. ($month+1) : ($month+1);

          $queryMonth = $kegiatan->whereYear( 'start_at' , $request->tahun )
            ->whereMonth('start_at' ,  $monthIndex);
          
          if($request->posyandu !== null ){
            $queryMonth = $queryMonth->where('id_posyandu' , $request->posyandu);
          }
          
          $queryMonth = $queryMonth->withTrashed()->get();
          
          if($queryMonth->isEmpty() === false){
            $temp_arr = [ 'cancel' => [] , 'passed' => [] , 'not_yet' => [] , 'in_progress' => [] ];
            foreach( $queryMonth as $kegiatan_){
              if($kegiatan_->trashed()){
               $temp_arr['cancel'][] = $kegiatan_;
              }else if ( $kegiatan_->end_at < date('Y-m-d') ){
                $temp_arr['passed'][] = $kegiatan_;
              }else if ($kegiatan_->start_at > date('Y-m-d')) {
                $temp_arr['not_yet'][] = $kegiatan_;
              }else{
                $temp_arr['in_progress'][] = $kegiatan_;
              }
            }
            $arr_chart_value['cancel'][] = count($temp_arr['cancel']) ?? 0;
            $arr_chart_value['passed'][] = count($temp_arr['passed']) ?? 0;
            $arr_chart_value['not_yet'][] = count($temp_arr['not_yet']) ?? 0;
            $arr_chart_value['in_progress'][] = count($temp_arr['in_progress']) ?? 0;
          }else{
            $arr_chart_value['cancel'][] = 0;
            $arr_chart_value['passed'][] = 0;
            $arr_chart_value['not_yet'][] = 0;
            $arr_chart_value['in_progress'][] = 0;
          }

        }

      }

      if($request->filter === 'weekly'){  

        $initDate =  Carbon::createFromDate($request->tahun, $request->bulan, 1);
        $lastNumberWeek = $initDate->lastOfMonth()->weekNumberInMonth;
        $temp_arr = [];

        for($i = 1; $i <= $lastNumberWeek; $i ++){
          $arr_chart['labels'][] = 'Minggu-'.$i;
          $temp_arr['cancel'][$i] = [];
          $temp_arr['passed'][$i] = [];
          $temp_arr['not_yet'][$i] = [];
          $temp_arr['in_progress'][$i] = [];
        }

        $weekQuery =  $kegiatan->whereYear( 'start_at' , $request->tahun )
          ->whereMonth('start_at' , $request->bulan);

        if($request->posyandu !== null ){
          $weekQuery = $weekQuery->where('id_posyandu' , $request->posyandu);
        }
        
        $weekQuery = $weekQuery->withTrashed()->get();
        if($weekQuery->isEmpty() === false){

          foreach($weekQuery as $kegiatan_){
            
            $date = (new Carbon( new Carbon(date('Y-m-d' , strtotime($kegiatan_->start_at))) ));
            $weekNumber = $date->weekNumberInMonth;

            if( $kegiatan_->trashed() ){
              $temp_arr['cancel'][$weekNumber][] = $kegiatan_;
            }else if ( ($kegiatan_->end_at < date('Y-m-d')) ){
              $temp_arr['passed'][$weekNumber][] = $kegiatan_;
            }else if ( ($kegiatan_->start_at > date('Y-m-d')) ) {
              $temp_arr['not_yet'][$weekNumber][] = $kegiatan_;
            }else if ( (( $kegiatan_->start_at <= date('Y-m-d') ) && ( $kegiatan_->end_at >= date('Y-m-d') )) ) {
              $temp_arr['in_progress'][$weekNumber][] = $kegiatan_;
            }

          }
          for($i = 1; $i <= $lastNumberWeek; $i ++){
            $arr_chart_value['cancel'][] = count($temp_arr['cancel'][$i]);
            $arr_chart_value['passed'][] = count($temp_arr['passed'][$i]);
            $arr_chart_value['not_yet'][] = count($temp_arr['not_yet'][$i]);
            $arr_chart_value['in_progress'][] = count($temp_arr['in_progress'][$i]);
          }
          

        }else{
          $arr_chart_value['cancel'][] = 0;
          $arr_chart_value['passed'][] = 0;
          $arr_chart_value['not_yet'][] = 0;
          $arr_chart_value['in_progress'][] = 0;
        }

      }

      $arr_chart['datasets'] = [
        [
          'label' => 'Batal',
          'backgroundColor' => '#de2141',
          'data' => $arr_chart_value['cancel']
        ],
        [
          'label' => 'Terlaksana',
          'backgroundColor' => '#06c710',
          'data'=> $arr_chart_value['passed']
        ],
        [
          'label' => 'Belum Terlaksana',
          'backgroundColor' => '#c5c9c6',
          'data' => $arr_chart_value['not_yet']
        ],
        [
          'label' => 'Dalam Pelaksanaan',
          'backgroundColor' => '#e8e161',
          'data' => $arr_chart_value['in_progress']
        ]
      ];

      return response()->json( $arr_chart , 200);
    }

    public function ajaxchartbulanan(Request $request){
      
      $arr_chart = [];
      $arr_chart_value = [];

      $month = [
        '1' => 'Jan',
        '2' => 'Feb',
        '3' => 'Mar',
        '4' => 'Apr',
        '5' => 'May',
        '6' => 'Jun',
        '7' => 'Jul',
        '8' => 'Aug',
        '9' => 'Sep',
        '10' => 'Oct',
        '11' => 'Nov',
        '12' => 'Des'
      ];

      $startMonth = $request->startbulan;
      $endMonth = $request->endbulan;
      $tahun = $request->tahun;
      $posyandu = $request->posyandu;
      $modelName = $request->model;

      if($modelName === 'pemeriksaan'){
        
        for( $i = $startMonth; $i <= $endMonth; $i++ ){
          $arr_chart['labels'][] = $month[$i];
          $pemereiksaanAnak = PemeriksaanAnak::whereYear('tanggal_pemeriksaan' , $tahun)
            ->whereMonth('tanggal_pemeriksaan' , $i)->where('id_posyandu' , $posyandu)
            ->whereIn('jenis_pemeriksaan' , ['Pemeriksaan' , 'pemeriksaan'] )->count();
          $pemereiksaanIbu = PemeriksaanIbu::whereYear('tanggal_pemeriksaan' , $tahun)
            ->whereMonth('tanggal_pemeriksaan' , $i)->where('id_posyandu' , $posyandu)
            ->whereIn('jenis_pemeriksaan' , ['Pemeriksaan' , 'pemeriksaan'] )->count();
          $pemereiksaanLansia = PemeriksaanLansia::whereYear('tanggal_pemeriksaan' , $tahun)
            ->whereMonth('tanggal_pemeriksaan' , $i)->where('id_posyandu' , $posyandu)
            ->whereIn('jenis_pemeriksaan' , ['Pemeriksaan' , 'pemeriksaan'] )->count();
          
          $arr_chart_value['bumil'][] = $pemereiksaanIbu;
          $arr_chart_value['anak'][] = $pemereiksaanAnak;
          $arr_chart_value['lansia'][] = $pemereiksaanLansia;

        }

      }

      if($modelName === 'konsul'){
        for( $i = $startMonth; $i <= $endMonth; $i++ ){
          $arr_chart['labels'][] = $month[$i];
          
          $pemereiksaanAnak = PemeriksaanAnak::whereYear('tanggal_pemeriksaan' , $tahun)
            ->whereMonth('tanggal_pemeriksaan' , $i)->where('id_posyandu' , $posyandu)
            ->whereIn('jenis_pemeriksaan' , ['Konsultasi' , 'konsultasi'] )->count();
          $pemereiksaanIbu = PemeriksaanIbu::whereYear('tanggal_pemeriksaan' , $tahun)
            ->whereMonth('tanggal_pemeriksaan' , $i)->where('id_posyandu' , $posyandu)
            ->whereIn('jenis_pemeriksaan' , ['Konsultasi' , 'konsultasi'] )->count();
          $pemereiksaanLansia = PemeriksaanLansia::whereYear('tanggal_pemeriksaan' , $tahun)
            ->whereMonth('tanggal_pemeriksaan' , $i)->where('id_posyandu' , $posyandu)
            ->whereIn('jenis_pemeriksaan' , ['Konsultasi' , 'konsultasi'] )->count();
          
          $arr_chart_value['bumil'][] = $pemereiksaanIbu;
          $arr_chart_value['anak'][] = $pemereiksaanAnak;
          $arr_chart_value['lansia'][] = $pemereiksaanLansia;

        }
      }

      if($modelName === 'vitamin'){
        for( $i = $startMonth; $i <= $endMonth; $i++ ){
          $arr_chart['labels'][] = $month[$i];

          $pemberianVitamin = PemberianVitamin::whereYear('tanggal_pemberian' , $tahun)
            ->whereMonth('tanggal_pemberian' , $i)->with('user')->get();
          
          if($pemberianVitamin->isEmpty() === false){
            $tmp_arr = ['bumil' => [] , 'anak' => [] , 'lansia' => []];
            foreach($pemberianVitamin as $user){

              if($user->user->ibu) {
                $tmp_arr['bumil'][] = $user;
              }else if($user->user->anak){
                $tmp_arr['anak'][] = $user;
              }else if($user->user->lansia){
                $tmp_arr['lansia'][] = $user;
              }

            }

            $arr_chart_value['bumil'][] = count($tmp_arr['bumil']);
            $arr_chart_value['anak'][] = count($tmp_arr['anak']);
            $arr_chart_value['lansia'][] = count($tmp_arr['lansia']);

          }else{
            $arr_chart_value['bumil'][] = 0;
            $arr_chart_value['lansia'][] = 0;
            $arr_chart_value['anak'][] = 0;
          }

        }
      }


      if($modelName === 'imunisasi'){
        for( $i = $startMonth; $i <= $endMonth; $i++ ){
          $arr_chart['labels'][] = $month[$i];

          $pemberianImunisasi = PemberianImunisasi::whereYear('tanggal_imunisasi' , $tahun)
            ->whereMonth('tanggal_imunisasi' , $i)->with('user')->get();
          
          if($pemberianImunisasi->isEmpty() === false){
            $tmp_arr = ['bumil' => [] , 'anak' => [] , 'lansia' => []];
            foreach($pemberianImunisasi as $user){

              if($user->user->ibu) {
                $tmp_arr['bumil'][] = $user;
              }else if($user->user->anak){
                $tmp_arr['anak'][] = $user;
              }else if($user->user->lansia){
                $tmp_arr['lansia'][] = $user;
              }

            }

            $arr_chart_value['bumil'][] = count($tmp_arr['bumil']);
            $arr_chart_value['anak'][] = count($tmp_arr['anak']);
            $arr_chart_value['lansia'][] = count($tmp_arr['lansia']);

          }else{
            $arr_chart_value['bumil'][] = 0;
            $arr_chart_value['lansia'][] = 0;
            $arr_chart_value['anak'][] = 0;
          }
            
        }
        
      }

      $arr_chart['datasets'] = [
        [
          'label' => 'Ibu Hamil',
          'backgroundColor' => '#de2141',
          'data' => $arr_chart_value['bumil']
        ],
        [
          'label' => 'Lansia',
          'backgroundColor' => '#4d4d4d',
          'data'=> $arr_chart_value['lansia']
        ],
        [
          'label' => 'Anak',
          'backgroundColor' => '#15d128',
          'data' => $arr_chart_value['anak']
        ],
      ];

      return response()->json( $arr_chart ,200);

    }

    public function ajaxcharttahunan(Request $request){
      
      $arr_chart = [];
      $arr_chart_value = [];

      $startYear = $request->starttahun;
      $endYear = $request->endtahun;
      $posyandu = $request->posyandu;
      $modelName = $request->model;

      if($modelName === 'pemeriksaan'){
        
        for( $i = $startYear; $i <= $endYear; $i++ ){
          $arr_chart['labels'][] = $i;
          
          $pemereiksaanAnak = PemeriksaanAnak::whereYear('tanggal_pemeriksaan' , $i)
            ->where('id_posyandu' , $posyandu)->whereIn('jenis_pemeriksaan' , ['Pemeriksaan' , 'pemeriksaan'] )
            ->count();
          $pemereiksaanIbu = PemeriksaanIbu::whereYear('tanggal_pemeriksaan' , $i)
            ->where('id_posyandu' , $posyandu)->whereIn('jenis_pemeriksaan' , ['Pemeriksaan' , 'pemeriksaan'] )
            ->count();
          $pemereiksaanLansia = PemeriksaanLansia::whereYear('tanggal_pemeriksaan' , $i)
            ->where('id_posyandu' , $posyandu)->whereIn('jenis_pemeriksaan' , ['Pemeriksaan' , 'pemeriksaan'] )
            ->count();
          
          $arr_chart_value['bumil'][] = $pemereiksaanIbu;
          $arr_chart_value['anak'][] = $pemereiksaanAnak;
          $arr_chart_value['lansia'][] = $pemereiksaanLansia;

        }

      }

      if($modelName === 'konsul'){
        for( $i = $startYear; $i <= $endYear; $i++ ){
          $arr_chart['labels'][] = $i;
          
          $pemereiksaanAnak = PemeriksaanAnak::whereYear('tanggal_pemeriksaan' , $i)
            ->where('id_posyandu' , $posyandu)
            ->whereIn('jenis_pemeriksaan' , ['Konsultasi' , 'konsultasi'] )->count();
          $pemereiksaanIbu = PemeriksaanIbu::whereYear('tanggal_pemeriksaan' , $i)
            ->where('id_posyandu' , $posyandu)
            ->whereIn('jenis_pemeriksaan' , ['Konsultasi' , 'konsultasi'] )->count();
          $pemereiksaanLansia = PemeriksaanLansia::whereYear('tanggal_pemeriksaan' , $i)
            ->whereMonth('tanggal_pemeriksaan' , $i)->where('id_posyandu' , $posyandu)
            ->whereIn('jenis_pemeriksaan' , ['Konsultasi' , 'konsultasi'] )->count();
          
          $arr_chart_value['bumil'][] = $pemereiksaanIbu;
          $arr_chart_value['anak'][] = $pemereiksaanAnak;
          $arr_chart_value['lansia'][] = $pemereiksaanLansia;

        }
      }

      if($modelName === 'vitamin'){
        for( $i = $startYear; $i <= $endYear; $i++ ){
          $arr_chart['labels'][] = $i;

          $pemberianVitamin = PemberianVitamin::whereYear('tanggal_pemberian' , $i)
            ->with('user')->get();
          
          if($pemberianVitamin->isEmpty() === false){
            $tmp_arr = ['bumil' => [] , 'anak' => [] , 'lansia' => []];
            foreach($pemberianVitamin as $user){

              if($user->user->ibu) {
                $tmp_arr['bumil'][] = $user;
              }else if($user->user->anak){
                $tmp_arr['anak'][] = $user;
              }else if($user->user->lansia){
                $tmp_arr['lansia'][] = $user;
              }

            }

            $arr_chart_value['bumil'][] = count($tmp_arr['bumil']);
            $arr_chart_value['anak'][] = count($tmp_arr['anak']);
            $arr_chart_value['lansia'][] = count($tmp_arr['lansia']);

          }else{
            $arr_chart_value['bumil'][] = 0;
            $arr_chart_value['lansia'][] = 0;
            $arr_chart_value['anak'][] = 0;
          }

        }
      }


      if($modelName === 'imunisasi'){
        for( $i = $startYear; $i <= $endYear; $i++ ){
          $arr_chart['labels'][] = $i;

          $pemberianImunisasi = PemberianImunisasi::whereYear('tanggal_imunisasi' , $i)
            ->with('user')->get();
          
          if($pemberianImunisasi->isEmpty() === false){
            $tmp_arr = ['bumil' => [] , 'anak' => [] , 'lansia' => []];
            foreach($pemberianImunisasi as $user){

              if($user->user->ibu) {
                $tmp_arr['bumil'][] = $user;
              }else if($user->user->anak){
                $tmp_arr['anak'][] = $user;
              }else if($user->user->lansia){
                $tmp_arr['lansia'][] = $user;
              }

            }

            $arr_chart_value['bumil'][] = count($tmp_arr['bumil']);
            $arr_chart_value['anak'][] = count($tmp_arr['anak']);
            $arr_chart_value['lansia'][] = count($tmp_arr['lansia']);

          }else{
            $arr_chart_value['bumil'][] = 0;
            $arr_chart_value['lansia'][] = 0;
            $arr_chart_value['anak'][] = 0;
          }
            
        }
        
      }

      $arr_chart['datasets'] = [
        [
          'label' => 'Ibu Hamil',
          'backgroundColor' => '#de2141',
          'data' => $arr_chart_value['bumil']
        ],
        [
          'label' => 'Lansia',
          'backgroundColor' => '#4d4d4d',
          'data'=> $arr_chart_value['lansia']
        ],
        [
          'label' => 'Anak',
          'backgroundColor' => '#15d128',
          'data' => $arr_chart_value['anak']
        ],
      ];

      return response()->json( $arr_chart ,200);

    }

    public function loadchartkegiatan(Request $request){
      
      $arr_chart = [];
      $kegiatan = new Kegiatan;

      $arr_chart['labels'] = [
        'Jan',
        'Feb',
        'Mar',
        'Apr',
        'May',
        'Jun',
        'Jul',
        'Aug',
        'Sep',
        'Oct',
        'Nov',
        'Des'
      ];

      $thisYear = date('Y');

      if( $request->tk == 1 ) {
        $posyandu = new Posyandu;
        $id = auth('admin')->user()->nakes->id;
        $posyandu = $posyandu->whereHas('nakesPosyandu' , function($nakes) use ($id) {
          $nakes->where('id' , $id);
        })->get();

        foreach($posyandu as $posyandu_){
          foreach (array_keys($arr_chart['labels']) as $month){

            $monthIndex = $month < 10 ? '0'. ($month+1) : ($month+1);
    
            $queryMonth = $kegiatan->whereYear( 'start_at' , $thisYear )
              ->whereMonth('start_at' ,  $monthIndex)
              ->where('id_posyandu' , $posyandu_->id);
            
            $queryMonth = $queryMonth->withTrashed()->get();
            
            if($queryMonth->isEmpty() === false){
              $temp_arr = [ 'cancel' => [] , 'passed' => [] , 'not_yet' => [] , 'in_progress' => [] ];
              foreach( $queryMonth as $kegiatan_){
                if($kegiatan_->trashed()){
                 $temp_arr['cancel'][] = $kegiatan_;
                }else if ( $kegiatan_->end_at < date('Y-m-d') ){
                  $temp_arr['passed'][] = $kegiatan_;
                }else if ($kegiatan_->start_at > date('Y-m-d')) {
                  $temp_arr['not_yet'][] = $kegiatan_;
                }else{
                  $temp_arr['in_progress'][] = $kegiatan_;
                }
              }
              $arr_chart_value['cancel'][] = count($temp_arr['cancel']) ?? 0;
              $arr_chart_value['passed'][] = count($temp_arr['passed']) ?? 0;
              $arr_chart_value['not_yet'][] = count($temp_arr['not_yet']) ?? 0;
              $arr_chart_value['in_progress'][] = count($temp_arr['in_progress']) ?? 0;
            }else{
              $arr_chart_value['cancel'][] = 0;
              $arr_chart_value['passed'][] = 0;
              $arr_chart_value['not_yet'][] = 0;
              $arr_chart_value['in_progress'][] = 0;
            }
    
          }
        }

      }else{
        foreach (array_keys($arr_chart['labels']) as $month){

          $monthIndex = $month < 10 ? '0'. ($month+1) : ($month+1);
  
          $queryMonth = $kegiatan->whereYear( 'start_at' , $thisYear )
            ->whereMonth('start_at' ,  $monthIndex);
          
          if($request->posyandu !== null ){
            $queryMonth = $queryMonth->where('id_posyandu' , $request->posyandu);
          }
          
          $queryMonth = $queryMonth->withTrashed()->get();

          if($queryMonth->isEmpty() === false){
            $temp_arr = [ 'cancel' => [] , 'passed' => [] , 'not_yet' => [] , 'in_progress' => [] ];
            foreach( $queryMonth as $kegiatan_){
              if($kegiatan_->trashed()){
               $temp_arr['cancel'][] = $kegiatan_;
              }else if ( $kegiatan_->end_at < date('Y-m-d') ){
                $temp_arr['passed'][] = $kegiatan_;
              }else if ($kegiatan_->start_at > date('Y-m-d')) {
                $temp_arr['not_yet'][] = $kegiatan_;
              }else{
                $temp_arr['in_progress'][] = $kegiatan_;
              }
            }
            $arr_chart_value['cancel'][] = count($temp_arr['cancel']) ?? 0;
            $arr_chart_value['passed'][] = count($temp_arr['passed']) ?? 0;
            $arr_chart_value['not_yet'][] = count($temp_arr['not_yet']) ?? 0;
            $arr_chart_value['in_progress'][] = count($temp_arr['in_progress']) ?? 0;
          }else{
            $arr_chart_value['cancel'][] = 0;
            $arr_chart_value['passed'][] = 0;
            $arr_chart_value['not_yet'][] = 0;
            $arr_chart_value['in_progress'][] = 0;
          }
  
        }
  
      }

      
      $arr_chart['datasets'] = [
        [
          'label' => 'Batal',
          'backgroundColor' => '#de2141',
          'data' => $arr_chart_value['cancel']
        ],
        [
          'label' => 'Terlaksana',
          'backgroundColor' => '#06c710',
          'data'=> $arr_chart_value['passed']
        ],
        [
          'label' => 'Belum Terlaksana',
          'backgroundColor' => '#c5c9c6',
          'data' => $arr_chart_value['not_yet']
        ],
        [
          'label' => 'Dalam Pelaksanaan',
          'backgroundColor' => '#e8e161',
          'data' => $arr_chart_value['in_progress']
        ]
      ];

      return response()->json( $arr_chart , 200);

    }

    public function loadchartbulanan(Request $request){
      $arr_chart = [];
      $arr_chart_value = [];

      $month = [
        'Jan',
        'Feb',
        'Mar',
        'Apr',
        'May',
        'Jun',
        'Jul',
        'Aug',
        'Sep',
        'Oct',
        'Nov',
        'Des'
      ];
      $arr_chart['labels'] = $month;
      $tahun = date('Y');
      $modelName = $request->model;

      if($modelName === 'pemeriksaan'){
        
        if( $request->tk == 1 ){
          $posyandu = new Posyandu;
          $id = auth('admin')->user()->nakes->id;
          $posyandu = $posyandu->whereHas('nakesPosyandu' , function($nakes) use ($id) {
            $nakes->where('id' , $id);
          })->get();

          foreach($posyandu as $posyandu_){
            foreach (array_keys($arr_chart['labels']) as $month){
          
              $monthIndex = $month < 10 ? '0'. ($month+1) : ($month+1);
              $idpos = $posyandu_->id;
              
              $pemereiksaanAnak = PemeriksaanAnak::whereYear('tanggal_pemeriksaan' , $tahun)
                ->whereMonth('tanggal_pemeriksaan' , $monthIndex)
                ->whereIn('jenis_pemeriksaan' , ['Pemeriksaan' , 'pemeriksaan'] )
                ->where('id_posyandu' , $idpos)->count();
              $pemereiksaanIbu = PemeriksaanIbu::whereYear('tanggal_pemeriksaan' , $tahun)
                ->whereMonth('tanggal_pemeriksaan' , $monthIndex)
                ->whereIn('jenis_pemeriksaan' , ['Pemeriksaan' , 'pemeriksaan'] )
                ->where('id_posyandu' , $idpos)->count();
              $pemereiksaanLansia = PemeriksaanLansia::whereYear('tanggal_pemeriksaan' , $tahun)
                ->whereMonth('tanggal_pemeriksaan' , $monthIndex)
                ->whereIn('jenis_pemeriksaan' , ['Pemeriksaan' , 'pemeriksaan'] )
                ->where('id_posyandu' , $idpos)->count();
              
              $arr_chart_value['bumil'][] = $pemereiksaanIbu;
              $arr_chart_value['anak'][] = $pemereiksaanAnak;
              $arr_chart_value['lansia'][] = $pemereiksaanLansia;

            }
          }
        }else{
          foreach (array_keys($arr_chart['labels']) as $month){
          
            $monthIndex = $month < 10 ? '0'. ($month+1) : ($month+1);
  
            $pemereiksaanAnak = PemeriksaanAnak::whereYear('tanggal_pemeriksaan' , $tahun)
              ->whereMonth('tanggal_pemeriksaan' , $monthIndex)
              ->whereIn('jenis_pemeriksaan' , ['Pemeriksaan' , 'pemeriksaan'] )->count();
            $pemereiksaanIbu = PemeriksaanIbu::whereYear('tanggal_pemeriksaan' , $tahun)
              ->whereMonth('tanggal_pemeriksaan' , $monthIndex)
              ->whereIn('jenis_pemeriksaan' , ['Pemeriksaan' , 'pemeriksaan'] )->count();
            $pemereiksaanLansia = PemeriksaanLansia::whereYear('tanggal_pemeriksaan' , $tahun)
              ->whereMonth('tanggal_pemeriksaan' , $monthIndex)
              ->whereIn('jenis_pemeriksaan' , ['Pemeriksaan' , 'pemeriksaan'] )->count();
            
            $arr_chart_value['bumil'][] = $pemereiksaanIbu;
            $arr_chart_value['anak'][] = $pemereiksaanAnak;
            $arr_chart_value['lansia'][] = $pemereiksaanLansia;
          }
        }

      }

      if($modelName === 'konsul'){

        if( $request->tk == 1 ){
          $posyandu = new Posyandu;
          $id = auth('admin')->user()->nakes->id;
          $posyandu = $posyandu->whereHas('nakesPosyandu' , function($nakes) use ($id) {
            $nakes->where('id' , $id);
          })->get();

          foreach($posyandu as $posyandu_){
            foreach (array_keys($arr_chart['labels']) as $month){
          
              $monthIndex = $month < 10 ? '0'. ($month+1) : ($month+1);
              $idpos = $posyandu_->id;
              
              $pemereiksaanAnak = PemeriksaanAnak::whereYear('tanggal_pemeriksaan' , $tahun)
                ->whereMonth('tanggal_pemeriksaan' , $monthIndex)
                ->whereIn('jenis_pemeriksaan' , ['Konsultasi' , 'konsultasi'] )
                ->where('id_posyandu' , $idpos)->count();
              $pemereiksaanIbu = PemeriksaanIbu::whereYear('tanggal_pemeriksaan' , $tahun)
                ->whereMonth('tanggal_pemeriksaan' , $monthIndex)
                ->whereIn('jenis_pemeriksaan' , ['Konsultasi' , 'konsultasi'] )
                ->where('id_posyandu' , $idpos)->count();
              $pemereiksaanLansia = PemeriksaanLansia::whereYear('tanggal_pemeriksaan' , $tahun)
                ->whereMonth('tanggal_pemeriksaan' , $monthIndex)
                ->whereIn('jenis_pemeriksaan' , ['Konsultasi' , 'konsultasi'] )
                ->where('id_posyandu' , $idpos)->count();
            
              $arr_chart_value['bumil'][] = $pemereiksaanIbu;
              $arr_chart_value['anak'][] = $pemereiksaanAnak;
              $arr_chart_value['lansia'][] = $pemereiksaanLansia;

            }
          }
        }else{
          foreach (array_keys($arr_chart['labels']) as $month){
          
            $monthIndex = $month < 10 ? '0'. ($month+1) : ($month+1);
            
            $pemereiksaanAnak = PemeriksaanAnak::whereYear('tanggal_pemeriksaan' , $tahun)
              ->whereMonth('tanggal_pemeriksaan' , $monthIndex)
              ->whereIn('jenis_pemeriksaan' , ['Konsultasi' , 'konsultasi'] )->count();
            $pemereiksaanIbu = PemeriksaanIbu::whereYear('tanggal_pemeriksaan' , $tahun)
              ->whereMonth('tanggal_pemeriksaan' , $monthIndex)
              ->whereIn('jenis_pemeriksaan' , ['Konsultasi' , 'konsultasi'] )->count();
            $pemereiksaanLansia = PemeriksaanLansia::whereYear('tanggal_pemeriksaan' , $tahun)
              ->whereMonth('tanggal_pemeriksaan' , $monthIndex)
              ->whereIn('jenis_pemeriksaan' , ['Konsultasi' , 'konsultasi'] )->count();

            $arr_chart_value['bumil'][] = $pemereiksaanIbu;
            $arr_chart_value['anak'][] = $pemereiksaanAnak;
            $arr_chart_value['lansia'][] = $pemereiksaanLansia;
      
          }
        }
        
      }

      if($modelName === 'vitamin'){

        if( $request->tk == 1 ){
          $posyandu = new Posyandu;
          $id = auth('admin')->user()->nakes->id;
          $posyandu = $posyandu->whereHas('nakesPosyandu' , function($nakes) use ($id) {
            $nakes->where('id' , $id);
          })->get();

          foreach($posyandu as $posyandu_){
            foreach (array_keys($arr_chart['labels']) as $month){
          
              $monthIndex = $month < 10 ? '0'. ($month+1) : ($month+1);
              $idpos = $posyandu_->id;

              $pemberianVitamin = PemberianVitamin::whereYear('tanggal_pemberian' , $tahun)
                ->whereMonth('tanggal_pemberian' , $monthIndex)->where('id_posyandu' , $idpos)->with('user')->get();
              
              if($pemberianVitamin->isEmpty() === false){
                $tmp_arr = ['bumil' => [] , 'anak' => [] , 'lansia' => []];
                foreach($pemberianVitamin as $user){
    
                  if($user->user->ibu) {
                    $tmp_arr['bumil'][] = $user;
                  }else if($user->user->anak){
                    $tmp_arr['anak'][] = $user;
                  }else if($user->user->lansia){
                    $tmp_arr['lansia'][] = $user;
                  }
    
                }
    
                $arr_chart_value['bumil'][] = count($tmp_arr['bumil']);
                $arr_chart_value['anak'][] = count($tmp_arr['anak']);
                $arr_chart_value['lansia'][] = count($tmp_arr['lansia']);
    
              }else{
                $arr_chart_value['bumil'][] = 0;
                $arr_chart_value['lansia'][] = 0;
                $arr_chart_value['anak'][] = 0;
              }
    
            }
          }
        }else{
          foreach (array_keys($arr_chart['labels']) as $month){
          
            $monthIndex = $month < 10 ? '0'. ($month+1) : ($month+1);
  
            $pemberianVitamin = PemberianVitamin::whereYear('tanggal_pemberian' , $tahun)
              ->whereMonth('tanggal_pemberian' , $monthIndex)->with('user')->get();
            
            if($pemberianVitamin->isEmpty() === false){
              $tmp_arr = ['bumil' => [] , 'anak' => [] , 'lansia' => []];
              foreach($pemberianVitamin as $user){
  
                if($user->user->ibu) {
                  $tmp_arr['bumil'][] = $user;
                }else if($user->user->anak){
                  $tmp_arr['anak'][] = $user;
                }else if($user->user->lansia){
                  $tmp_arr['lansia'][] = $user;
                }
  
              }
  
              $arr_chart_value['bumil'][] = count($tmp_arr['bumil']);
              $arr_chart_value['anak'][] = count($tmp_arr['anak']);
              $arr_chart_value['lansia'][] = count($tmp_arr['lansia']);
  
            }else{
              $arr_chart_value['bumil'][] = 0;
              $arr_chart_value['lansia'][] = 0;
              $arr_chart_value['anak'][] = 0;
            }
  
          }
        }
      }


      if($modelName === 'imunisasi'){

        if( $request->tk == 1 ){
          $posyandu = new Posyandu;
          $id = auth('admin')->user()->nakes->id;
          $posyandu = $posyandu->whereHas('nakesPosyandu' , function($nakes) use ($id) {
            $nakes->where('id' , $id);
          })->get();

          foreach($posyandu as $posyandu_){
            foreach (array_keys($arr_chart['labels']) as $month){
          
              $monthIndex = $month < 10 ? '0'. ($month+1) : ($month+1);
              $idpos = $posyandu_->id;
              
              $pemberianImunisasi = PemberianImunisasi::whereYear('tanggal_imunisasi' , $tahun)
                ->whereMonth('tanggal_imunisasi' , $monthIndex)->where('id_posyandu' , $idpos)->with('user')->get();
              
              if($pemberianImunisasi->isEmpty() === false){
                $tmp_arr = ['bumil' => [] , 'anak' => [] , 'lansia' => []];
                foreach($pemberianImunisasi as $user){
    
                  if($user->user->ibu) {
                    $tmp_arr['bumil'][] = $user;
                  }else if($user->user->anak){
                    $tmp_arr['anak'][] = $user;
                  }else if($user->user->lansia){
                    $tmp_arr['lansia'][] = $user;
                  }
    
                }
    
                $arr_chart_value['bumil'][] = count($tmp_arr['bumil']);
                $arr_chart_value['anak'][] = count($tmp_arr['anak']);
                $arr_chart_value['lansia'][] = count($tmp_arr['lansia']);
    
              }else{
                $arr_chart_value['bumil'][] = 0;
                $arr_chart_value['lansia'][] = 0;
                $arr_chart_value['anak'][] = 0;
              }
                
            }
          }
        }else{
          foreach (array_keys($arr_chart['labels']) as $month){
          
            $monthIndex = $month < 10 ? '0'. ($month+1) : ($month+1);
  
            $pemberianImunisasi = PemberianImunisasi::whereYear('tanggal_imunisasi' , $tahun)
              ->whereMonth('tanggal_imunisasi' , $monthIndex)->with('user')->get();
            
            if($pemberianImunisasi->isEmpty() === false){
              $tmp_arr = ['bumil' => [] , 'anak' => [] , 'lansia' => []];
              foreach($pemberianImunisasi as $user){
  
                if($user->user->ibu) {
                  $tmp_arr['bumil'][] = $user;
                }else if($user->user->anak){
                  $tmp_arr['anak'][] = $user;
                }else if($user->user->lansia){
                  $tmp_arr['lansia'][] = $user;
                }
  
              }
  
              $arr_chart_value['bumil'][] = count($tmp_arr['bumil']);
              $arr_chart_value['anak'][] = count($tmp_arr['anak']);
              $arr_chart_value['lansia'][] = count($tmp_arr['lansia']);
  
            }else{
              $arr_chart_value['bumil'][] = 0;
              $arr_chart_value['lansia'][] = 0;
              $arr_chart_value['anak'][] = 0;
            }
              
          }
        }
        
      }

      $arr_chart['datasets'] = [
        [
          'label' => 'Ibu Hamil',
          'backgroundColor' => '#de2141',
          'data' => $arr_chart_value['bumil']
        ],
        [
          'label' => 'Lansia',
          'backgroundColor' => '#4d4d4d',
          'data'=> $arr_chart_value['lansia']
        ],
        [
          'label' => 'Anak',
          'backgroundColor' => '#15d128',
          'data' => $arr_chart_value['anak']
        ],
      ];

      return response()->json( $arr_chart ,200);
    }

    public function loadcharttahunan(Request $request){
      $arr_chart = [];
      $arr_chart_value = [];
      $tahun = date('Y');
      $arr_chart['labels'] = [ 'Ibu Hamil' ,'Lansia' ,'Anak' ];

      $modelName = $request->model;

      if($modelName === 'pemeriksaan'){
        if( $request->tk == 1 ){
          $posyandu = new Posyandu;
          $id = auth('admin')->user()->nakes->id;
          $posyandu = $posyandu->whereHas('nakesPosyandu' , function($nakes) use ($id) {
            $nakes->where('id' , $id);
          })->get();

          foreach($posyandu as $posyandu_){
            foreach ($arr_chart['labels'] as $keyLabel){
              $data = 0;
              $idPos = $posyandu_->id;
              if($keyLabel === 'Ibu Hamil'){
                $data = PemeriksaanAnak::whereYear('tanggal_pemeriksaan' , $tahun)
                ->whereIn('jenis_pemeriksaan' , ['Pemeriksaan' , 'pemeriksaan'] )
                ->where('id_posyandu' , $idPos)->count();
              }else if($keyLabel === 'Lansia'){
                $data = PemeriksaanIbu::whereYear('tanggal_pemeriksaan' , $tahun)
                ->whereIn('jenis_pemeriksaan' , ['Pemeriksaan' , 'pemeriksaan'] )
                ->where('id_posyandu' , $idPos)->count();;
              }else{
                $data = PemeriksaanLansia::whereYear('tanggal_pemeriksaan' , $tahun)
                  ->whereIn('jenis_pemeriksaan' , ['Pemeriksaan' , 'pemeriksaan'] )
                  ->where('id_posyandu' , $idPos)->count();;
              }
              
              $arr_chart_value['data'][] = $data;
    
            }
          }
        }else{
          foreach ($arr_chart['labels'] as $keyLabel){
            $data = 0;
  
            if($keyLabel === 'Ibu Hamil'){
              $data = PemeriksaanAnak::whereYear('tanggal_pemeriksaan' , $tahun)
              ->whereIn('jenis_pemeriksaan' , ['Pemeriksaan' , 'pemeriksaan'] )->count();
            }else if($keyLabel === 'Lansia'){
              $data = PemeriksaanIbu::whereYear('tanggal_pemeriksaan' , $tahun)
              ->whereIn('jenis_pemeriksaan' , ['Pemeriksaan' , 'pemeriksaan'] )->count();
            }else{
              $data = PemeriksaanLansia::whereYear('tanggal_pemeriksaan' , $tahun)
                ->whereIn('jenis_pemeriksaan' , ['Pemeriksaan' , 'pemeriksaan'] )->count();
            }
            
            $arr_chart_value['data'][] = $data;
  
          }
        }
      }

      if($modelName === 'konsul'){

        if( $request->tk == 1 ){
          $posyandu = new Posyandu;
          $id = auth('admin')->user()->nakes->id;
          $posyandu = $posyandu->whereHas('nakesPosyandu' , function($nakes) use ($id) {
            $nakes->where('id' , $id);
          })->get();
          foreach($posyandu as $posyandu_){
            
            foreach ($arr_chart['labels'] as $keyLabel){
          
              $data = 0;
              $idPos = $posyandu_->id;
              
              if($keyLabel === 'Ibu Hamil'){
                $data = PemeriksaanAnak::whereYear('tanggal_pemeriksaan' , $tahun)
                  ->whereIn('jenis_pemeriksaan' , ['Konsultasi' , 'konsultasi'] )
                  ->where('id_posyandu' , $idPos)->count();
              }else if($keyLabel === 'Lansia'){
                $data = PemeriksaanIbu::whereYear('tanggal_pemeriksaan' , $tahun)
                  ->whereIn('jenis_pemeriksaan' , ['Konsultasi' , 'konsultasi'] )
                  ->where('id_posyandu' , $idPos)->count();
              }else{
                $data = PemeriksaanLansia::whereYear('tanggal_pemeriksaan' , $tahun)
                  ->whereIn('jenis_pemeriksaan' , ['Konsultasi' , 'konsultasi'] )
                  ->where('id_posyandu' , $idPos)->count();
              }
              
              $arr_chart_value['data'][] = $data;
    
            }
          }
        }else{
          foreach ($arr_chart['labels'] as $keyLabel){
          
            $data = 0;
            
            if($keyLabel === 'Ibu Hamil'){
              $data = PemeriksaanAnak::whereYear('tanggal_pemeriksaan' , $tahun)
                ->whereIn('jenis_pemeriksaan' , ['Konsultasi' , 'konsultasi'] )->count();
            }else if($keyLabel === 'Lansia'){
              $data = PemeriksaanIbu::whereYear('tanggal_pemeriksaan' , $tahun)
                ->whereIn('jenis_pemeriksaan' , ['Konsultasi' , 'konsultasi'] )->count();
            }else{
              $data = PemeriksaanLansia::whereYear('tanggal_pemeriksaan' , $tahun)
                ->whereIn('jenis_pemeriksaan' , ['Konsultasi' , 'konsultasi'] )->count();
            }
            
            $arr_chart_value['data'][] = $data;
  
          }
        }
      }

      if($modelName === 'vitamin'){

        if( $request->tk == 1 ){
          $posyandu = new Posyandu;
          $id = auth('admin')->user()->nakes->id;
          $posyandu = $posyandu->whereHas('nakesPosyandu' , function($nakes) use ($id) {
            $nakes->where('id' , $id);
          })->get();
          
          foreach($posyandu as $posyandu_){
            foreach ( $arr_chart['labels'] as $keyLabel){
              $idPos = $posyandu_->id;
              $pemberianVitamin = PemberianVitamin::whereYear('tanggal_pemberian' , $tahun)
              ->where('id_posyandu' , $idPos)->with('user')->get();
              
              if($pemberianVitamin->isEmpty() === false){
                $tmp_arr = ['bumil' => [] , 'anak' => [] , 'lansia' => []];
                foreach($pemberianVitamin as $user){
    
                  if($user->user->ibu) {
                    $tmp_arr['bumil'][] = $user;
                  }else if($user->user->anak){
                    $tmp_arr['anak'][] = $user;
                  }else if($user->user->lansia){
                    $tmp_arr['lansia'][] = $user;
                  }
    
                }
    
                if($keyLabel === 'Ibu Hamil'){
                  $arr_chart_value['data'][] = count($tmp_arr['bumil']);
                }else if($keyLabel === 'Lansia'){
                  $arr_chart_value['data'][] = count($tmp_arr['anak']);
                }else{
                  $arr_chart_value['data'][] = count($tmp_arr['lansia']);
                }
    
              }else{
                $arr_chart_value['data'][] = 0;
              }
    
            }
          }
        }else{
          foreach ( $arr_chart['labels'] as $keyLabel){
          
            $pemberianVitamin = PemberianVitamin::whereYear('tanggal_pemberian' , $tahun)->with('user')->get();
            
            if($pemberianVitamin->isEmpty() === false){
              $tmp_arr = ['bumil' => [] , 'anak' => [] , 'lansia' => []];
              foreach($pemberianVitamin as $user){
  
                if($user->user->ibu) {
                  $tmp_arr['bumil'][] = $user;
                }else if($user->user->anak){
                  $tmp_arr['anak'][] = $user;
                }else if($user->user->lansia){
                  $tmp_arr['lansia'][] = $user;
                }
  
              }
  
              if($keyLabel === 'Ibu Hamil'){
                $arr_chart_value['data'][] = count($tmp_arr['bumil']);
              }else if($keyLabel === 'Lansia'){
                $arr_chart_value['data'][] = count($tmp_arr['anak']);
              }else{
                $arr_chart_value['data'][] = count($tmp_arr['lansia']);
              }
  
            }else{
              $arr_chart_value['data'][] = 0;
            }
  
          }
        }

      }

      if($modelName === 'imunisasi'){

        if( $request->tk == 1 ){
          $posyandu = new Posyandu;
          $id = auth('admin')->user()->nakes->id;
          $posyandu = $posyandu->whereHas('nakesPosyandu' , function($nakes) use ($id) {
            $nakes->where('id' , $id);
          })->get();

          foreach($posyandu as $posyandu_){
            foreach ($arr_chart['labels'] as $keyLabel){
              $idPos = $posyandu_->id;
              $pemberianImunisasi = PemberianImunisasi::whereYear('tanggal_imunisasi' , $tahun)
              ->where('id_posyandu' , $idPos)->with('user')->get();
              
              if($pemberianImunisasi->isEmpty() === false){
                $tmp_arr = ['bumil' => [] , 'anak' => [] , 'lansia' => []];
                foreach($pemberianImunisasi as $user){
    
                  if($user->user->ibu) {
                    $tmp_arr['bumil'][] = $user;
                  }else if($user->user->anak){
                    $tmp_arr['anak'][] = $user;
                  }else if($user->user->lansia){
                    $tmp_arr['lansia'][] = $user;
                  }
    
                }
    
                if($keyLabel === 'Ibu Hamil'){
                  $arr_chart_value['data'][] = count($tmp_arr['bumil']);
                }else if($keyLabel === 'Lansia'){
                  $arr_chart_value['data'][] = count($tmp_arr['anak']);
                }else{
                  $arr_chart_value['data'][] = count($tmp_arr['lansia']);
                }
    
              }else{
                $arr_chart_value['data'][] = 0;
              }
                
            }
          }
        }else{
          foreach ($arr_chart['labels'] as $keyLabel){

            $pemberianImunisasi = PemberianImunisasi::whereYear('tanggal_imunisasi' , $tahun)->with('user')->get();
            
            if($pemberianImunisasi->isEmpty() === false){
              $tmp_arr = ['bumil' => [] , 'anak' => [] , 'lansia' => []];
              foreach($pemberianImunisasi as $user){
  
                if($user->user->ibu) {
                  $tmp_arr['bumil'][] = $user;
                }else if($user->user->anak){
                  $tmp_arr['anak'][] = $user;
                }else if($user->user->lansia){
                  $tmp_arr['lansia'][] = $user;
                }
  
              }
  
              if($keyLabel === 'Ibu Hamil'){
                $arr_chart_value['data'][] = count($tmp_arr['bumil']);
              }else if($keyLabel === 'Lansia'){
                $arr_chart_value['data'][] = count($tmp_arr['anak']);
              }else{
                $arr_chart_value['data'][] = count($tmp_arr['lansia']);
              }
  
            }else{
              $arr_chart_value['data'][] = 0;
            }
              
          }
        }

      }

      $arr_chart['datasets'] = [
        [
          'label' => 'Laporan Tahunan',
          'backgroundColor' => '#de2141',
          'data' => $arr_chart_value['data']
        ],
      ];

      return response()->json( $arr_chart ,200);
    }

    private function getLastYear()
    {
      return (int) date( 'Y' , strtotime(Kegiatan::orderby('start_at', 'ASC')->first()->start_at) );
    }

    private function getCurrentYear()
    {
      return (int) date( 'Y' , strtotime(Kegiatan::orderby('start_at', 'DESC')->first()->start_at) ); 
    }

}