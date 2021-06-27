<?php

namespace App\Http\Controllers\Admin\Laporan;

use App\Http\Controllers\Controller;
use App\Kegiatan;
use App\NakesPosyandu;
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
        
        $posyandu = NakesPosyandu::where('id_nakes', $id)->with('posyandu')->get();

        foreach($posyandu as $posyandu_){
          $arr_posyandu[] = [
            'id' => $posyandu_->posyandu->id,
            'posyandu' => $posyandu_->posyandu->nama_posyandu
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
            ->whereMonth('tanggal_pemberian' , $i)->where('id_posyandu' , $posyandu )->with('user')->get();
          
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
            ->whereMonth('tanggal_imunisasi' , $i)->where('id_posyandu' , $posyandu )->with('user')->get();
          
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
            ->where('id_posyandu' , $posyandu)
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
            ->where('id_posyandu' , $posyandu)
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
            ->where('id_posyandu' , $posyandu)
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
      $kegiatan = new Kegiatan();

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
        $id = auth('admin')->user()->nakes->id;
        $arr_id = [];
        $posyandu = NakesPosyandu::where('id_nakes', $id)->with('posyandu')->get();
        
        foreach( $posyandu as $p ){
          $arr_id[] = $p->posyandu->id;
        }

        foreach (array_keys($arr_chart['labels']) as $month){

          $monthIndex = $month < 10 ? '0'. ($month+1) : ($month+1);
  
          $queryMonth = $kegiatan->whereYear( 'start_at' , $thisYear )
            ->whereMonth('start_at' ,  $monthIndex)
            ->whereIn('id_posyandu' , $arr_id);
          
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
      $defIdPos = $request->posyandu;
      $modelName = $request->model;

      if($modelName === 'pemeriksaan'){
        
        if( $request->tk == 1 ){
          $id = auth('admin')->user()->nakes->id;
          $arr_id = [];
          $posyandu = NakesPosyandu::where('id_nakes', $id)->with('posyandu')->get();
          
          foreach( $posyandu as $p ){
            $arr_id[] = $p->posyandu->id;
          }

          foreach (array_keys($arr_chart['labels']) as $month){
        
            $monthIndex = $month < 10 ? '0'. ($month+1) : ($month+1);
            
            $pemereiksaanAnak = PemeriksaanAnak::whereYear('tanggal_pemeriksaan' , $tahun)
              ->whereMonth('tanggal_pemeriksaan' , $monthIndex)
              ->whereIn('jenis_pemeriksaan' , ['Pemeriksaan' , 'pemeriksaan'] )
              ->whereIn('id_posyandu' , $arr_id)->count();
            $pemereiksaanIbu = PemeriksaanIbu::whereYear('tanggal_pemeriksaan' , $tahun)
              ->whereMonth('tanggal_pemeriksaan' , $monthIndex)
              ->whereIn('jenis_pemeriksaan' , ['Pemeriksaan' , 'pemeriksaan'] )
              ->whereIn('id_posyandu' , $arr_id)->count();
            $pemereiksaanLansia = PemeriksaanLansia::whereYear('tanggal_pemeriksaan' , $tahun)
              ->whereMonth('tanggal_pemeriksaan' , $monthIndex)
              ->whereIn('jenis_pemeriksaan' , ['Pemeriksaan' , 'pemeriksaan'] )
              ->whereIn('id_posyandu' , $arr_id)->count();

            $arr_chart_value['bumil'][] = $pemereiksaanIbu;
            $arr_chart_value['anak'][] = $pemereiksaanAnak;
            $arr_chart_value['lansia'][] = $pemereiksaanLansia;

          }

        }else{
          foreach (array_keys($arr_chart['labels']) as $month){
          
            $monthIndex = $month < 10 ? '0'. ($month+1) : ($month+1);
  
            $pemereiksaanAnak = PemeriksaanAnak::whereYear('tanggal_pemeriksaan' , $tahun)
              ->whereMonth('tanggal_pemeriksaan' , $monthIndex)
              ->whereIn('jenis_pemeriksaan' , ['Pemeriksaan' , 'pemeriksaan'] );
            $pemereiksaanIbu = PemeriksaanIbu::whereYear('tanggal_pemeriksaan' , $tahun)
              ->whereMonth('tanggal_pemeriksaan' , $monthIndex)
              ->whereIn('jenis_pemeriksaan' , ['Pemeriksaan' , 'pemeriksaan'] );
            $pemereiksaanLansia = PemeriksaanLansia::whereYear('tanggal_pemeriksaan' , $tahun)
              ->whereMonth('tanggal_pemeriksaan' , $monthIndex)
              ->whereIn('jenis_pemeriksaan' , ['Pemeriksaan' , 'pemeriksaan'] );

            if( $defIdPos != null ){
              $pemereiksaanAnak = $pemereiksaanAnak->where('id_posyandu' , $defIdPos);
              $pemereiksaanIbu = $pemereiksaanIbu->where('id_posyandu' , $defIdPos);
              $pemereiksaanLansia = $pemereiksaanLansia->where('id_posyandu' , $defIdPos);
            } 
              

            $arr_chart_value['bumil'][] = $pemereiksaanIbu->count();
            $arr_chart_value['anak'][] = $pemereiksaanAnak->count();
            $arr_chart_value['lansia'][] = $pemereiksaanLansia->count();
          }
        }

      }

      if($modelName === 'konsul'){

        if( $request->tk == 1 ){
          $id = auth('admin')->user()->nakes->id;
          $arr_id = [];
          $posyandu = NakesPosyandu::where('id_nakes', $id)->with('posyandu')->get();
          
          foreach( $posyandu as $p ){
            $arr_id[] = $p->posyandu->id;
          }

          foreach (array_keys($arr_chart['labels']) as $month){
        
            $monthIndex = $month < 10 ? '0'. ($month+1) : ($month+1);
            
            $pemereiksaanAnak = PemeriksaanAnak::whereYear('tanggal_pemeriksaan' , $tahun)
              ->whereMonth('tanggal_pemeriksaan' , $monthIndex)
              ->whereIn('jenis_pemeriksaan' , ['Konsultasi' , 'konsultasi'] )
              ->whereIn('id_posyandu' , $arr_id)->count();
            $pemereiksaanIbu = PemeriksaanIbu::whereYear('tanggal_pemeriksaan' , $tahun)
              ->whereMonth('tanggal_pemeriksaan' , $monthIndex)
              ->whereIn('jenis_pemeriksaan' , ['Konsultasi' , 'konsultasi'] )
              ->whereIn('id_posyandu' , $arr_id)->count();
            $pemereiksaanLansia = PemeriksaanLansia::whereYear('tanggal_pemeriksaan' , $tahun)
              ->whereMonth('tanggal_pemeriksaan' , $monthIndex)
              ->whereIn('jenis_pemeriksaan' , ['Konsultasi' , 'konsultasi'] )
              ->whereIn('id_posyandu' , $arr_id)->count();
          
            $arr_chart_value['bumil'][] = $pemereiksaanIbu;
            $arr_chart_value['anak'][] = $pemereiksaanAnak;
            $arr_chart_value['lansia'][] = $pemereiksaanLansia;

          }
        }else{
          foreach (array_keys($arr_chart['labels']) as $month){
          
            $monthIndex = $month < 10 ? '0'. ($month+1) : ($month+1);
            
            $pemereiksaanAnak = PemeriksaanAnak::whereYear('tanggal_pemeriksaan' , $tahun)
              ->whereMonth('tanggal_pemeriksaan' , $monthIndex)
              ->whereIn('jenis_pemeriksaan' , ['Konsultasi' , 'konsultasi'] );
            $pemereiksaanIbu = PemeriksaanIbu::whereYear('tanggal_pemeriksaan' , $tahun)
              ->whereMonth('tanggal_pemeriksaan' , $monthIndex)
              ->whereIn('jenis_pemeriksaan' , ['Konsultasi' , 'konsultasi'] );
            $pemereiksaanLansia = PemeriksaanLansia::whereYear('tanggal_pemeriksaan' , $tahun)
              ->whereMonth('tanggal_pemeriksaan' , $monthIndex)
              ->whereIn('jenis_pemeriksaan' , ['Konsultasi' , 'konsultasi'] );

              if( $defIdPos != null ){
                $pemereiksaanAnak = $pemereiksaanAnak->where('id_posyandu' , $defIdPos);
                $pemereiksaanIbu = $pemereiksaanIbu->where('id_posyandu' , $defIdPos);
                $pemereiksaanLansia = $pemereiksaanLansia->where('id_posyandu' , $defIdPos);
              } 
                
  
              $arr_chart_value['bumil'][] = $pemereiksaanIbu->count();
              $arr_chart_value['anak'][] = $pemereiksaanAnak->count();
              $arr_chart_value['lansia'][] = $pemereiksaanLansia->count();
      
          }
        }
        
      }

      if($modelName === 'vitamin'){

        if( $request->tk == 1 ){
          $id = auth('admin')->user()->nakes->id;
          $arr_id = [];
          $posyandu = NakesPosyandu::where('id_nakes', $id)->with('posyandu')->get();
          
          foreach( $posyandu as $p ){
            $arr_id[] = $p->posyandu->id;
          }

          foreach (array_keys($arr_chart['labels']) as $month){
        
            $monthIndex = $month < 10 ? '0'. ($month+1) : ($month+1);

            $pemberianVitamin = PemberianVitamin::whereYear('tanggal_pemberian' , $tahun)
              ->whereMonth('tanggal_pemberian' , $monthIndex)->whereIn('id_posyandu' , $arr_id)->with('user')->get();
            
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
        }else{
          foreach (array_keys($arr_chart['labels']) as $month){
          
            $monthIndex = $month < 10 ? '0'. ($month+1) : ($month+1);
  
            $pemberianVitamin = PemberianVitamin::whereYear('tanggal_pemberian' , $tahun)
              ->whereMonth('tanggal_pemberian' , $monthIndex);
            
            if($defIdPos != null){
              $pemberianVitamin = $pemberianVitamin->where('id_posyandu' , $defIdPos);
            }
            
            $pemberianVitamin = $pemberianVitamin->with('user')->get();

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
          $id = auth('admin')->user()->nakes->id;
          $arr_id = [];
          $posyandu = NakesPosyandu::where('id_nakes', $id)->with('posyandu')->get();
          
          foreach( $posyandu as $p ){
            $arr_id[] = $p->posyandu->id;
          }
          
          foreach (array_keys($arr_chart['labels']) as $month){
        
            $monthIndex = $month < 10 ? '0'. ($month+1) : ($month+1);
            
            $pemberianImunisasi = PemberianImunisasi::whereYear('tanggal_imunisasi' , $tahun)
              ->whereMonth('tanggal_imunisasi' , $monthIndex)->whereIn('id_posyandu' , $arr_id)->with('user')->get();
            
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
        }else{
          foreach (array_keys($arr_chart['labels']) as $month){
          
            $monthIndex = $month < 10 ? '0'. ($month+1) : ($month+1);
  
            $pemberianImunisasi = PemberianImunisasi::whereYear('tanggal_imunisasi' , $tahun)
              ->whereMonth('tanggal_imunisasi' , $monthIndex);

            if($defIdPos != null){
              $pemberianImunisasi = $pemberianImunisasi->where('id_posyandu' , $defIdPos);
            }
            
            $pemberianImunisasi = $pemberianImunisasi->with('user')->get();
            
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
          $arr_id = [];
          $posyandu = NakesPosyandu::where('id_nakes', $id)->with('posyandu')->get();
          
          foreach( $posyandu as $p ){
            $arr_id[] = $p->posyandu->id;
          }
          foreach ($arr_chart['labels'] as $keyLabel){
            $data = 0;
            if($keyLabel === 'Ibu Hamil'){
              $data = PemeriksaanIbu::whereYear('tanggal_pemeriksaan' , $tahun)
              ->whereIn('jenis_pemeriksaan' , ['Pemeriksaan' , 'pemeriksaan'] )
              ->whereIn('id_posyandu' , $arr_id)->count();
            }else if($keyLabel === 'Lansia'){
              $data = PemeriksaanLansia::whereYear('tanggal_pemeriksaan' , $tahun)
              ->whereIn('jenis_pemeriksaan' , ['Pemeriksaan' , 'pemeriksaan'] )
              ->whereIn('id_posyandu' , $arr_id)->count();;
            }else{
              $data = PemeriksaanAnak::whereYear('tanggal_pemeriksaan' , $tahun)
                ->whereIn('jenis_pemeriksaan' , ['Pemeriksaan' , 'pemeriksaan'] )
                ->whereIn('id_posyandu' , $arr_id)->count();;
            }
            
            $arr_chart_value['data'][] = $data;
  
          }
        }else{
          foreach ($arr_chart['labels'] as $keyLabel){
            $data = 0;
  
            if($keyLabel === 'Ibu Hamil'){
              $data = PemeriksaanIbu::whereYear('tanggal_pemeriksaan' , $tahun)
              ->whereIn('jenis_pemeriksaan' , ['Pemeriksaan' , 'pemeriksaan'] );
            }else if($keyLabel === 'Lansia'){
              $data = PemeriksaanLansia::whereYear('tanggal_pemeriksaan' , $tahun)
              ->whereIn('jenis_pemeriksaan' , ['Pemeriksaan' , 'pemeriksaan'] );
            }else{
              $data = PemeriksaanAnak::whereYear('tanggal_pemeriksaan' , $tahun)
                ->whereIn('jenis_pemeriksaan' , ['Pemeriksaan' , 'pemeriksaan'] );
            }

            if($request->posyandu !== null){
              $data->where('id_posyandu' , $request->posyandu);
            }
            
            $arr_chart_value['data'][] = $data->count();
  
          }
        }
      }

      if($modelName === 'konsul'){

        if( $request->tk == 1 ){
          $posyandu = new Posyandu;
          $id = auth('admin')->user()->nakes->id;
          $arr_id = [];
          $posyandu = NakesPosyandu::where('id_nakes', $id)->with('posyandu')->get();
          
          foreach( $posyandu as $p ){
            $arr_id[] = $p->posyandu->id;
          }
          
          foreach ($arr_chart['labels'] as $keyLabel){
        
            $data = 0;
            
            if($keyLabel === 'Ibu Hamil'){
              $data = PemeriksaanIbu::whereYear('tanggal_pemeriksaan' , $tahun)
                ->whereIn('jenis_pemeriksaan' , ['Konsultasi' , 'konsultasi'] )
                ->whereIn('id_posyandu' , $arr_id)->count();
            }else if($keyLabel === 'Lansia'){
              $data = PemeriksaanLansia::whereYear('tanggal_pemeriksaan' , $tahun)
                ->whereIn('jenis_pemeriksaan' , ['Konsultasi' , 'konsultasi'] )
                ->whereIn('id_posyandu' , $arr_id)->count();
            }else{
              $data = PemeriksaanAnak::whereYear('tanggal_pemeriksaan' , $tahun)
                ->whereIn('jenis_pemeriksaan' , ['Konsultasi' , 'konsultasi'] )
                ->whereIn('id_posyandu' , $arr_id)->count();
            }
            
            $arr_chart_value['data'][] = $data;
  
          }
        }else{
          foreach ($arr_chart['labels'] as $keyLabel){
          
            $data = 0;
            
            if($keyLabel === 'Ibu Hamil'){
              $data = PemeriksaanIbu::whereYear('tanggal_pemeriksaan' , $tahun)
                ->whereIn('jenis_pemeriksaan' , ['Konsultasi' , 'konsultasi'] );
            }else if($keyLabel === 'Lansia'){
              $data = PemeriksaanLansia::whereYear('tanggal_pemeriksaan' , $tahun)
                ->whereIn('jenis_pemeriksaan' , ['Konsultasi' , 'konsultasi'] );
            }else{
              $data = PemeriksaanAnak::whereYear('tanggal_pemeriksaan' , $tahun)
                ->whereIn('jenis_pemeriksaan' , ['Konsultasi' , 'konsultasi'] );
            }
            
            if($request->posyandu != null){
              $data = $data->where('id_posyandu' , $request->posyandu);
            }

            $arr_chart_value['data'][] = $data->count();
  
          }
        }
      }

      if($modelName === 'vitamin'){

        if( $request->tk == 1 ){
          $posyandu = new Posyandu;
          $id = auth('admin')->user()->nakes->id;
          $arr_id = [];
          $posyandu = NakesPosyandu::where('id_nakes', $id)->with('posyandu')->get();
          
          foreach( $posyandu as $p ){
            $arr_id[] = $p->posyandu->id;
          }
          
          foreach ( $arr_chart['labels'] as $keyLabel){
            $pemberianVitamin = PemberianVitamin::whereYear('tanggal_pemberian' , $tahun)
            ->whereIn('id_posyandu' , $arr_id)->with('user')->get();
            
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
              }else if($keyLabel === 'Anak'){
                $arr_chart_value['data'][] = count($tmp_arr['anak']);
              }else{
                $arr_chart_value['data'][] = count($tmp_arr['lansia']);
              }
  
            }else{
              $arr_chart_value['data'][] = 0;
            }
  
          }
        }else{
          foreach ( $arr_chart['labels'] as $keyLabel){
          
            $pemberianVitamin = PemberianVitamin::whereYear('tanggal_pemberian' , $tahun);

            if($request->posyandu != null){
              $pemberianVitamin = $pemberianVitamin->where('id_posyandu' , $request->posyandu);
            }

            $pemberianVitamin = $pemberianVitamin->with('user')->get();
            
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
              }else if($keyLabel === 'Anak'){
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
          $arr_id = [];
          $posyandu = NakesPosyandu::where('id_nakes', $id)->with('posyandu')->get();
          
          foreach( $posyandu as $p ){
            $arr_id[] = $p->posyandu->id;
          }

          foreach ($arr_chart['labels'] as $keyLabel){
            $pemberianImunisasi = PemberianImunisasi::whereYear('tanggal_imunisasi' , $tahun)
            ->whereIn('id_posyandu' , $arr_id)->with('user')->get();
            
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
              }else if($keyLabel === 'Anak'){
                $arr_chart_value['data'][] = count($tmp_arr['anak']);
              }else{
                $arr_chart_value['data'][] = count($tmp_arr['lansia']);
              }
  
            }else{
              $arr_chart_value['data'][] = 0;
            }
              
          }

        }else{
          foreach ($arr_chart['labels'] as $keyLabel){

            $pemberianImunisasi = PemberianImunisasi::whereYear('tanggal_imunisasi' , $tahun);
            if($request->posyandu != null){
              $pemberianImunisasi = $pemberianImunisasi->where('id_posyandu' , $request->posyandu);
            }

            $pemberianImunisasi = $pemberianImunisasi->with('user')->get();
            
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
              }else if($keyLabel === 'Anak'){
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


    public function loadtablekegiatan( Request $request ){
      
      $kegiatan = new Kegiatan();
      $dataTabel = [];
      $thisYear = date('Y');
      $type = $request->type;
      $value = $request->value;
      
      $kegiatan = $kegiatan->with(['posyandu' => function ($query) use ($type , $value) {
        $query->with(['desa' => function ( $querydesa ) use ($type , $value) {
          
          $querydesa->with('kecamatan');

          if( $type === 'kecamatan' ){
            $querydesa = $querydesa->where('id_kecamatan' , $value);
          }else if($type === 'kabupaten'){
            $querydesa = $querydesa->whereHas('kecamatan' , function($q) use ($value) {
              $q->where('id_kabupaten' , $value);
            });
          }
          
        }]);
      }])->whereYear( 'start_at' , $thisYear );

      if ( $request->tk == 1 ){
        $id = auth('admin')->user()->nakes->id;
        $arr_id = [];
        $posyanduNakes = NakesPosyandu::where('id_nakes', $id)->with('posyandu')->get();
        
        foreach( $posyanduNakes as $p ){
          $arr_id[] = $p->posyandu->id;
        }

        $kegiatan = $kegiatan->whereIn('id_posyandu' , $arr_id);

      }

      if( $request->posyandu  !== null ){
        $kegiatan = $kegiatan->where('id_posyandu' , $request->posyandu);
      }

      $kegiatan = $kegiatan->withTrashed();

      foreach( $kegiatan->get() as $data ){
        
        if($data->posyandu->desa !== null){
          $temp_data = [ 'cancel' => [] , 'passed' => [] , 'not_yet' => [] , 'in_progress' => [] ];

          if($data->trashed()){
            $temp_data['cancel'][] = $data;
          }else if ( $data->end_at < date('Y-m-d') ){
            $temp_data['passed'][] = $data;
          }else if ($data->start_at > date('Y-m-d')) {
            $temp_data['not_yet'][] = $data;
          }else{
            $temp_data['in_progress'][] = $data;
          }
  
          if( array_key_exists( $data->id_posyandu , $dataTabel ) === false ) {
            $dataTabel[$data->id_posyandu] = [
              'posyandu' => $data->posyandu->nama_posyandu,
              'kecamatan' => $data->posyandu->desa->kecamatan->nama_kecamatan,
              'batal' => count($temp_data['cancel']),
              'lewat' => count($temp_data['passed']),
              'belum' => count($temp_data['not_yet']),
              'terlaksana' => count($temp_data['in_progress'])
            ];
          } else {
            $dataTabel[$data->id_posyandu]['batal'] = $dataTabel[$data->id_posyandu]['batal'] + count($temp_data['cancel']);
            $dataTabel[$data->id_posyandu]['lewat'] = $dataTabel[$data->id_posyandu]['lewat'] + count($temp_data['passed']);
            $dataTabel[$data->id_posyandu]['belum'] = $dataTabel[$data->id_posyandu]['belum'] + count($temp_data['not_yet']);
            $dataTabel[$data->id_posyandu]['terlaksana'] = $dataTabel[$data->id_posyandu]['terlaksana'] + count($temp_data['in_progress']);
          }
        }

      }

      

      return response( $dataTabel , 200 );

    }

    public function tabelfilterkegiatan( Request $request ){
      $kegiatan = new Kegiatan();
      $dataTabel = [];
      $filterType = $request->filter;
      $posyandu = $request->posyandu;

      if( $filterType === 'year' ){

        $tahun = [];

        if(($this->getCurrentYear() - $this->getLastYear()) <= 4 ){
          for($i = $this->getCurrentYear() + 2; $i >= $this->getCurrentYear() - 3; $i--){
            $tahun[] = $i;
          }
        }else{
          for($i = $this->getCurrentYear() + 2; $i >= $this->getLastYear(); $i--){
            $tahun[] = $i;
          }
        }
        
        foreach($tahun as $thn ){
          
          $kegiatanYear = $kegiatan->with(['posyandu' => function ($query) {
            $query->with(['desa' => function ( $querydesa ) {
              $querydesa->with('kecamatan');
            }]);
          }])->whereYear('start_at' , $thn);
          
          if( $posyandu !== null ){
            $kegiatanYear = $kegiatanYear->where('id_posyandu' , $posyandu);
          }

          $kegiatanYear = $kegiatanYear->withTrashed()->get();

          $isEmpty = $kegiatanYear->isEmpty();

          if( $isEmpty === false ){
            foreach($kegiatanYear as $data){
              $temp_data = [ 'cancel' => [] , 'passed' => [] , 'not_yet' => [] , 'in_progress' => [] ];
  
              if($data->trashed()){
                $temp_data['cancel'][] = $data;
              }else if ( $data->end_at < date('Y-m-d') ){
                $temp_data['passed'][] = $data;
              }else if ($data->start_at > date('Y-m-d')) {
                $temp_data['not_yet'][] = $data;
              }else{
                $temp_data['in_progress'][] = $data;
              }
  
              if( array_key_exists( $data->id_posyandu , $dataTabel ) === false ) {
                $dataTabel[$data->id_posyandu] = [
                  'posyandu' => $data->posyandu->nama_posyandu,
                  'kecamatan' => $data->posyandu->desa->kecamatan->nama_kecamatan,
                  'batal' => count($temp_data['cancel']),
                  'lewat' => count($temp_data['passed']),
                  'belum' => count($temp_data['not_yet']),
                  'terlaksana' => count($temp_data['in_progress'])
                ];
              } else {
                $dataTabel[$data->id_posyandu]['batal'] = $dataTabel[$data->id_posyandu]['batal'] + count($temp_data['cancel']);
                $dataTabel[$data->id_posyandu]['lewat'] = $dataTabel[$data->id_posyandu]['lewat'] + count($temp_data['passed']);
                $dataTabel[$data->id_posyandu]['belum'] = $dataTabel[$data->id_posyandu]['belum'] + count($temp_data['not_yet']);
                $dataTabel[$data->id_posyandu]['terlaksana'] = $dataTabel[$data->id_posyandu]['terlaksana'] + count($temp_data['in_progress']);
              }
            }

          }

        }

      }

      if( $filterType === 'monthly' ){

        $thisYear = $request->tahun;

        $kegiatanMonth = $kegiatan->with(['posyandu' => function ($query) {
          $query->with(['desa' => function ( $querydesa ) {
            $querydesa->with('kecamatan');
          }]);
        }])->whereYear( 'start_at' , $thisYear )->where('id_posyandu' , $posyandu);

        if ( $request->tk == 1 ){
          $id = auth('admin')->user()->nakes->id;
          $arr_id = [];
          $posyandu = NakesPosyandu::where('id_nakes', $id)->with('posyandu')->get();
          
          foreach( $posyandu as $p ){
            $arr_id[] = $p->posyandu->id;
          }

          $kegiatanMonth = $kegiatanMonth->whereIn('id_posyandu' , $arr_id);

        }

        $kegiatanMonth = $kegiatanMonth->withTrashed();

        foreach( $kegiatanMonth->get() as $data ){
          $temp_data = [ 'cancel' => [] , 'passed' => [] , 'not_yet' => [] , 'in_progress' => [] ];

          if($data->trashed()){
            $temp_data['cancel'][] = $data;
          }else if ( $data->end_at < date('Y-m-d') ){
            $temp_data['passed'][] = $data;
          }else if ($data->start_at > date('Y-m-d')) {
            $temp_data['not_yet'][] = $data;
          }else{
            $temp_data['in_progress'][] = $data;
          }

          if( array_key_exists( $data->id_posyandu , $dataTabel ) === false ) {
            $dataTabel[$data->id_posyandu] = [
              'posyandu' => $data->posyandu->nama_posyandu,
              'kecamatan' => $data->posyandu->desa->kecamatan->nama_kecamatan,
              'batal' => count($temp_data['cancel']),
              'lewat' => count($temp_data['passed']),
              'belum' => count($temp_data['not_yet']),
              'terlaksana' => count($temp_data['in_progress'])
            ];
          } else {
            $dataTabel[$data->id_posyandu]['batal'] = $dataTabel[$data->id_posyandu]['batal'] + count($temp_data['cancel']);
            $dataTabel[$data->id_posyandu]['lewat'] = $dataTabel[$data->id_posyandu]['lewat'] + count($temp_data['passed']);
            $dataTabel[$data->id_posyandu]['belum'] = $dataTabel[$data->id_posyandu]['belum'] + count($temp_data['not_yet']);
            $dataTabel[$data->id_posyandu]['terlaksana'] = $dataTabel[$data->id_posyandu]['terlaksana'] + count($temp_data['in_progress']);
          }
        }
      }

      if( $filterType === 'weekly' ){
        
        $tahun = $request->tahun;
        $bulan = $request->bulan;

        $weekQuery =  $kegiatan->with(['posyandu' => function ($query) {
          $query->with(['desa' => function ( $querydesa ) {
            $querydesa->with('kecamatan');
          }]);
        }])->whereYear( 'start_at' , $tahun )->whereMonth('start_at' , $bulan);
        
        if ( $request->tk == 1 ){
          $id = auth('admin')->user()->nakes->id;
          $arr_id = [];
          $posyandu = NakesPosyandu::where('id_nakes', $id)->with('posyandu')->get();
          
          foreach( $posyandu as $p ){
            $arr_id[] = $p->posyandu->id;
          }

          $weekQuery = $weekQuery->whereIn('id_posyandu' , $arr_id);

        }

        if($posyandu !== null ){
          $weekQuery = $weekQuery->where('id_posyandu' , $posyandu);
        }

        $weekQuery = $weekQuery->withTrashed()->get();
        
        if($weekQuery->isEmpty() === false){
          foreach($weekQuery as $data){
            $temp_data = [ 'cancel' => [] , 'passed' => [] , 'not_yet' => [] , 'in_progress' => [] ];

            if($data->trashed()){
              $temp_data['cancel'][] = $data;
            }else if ( $data->end_at < date('Y-m-d') ){
              $temp_data['passed'][] = $data;
            }else if ($data->start_at > date('Y-m-d')) {
              $temp_data['not_yet'][] = $data;
            }else{
              $temp_data['in_progress'][] = $data;
            }

            if( array_key_exists( $data->id_posyandu , $dataTabel ) === false ) {
              $dataTabel[$data->id_posyandu] = [
                'posyandu' => $data->posyandu->nama_posyandu,
                'kecamatan' => $data->posyandu->desa->kecamatan->nama_kecamatan,
                'batal' => count($temp_data['cancel']),
                'lewat' => count($temp_data['passed']),
                'belum' => count($temp_data['not_yet']),
                'terlaksana' => count($temp_data['in_progress'])
              ];
            } else {
              $dataTabel[$data->id_posyandu]['batal'] = $dataTabel[$data->id_posyandu]['batal'] + count($temp_data['cancel']);
              $dataTabel[$data->id_posyandu]['lewat'] = $dataTabel[$data->id_posyandu]['lewat'] + count($temp_data['passed']);
              $dataTabel[$data->id_posyandu]['belum'] = $dataTabel[$data->id_posyandu]['belum'] + count($temp_data['not_yet']);
              $dataTabel[$data->id_posyandu]['terlaksana'] = $dataTabel[$data->id_posyandu]['terlaksana'] + count($temp_data['in_progress']);
            }
          }
        }

      }

      return response( $dataTabel , 200 );

    }

    public function loadtablebulanan( Request $request ){

      $dataTabel = [];
      $tahun = date('Y');
      $model = $request->model;
      $posyandu = $request->posyandu;
      $type = $request->type;
      $value = $request->value;
        
      if($model === 'pemeriksaan' || $model === 'konsul'){

        $pemereiksaanAnak = PemeriksaanAnak::with(['posyandu' => function ($query) use ( $type , $value ) {
          $query->with(['desa' => function ( $querydesa ) use ($type , $value) {
            $querydesa->with(['kecamatan']);

            if( $type === 'kecamatan' ){
              $querydesa = $querydesa->where('id_kecamatan' , $value);
            }else if($type === 'kabupaten'){
              $querydesa = $querydesa->whereHas('kecamatan' , function($q) use ($value) {
                $q->where('id_kabupaten' , $value);
              });
            }

          }]);
        } , 'anak' ])->whereYear('tanggal_pemeriksaan' , $tahun);

        $pemereiksaanIbu = PemeriksaanIbu::with(['posyandu' => function ($query) use ( $type , $value ) {
          $query->with(['desa' => function ( $querydesa ) use ($type , $value) {
            $querydesa->with(['kecamatan']);

            if( $type === 'kecamatan' ){
              $querydesa = $querydesa->where('id_kecamatan' , $value);
            }else if($type === 'kabupaten'){
              $querydesa = $querydesa->whereHas('kecamatan' , function($q) use ($value) {
                $q->where('id_kabupaten' , $value);
              });
            }

          }]);
        } , 'ibu' ])->whereYear('tanggal_pemeriksaan' , $tahun);

        $pemereiksaanLansia = PemeriksaanLansia::with(['posyandu' => function ($query) use ( $type , $value ) {
          $query->with(['desa' => function ( $querydesa ) use ($type , $value) {
            $querydesa->with(['kecamatan']);

            if( $type === 'kecamatan' ){
              $querydesa = $querydesa->where('id_kecamatan' , $value);
            }else if($type === 'kabupaten'){
              $querydesa = $querydesa->whereHas('kecamatan' , function($q) use ($value) {
                $q->where('id_kabupaten' , $value);
              });
            }

          }]);
        } , 'lansia' ])->whereYear('tanggal_pemeriksaan' , $tahun);


        if( $model === 'pemeriksaan' ){
          $pemereiksaanAnak = $pemereiksaanAnak
            ->whereIn('jenis_pemeriksaan' , ['Pemeriksaan' , 'pemeriksaan'] );
          $pemereiksaanIbu = $pemereiksaanIbu
            ->whereIn('jenis_pemeriksaan' , ['Pemeriksaan' , 'pemeriksaan'] );
          $pemereiksaanLansia = $pemereiksaanLansia
            ->whereIn('jenis_pemeriksaan' , ['Pemeriksaan' , 'pemeriksaan'] );
        }

        if( $model === 'konsul' ){
          $pemereiksaanAnak = $pemereiksaanAnak
            ->whereIn('jenis_pemeriksaan' , ['Konsultasi' , 'konsultasi'] );
          $pemereiksaanIbu = $pemereiksaanIbu
            ->whereIn('jenis_pemeriksaan' , ['Konsultasi' , 'konsultasi'] );
          $pemereiksaanLansia = $pemereiksaanLansia
            ->whereIn('jenis_pemeriksaan' , ['Konsultasi' , 'konsultasi'] );
        }

        if ( $request->tk == 1 ){
          $id = auth('admin')->user()->nakes->id;
          $arr_id = [];
          $posyanduNakes = NakesPosyandu::where('id_nakes', $id)->with('posyandu')->get();
          
          foreach( $posyanduNakes as $p ){
            $arr_id[] = $p->posyandu->id;
          }

          $pemereiksaanAnak = $pemereiksaanAnak->whereIn('id_posyandu' , $arr_id);
          $pemereiksaanIbu = $pemereiksaanIbu->whereIn('id_posyandu' , $arr_id);
          $pemereiksaanLansia = $pemereiksaanLansia->whereIn('id_posyandu' , $arr_id);
  
        }
          
        if( $posyandu !== null ){
          $pemereiksaanAnak = $pemereiksaanAnak->where('id_posyandu' , $posyandu );
          $pemereiksaanIbu =  $pemereiksaanIbu->where('id_posyandu' , $posyandu );
          $pemereiksaanLansia = $pemereiksaanLansia->where('id_posyandu' , $posyandu );
        }

        foreach( $pemereiksaanAnak->get() as $data ){
          if($data->posyandu->desa !== null){
            if( array_key_exists( $data->id_posyandu , $dataTabel ) === false ) {
              $dataTabel[$data->id_posyandu] = [
                'posyandu' => $data->posyandu->nama_posyandu,
                'kecamatan' => $data->posyandu->desa->kecamatan->nama_kecamatan,
                'anak'  => 1,
                'laki' => ($data->anak->jenis_kelamin === 'laki-laki') ? 1 : 0,
                'perempuan' => ($data->anak->jenis_kelamin === 'perempuan') ? 1 : 0,
              ];
            } else {
  
              if( isset($dataTabel[$data->id_posyandu]['anak']) === false ) {
                $dataTabel[$data->id_posyandu]['anak'] = 0;
              }
  
              $dataTabel[$data->id_posyandu]['anak'] = $dataTabel[$data->id_posyandu]['anak'] + 1;
              $dataTabel[$data->id_posyandu]['laki'] = ($data->anak->jenis_kelamin === 'laki-laki') ?  $dataTabel[$data->id_posyandu]['laki'] + 1 : $dataTabel[$data->id_posyandu]['laki'];
              $dataTabel[$data->id_posyandu]['perempuan'] = ($data->anak->jenis_kelamin === 'perempuan') ?  $dataTabel[$data->id_posyandu]['perempuan'] + 1 : $dataTabel[$data->id_posyandu]['perempuan'];
  
            }
          }
        }
        
        foreach( $pemereiksaanIbu->get() as $data ){
          
          if( $data->posyandu->desa !== null ){
            if( array_key_exists( $data->id_posyandu , $dataTabel ) === false ) {
              $dataTabel[$data->id_posyandu] = [
                'posyandu' => $data->posyandu->nama_posyandu,
                'kecamatan' => $data->posyandu->desa->kecamatan->nama_kecamatan,
                'ibu'  => 1,
                'perempuan' => 1,
              ];
            } else {
              
              if( isset($dataTabel[$data->id_posyandu]['ibu']) === false ) {
                $dataTabel[$data->id_posyandu]['ibu'] = 0;
              }
              $dataTabel[$data->id_posyandu]['perempuan'] = $dataTabel[$data->id_posyandu]['perempuan'] + 1;
              $dataTabel[$data->id_posyandu]['ibu'] = $dataTabel[$data->id_posyandu]['ibu'] + 1;
            }
          }

        }

        foreach( $pemereiksaanLansia->get() as $data ){
          
          if( $data->posyandu->desa !== null ){
            if( array_key_exists( $data->id_posyandu , $dataTabel ) === false ) {
              $dataTabel[$data->id_posyandu] = [
                'posyandu' => $data->posyandu->nama_posyandu,
                'kecamatan' => $data->posyandu->desa->kecamatan->nama_kecamatan,
                'lansia'  => 1,
                'laki' => ($data->lansia->jenis_kelamin === 'laki-laki') ? 1 : 0,
                'perempuan' => ($data->lansia->jenis_kelamin === 'perempuan') ? 1 : 0,
              ];
            } else {
  
              if( isset($dataTabel[$data->id_posyandu]['lansia']) === false ) {
                $dataTabel[$data->id_posyandu]['lansia'] = 0;
              }
  
              $dataTabel[$data->id_posyandu]['lansia'] = $dataTabel[$data->id_posyandu]['lansia'] + 1;
              $dataTabel[$data->id_posyandu]['laki'] = ($data->lansia->jenis_kelamin === 'laki-laki') ?  $dataTabel[$data->id_posyandu]['laki'] + 1 : $dataTabel[$data->id_posyandu]['laki'];
              $dataTabel[$data->id_posyandu]['perempuan'] = ($data->lansia->jenis_kelamin === 'perempuan') ?  $dataTabel[$data->id_posyandu]['perempuan'] + 1 : $dataTabel[$data->id_posyandu]['perempuan'];
  
            }
          }

        }
        
        foreach( $dataTabel as $key => $table ){
            $dataTabel[$key]['anak'] = $table['anak'] ?? 0;
            $dataTabel[$key]['ibu'] = $table['ibu'] ?? 0;
            $dataTabel[$key]['lansia'] = $table['lansia'] ?? 0;
            $dataTabel[$key]['laki']  = $table['laki'] ?? 0;
            $dataTabel[$key]['perempuan']  = $table['perempuan'] ?? 0;

            $dataTabel[$key]['total'] = $dataTabel[$key]['anak'] + $dataTabel[$key]['ibu'] + $dataTabel[$key]['lansia'];
        
          }

      }

      if($model === 'imunisasi' || $model === 'vitamin') {

        $tableModel = null;

        if( $model === 'imunisasi' ){
          $tableModel = new PemberianImunisasi();
        }else{
          $tableModel = new PemberianVitamin();
        }
        $tableModel = $tableModel->with([ 'posyandu' => function ($query) use ( $value , $type ) {
          $query->with(['desa' => function ( $querydesa ) use ( $value , $type ) {
            $querydesa->with('kecamatan');

            if( $type === 'kecamatan' ){
              $querydesa = $querydesa->where('id_kecamatan' , $value);
            }else if($type === 'kabupaten'){
              $querydesa = $querydesa->whereHas('kecamatan' , function($q) use ($value) {
                $q->where('id_kabupaten' , $value);
              });
            }

          }]);
        } , 'user']);

        if ( $request->tk == 1 ){
          $id = auth('admin')->user()->nakes->id;
          $arr_id = [];
          $posyanduNakes = NakesPosyandu::where('id_nakes', $id)->with('posyandu')->get();
          
          foreach( $posyanduNakes as $p ){
            $arr_id[] = $p->posyandu->id;
          }
  
          $tableModel = $tableModel->whereIn('id_posyandu' , $arr_id);
  
        }

        if( $posyandu !== null ){
          $tableModel = $tableModel->where('id_posyandu' , $posyandu );
        }

        foreach( $tableModel->get() as $data ){

          if( $data->posyandu->desa !== null ){
            if( array_key_exists( $data->id_posyandu , $dataTabel ) === false ) {
              $dataTabel[$data->id_posyandu] = [
                'posyandu' => $data->posyandu->nama_posyandu,
                'kecamatan' => $data->posyandu->desa->kecamatan->nama_kecamatan,
                'anak'  => ($data->user->anak !== null) ? 1 : 0,
                'ibu' => ($data->user->ibu !== null) ? 1 : 0,
                'lansia' => ($data->user->lansia !== null) ? 1 : 0,
              ];
  
              if( $data->user->ibu ){
                $dataTabel[$data->id_posyandu]['perempuan'] = 1;
                $dataTabel[$data->id_posyandu]['laki'] = 0;
              }else{
  
                if( $data->user->anak ){
                  $dataTabel[$data->id_posyandu]['perempuan'] = ($data->user->anak->jenis_kelamin === 'perempuan') ? 1 : 0;
                  $dataTabel[$data->id_posyandu]['laki'] = ($data->user->anak->jenis_kelamin === 'laki-laki') ? 1 : 0;
                }else{
                  $dataTabel[$data->id_posyandu]['perempuan'] = ($data->user->lansia->jenis_kelamin === 'perempuan') ? 1 : 0;
                  $dataTabel[$data->id_posyandu]['laki'] = ($data->user->lansia->jenis_kelamin === 'laki-laki') ? 1 : 0;
                }
  
              }
  
            } else {
  
              $dataTabel[$data->id_posyandu]['anak'] = ($data->user->anak !== null) ? $dataTabel[$data->id_posyandu]['anak'] + 1 : $dataTabel[$data->id_posyandu]['anak'];
              $dataTabel[$data->id_posyandu]['ibu'] = ($data->user->ibu !== null) ? $dataTabel[$data->id_posyandu]['ibu'] + 1 : $dataTabel[$data->id_posyandu]['ibu'];
              $dataTabel[$data->id_posyandu]['lansia'] = ($data->user->lansia !== null) ? $dataTabel[$data->id_posyandu]['lansia'] + 1 : $dataTabel[$data->id_posyandu]['lansia'];
              
              if( $data->user->ibu ){
                $dataTabel[$data->id_posyandu]['perempuan'] = $dataTabel[$data->id_posyandu]['perempuan'] + 1;
                $dataTabel[$data->id_posyandu]['laki'] = $dataTabel[$data->id_posyandu]['laki'];
              }else{
  
                if( $data->user->anak ){
                  $dataTabel[$data->id_posyandu]['perempuan'] = ($data->user->anak->jenis_kelamin === 'perempuan') ? $dataTabel[$data->id_posyandu]['perempuan'] + 1 : $dataTabel[$data->id_posyandu]['perempuan'];
                  $dataTabel[$data->id_posyandu]['laki'] = ($data->user->anak->jenis_kelamin === 'laki-laki') ? $dataTabel[$data->id_posyandu]['laki'] + 1 : $dataTabel[$data->id_posyandu]['laki'];
                }else{
                  $dataTabel[$data->id_posyandu]['perempuan'] = ($data->user->lansia->jenis_kelamin === 'perempuan') ? $dataTabel[$data->id_posyandu]['perempuan'] + 1 : $dataTabel[$data->id_posyandu]['perempuan'];
                  $dataTabel[$data->id_posyandu]['laki'] = ($data->user->lansia->jenis_kelamin === 'laki-laki') ? $dataTabel[$data->id_posyandu]['laki'] + 1 : $dataTabel[$data->id_posyandu]['laki'];
                }
  
              }
  
            }
          }

        }

        foreach( $dataTabel as $key => $table ){

          $dataTabel[$key]['total'] = $dataTabel[$key]['anak'] + $dataTabel[$key]['ibu'] + $dataTabel[$key]['lansia'];
      
        }

      }

      return response( $dataTabel , 200 );

    }

    public function tabelfilterbulanan( Request $request ){
      $dataTabel = [];
      $tahun = $request->tahun;
      $startbulan = $request->startbulan;
      $endbulan = $request->endbulan;
      $model = $request->model;
      $posyandu = $request->posyandu;
      $startDate = Carbon::createFromDate( $tahun , $startbulan, 1 )->startOfMonth()->format('Y-m-d');
      $endDate = Carbon::createFromDate( $tahun , $endbulan, 1 )->endOfMonth()->format('Y-m-d');
      
      if($model === 'pemeriksaan' || $model === 'konsul'){

        $pemereiksaanAnak = PemeriksaanAnak::with(['posyandu' => function ($query) {
          $query->with(['desa' => function ( $querydesa ) {
            $querydesa->with('kecamatan');
          }]);
        } , 'anak' ])->whereYear('tanggal_pemeriksaan' , $tahun)->whereBetween('tanggal_pemeriksaan' , [ $startDate , $endDate ]);

        $pemereiksaanIbu = PemeriksaanIbu::with(['posyandu' => function ($query) {
          $query->with(['desa' => function ( $querydesa ) {
            $querydesa->with('kecamatan');
          }]);
        } , 'ibu' ])->whereYear('tanggal_pemeriksaan' , $tahun)->whereBetween('tanggal_pemeriksaan' , [ $startDate , $endDate ]);

        $pemereiksaanLansia = PemeriksaanLansia::with(['posyandu' => function ($query) {
          $query->with(['desa' => function ( $querydesa ) {
            $querydesa->with('kecamatan');
          }]);
        } , 'lansia' ])->whereYear('tanggal_pemeriksaan' , $tahun)->whereBetween('tanggal_pemeriksaan' , [ $startDate , $endDate ]);


        if( $model === 'pemeriksaan' ){
          $pemereiksaanAnak = $pemereiksaanAnak
            ->whereIn('jenis_pemeriksaan' , ['Pemeriksaan' , 'pemeriksaan'] );
          $pemereiksaanIbu = $pemereiksaanIbu
            ->whereIn('jenis_pemeriksaan' , ['Pemeriksaan' , 'pemeriksaan'] );
          $pemereiksaanLansia = $pemereiksaanLansia
            ->whereIn('jenis_pemeriksaan' , ['Pemeriksaan' , 'pemeriksaan'] );
        }

        if( $model === 'konsul' ){
          $pemereiksaanAnak = $pemereiksaanAnak
            ->whereIn('jenis_pemeriksaan' , ['Konsultasi' , 'konsultasi'] );
          $pemereiksaanIbu = $pemereiksaanIbu
            ->whereIn('jenis_pemeriksaan' , ['Konsultasi' , 'konsultasi'] );
          $pemereiksaanLansia = $pemereiksaanLansia
            ->whereIn('jenis_pemeriksaan' , ['Konsultasi' , 'konsultasi'] );
        }

          
        if( $posyandu !== null ){
          $pemereiksaanAnak = $pemereiksaanAnak->where('id_posyandu' , $posyandu );
          $pemereiksaanIbu =  $pemereiksaanIbu->where('id_posyandu' , $posyandu );
          $pemereiksaanLansia = $pemereiksaanLansia->where('id_posyandu' , $posyandu );
        }

        foreach( $pemereiksaanAnak->get() as $data ){
          if( array_key_exists( $data->id_posyandu , $dataTabel ) === false ) {
            $dataTabel[$data->id_posyandu] = [
              'posyandu' => $data->posyandu->nama_posyandu,
              'kecamatan' => $data->posyandu->desa->kecamatan->nama_kecamatan,
              'anak'  => 1,
              'laki' => ($data->anak->jenis_kelamin === 'laki-laki') ? 1 : 0,
              'perempuan' => ($data->anak->jenis_kelamin === 'perempuan') ? 1 : 0,
            ];
          } else {

            if( isset($dataTabel[$data->id_posyandu]['anak']) === false ) {
              $dataTabel[$data->id_posyandu]['anak'] = 0;
            }

            $dataTabel[$data->id_posyandu]['anak'] = $dataTabel[$data->id_posyandu]['anak'] + 1;
            $dataTabel[$data->id_posyandu]['laki'] = ($data->anak->jenis_kelamin === 'laki-laki') ?  $dataTabel[$data->id_posyandu]['laki'] + 1 : $dataTabel[$data->id_posyandu]['laki'];
            $dataTabel[$data->id_posyandu]['perempuan'] = ($data->anak->jenis_kelamin === 'perempuan') ?  $dataTabel[$data->id_posyandu]['perempuan'] + 1 : $dataTabel[$data->id_posyandu]['perempuan'];

          }
        }
        
        foreach( $pemereiksaanIbu->get() as $data ){
          if( array_key_exists( $data->id_posyandu , $dataTabel ) === false ) {
            $dataTabel[$data->id_posyandu] = [
              'posyandu' => $data->posyandu->nama_posyandu,
              'kecamatan' => $data->posyandu->desa->kecamatan->nama_kecamatan,
              'ibu'  => 1,
              'perempuan' => 1,
            ];
          } else {
            
            if( isset($dataTabel[$data->id_posyandu]['ibu']) === false ) {
              $dataTabel[$data->id_posyandu]['ibu'] = 0;
            }
            $dataTabel[$data->id_posyandu]['perempuan'] = $dataTabel[$data->id_posyandu]['perempuan'] + 1;
            $dataTabel[$data->id_posyandu]['ibu'] = $dataTabel[$data->id_posyandu]['ibu'] + 1;
          }
        }

        foreach( $pemereiksaanLansia->get() as $data ){
          if( array_key_exists( $data->id_posyandu , $dataTabel ) === false ) {
            $dataTabel[$data->id_posyandu] = [
              'posyandu' => $data->posyandu->nama_posyandu,
              'kecamatan' => $data->posyandu->desa->kecamatan->nama_kecamatan,
              'lansia'  => 1,
              'laki' => ($data->lansia->jenis_kelamin === 'laki-laki') ? 1 : 0,
              'perempuan' => ($data->lansia->jenis_kelamin === 'perempuan') ? 1 : 0,
            ];
          } else {

            if( isset($dataTabel[$data->id_posyandu]['lansia']) === false ) {
              $dataTabel[$data->id_posyandu]['lansia'] = 0;
            }

            $dataTabel[$data->id_posyandu]['lansia'] = $dataTabel[$data->id_posyandu]['lansia'] + 1;
            $dataTabel[$data->id_posyandu]['laki'] = ($data->lansia->jenis_kelamin === 'laki-laki') ?  $dataTabel[$data->id_posyandu]['laki'] + 1 : $dataTabel[$data->id_posyandu]['laki'];
            $dataTabel[$data->id_posyandu]['perempuan'] = ($data->lansia->jenis_kelamin === 'perempuan') ?  $dataTabel[$data->id_posyandu]['perempuan'] + 1 : $dataTabel[$data->id_posyandu]['perempuan'];

          }
        }
        
        foreach( $dataTabel as $key => $table ){
            $dataTabel[$key]['anak'] = $table['anak'] ?? 0;
            $dataTabel[$key]['ibu'] = $table['ibu'] ?? 0;
            $dataTabel[$key]['lansia'] = $table['lansia'] ?? 0;
            $dataTabel[$key]['laki']  = $table['laki'] ?? 0;
            $dataTabel[$key]['perempuan']  = $table['perempuan'] ?? 0;

            $dataTabel[$key]['total'] = $dataTabel[$key]['anak'] + $dataTabel[$key]['ibu'] + $dataTabel[$key]['lansia'];
        
          }

      }

      if($model === 'imunisasi' || $model === 'vitamin') {

        $tableModel = null;

        if( $model === 'imunisasi' ){
          $tableModel = new PemberianImunisasi();
          $tableModel = $tableModel->whereYear('tanggal_imunisasi' , $tahun)->whereBetween('tanggal_imunisasi' , [ $startDate , $endDate ]);
        }else{
          $tableModel = new PemberianVitamin();
          $tableModel = $tableModel->whereYear('tanggal_pemberian' , $tahun)->whereBetween('tanggal_pemberian' , [ $startDate , $endDate ]);
        }
        $tableModel = $tableModel->with([ 'posyandu' => function ($query) {
          $query->with(['desa' => function ( $querydesa ) {
            $querydesa->with('kecamatan');
          }]);
        } , 'user']);
        
        if( $posyandu !== null ){
          $tableModel = $tableModel->where('id_posyandu' , $posyandu );
        }

        foreach( $tableModel->get() as $data ){
          if( array_key_exists( $data->id_posyandu , $dataTabel ) === false ) {
            $dataTabel[$data->id_posyandu] = [
              'posyandu' => $data->posyandu->nama_posyandu,
              'kecamatan' => $data->posyandu->desa->kecamatan->nama_kecamatan,
              'anak'  => ($data->user->anak !== null) ? 1 : 0,
              'ibu' => ($data->user->ibu !== null) ? 1 : 0,
              'lansia' => ($data->user->lansia !== null) ? 1 : 0,
            ];

            if( $data->user->ibu ){
              $dataTabel[$data->id_posyandu]['perempuan'] = 1;
              $dataTabel[$data->id_posyandu]['laki'] = 0;
            }else{

              if( $data->user->anak ){
                $dataTabel[$data->id_posyandu]['perempuan'] = ($data->user->anak->jenis_kelamin === 'perempuan') ? 1 : 0;
                $dataTabel[$data->id_posyandu]['laki'] = ($data->user->anak->jenis_kelamin === 'laki-laki') ? 1 : 0;
              }else{
                $dataTabel[$data->id_posyandu]['perempuan'] = ($data->user->lansia->jenis_kelamin === 'perempuan') ? 1 : 0;
                $dataTabel[$data->id_posyandu]['laki'] = ($data->user->lansia->jenis_kelamin === 'laki-laki') ? 1 : 0;
              }

            }

          } else {

            $dataTabel[$data->id_posyandu]['anak'] = ($data->user->anak !== null) ? $dataTabel[$data->id_posyandu]['anak'] + 1 : $dataTabel[$data->id_posyandu]['anak'];
            $dataTabel[$data->id_posyandu]['ibu'] = ($data->user->ibu !== null) ? $dataTabel[$data->id_posyandu]['ibu'] + 1 : $dataTabel[$data->id_posyandu]['ibu'];
            $dataTabel[$data->id_posyandu]['lansia'] = ($data->user->lansia !== null) ? $dataTabel[$data->id_posyandu]['lansia'] + 1 : $dataTabel[$data->id_posyandu]['lansia'];
            
            if( $data->user->ibu ){
              $dataTabel[$data->id_posyandu]['perempuan'] = $dataTabel[$data->id_posyandu]['perempuan'] + 1;
              $dataTabel[$data->id_posyandu]['laki'] = $dataTabel[$data->id_posyandu]['laki'];
            }else{

              if( $data->user->anak ){
                $dataTabel[$data->id_posyandu]['perempuan'] = ($data->user->anak->jenis_kelamin === 'perempuan') ? $dataTabel[$data->id_posyandu]['perempuan'] + 1 : $dataTabel[$data->id_posyandu]['perempuan'];
                $dataTabel[$data->id_posyandu]['laki'] = ($data->user->anak->jenis_kelamin === 'laki-laki') ? $dataTabel[$data->id_posyandu]['laki'] + 1 : $dataTabel[$data->id_posyandu]['laki'];
              }else{
                $dataTabel[$data->id_posyandu]['perempuan'] = ($data->user->lansia->jenis_kelamin === 'perempuan') ? $dataTabel[$data->id_posyandu]['perempuan'] + 1 : $dataTabel[$data->id_posyandu]['perempuan'];
                $dataTabel[$data->id_posyandu]['laki'] = ($data->user->lansia->jenis_kelamin === 'laki-laki') ? $dataTabel[$data->id_posyandu]['laki'] + 1 : $dataTabel[$data->id_posyandu]['laki'];
              }

            }

          }
        }

        foreach( $dataTabel as $key => $table ){

          $dataTabel[$key]['total'] = $dataTabel[$key]['anak'] + $dataTabel[$key]['ibu'] + $dataTabel[$key]['lansia'];
      
        }

      }

      return response( $dataTabel , 200 );
    }

    public function loadtabletahunan( Request $request ){

      $dataTabel = [];
      $tahun = date('Y');
      $model = $request->model;
      $posyandu = $request->posyandu;
      $type = $request->type;
      $value = $request->value;
        
      if($model === 'pemeriksaan' || $model === 'konsul'){

        $pemereiksaanAnak = PemeriksaanAnak::with(['posyandu' => function ($query) use ( $value , $type ) {
          $query->with(['desa' => function ( $querydesa ) use ( $value , $type ) {
            $querydesa->with('kecamatan');

            if( $type === 'kecamatan' ){
              $querydesa = $querydesa->where('id_kecamatan' , $value);
            }else if($type === 'kabupaten'){
              $querydesa = $querydesa->whereHas('kecamatan' , function($q) use ($value) {
                $q->where('id_kabupaten' , $value);
              });
            }

          }]);
        } , 'anak' ])->whereYear('tanggal_pemeriksaan' , $tahun);

        $pemereiksaanIbu = PemeriksaanIbu::with(['posyandu' => function ($query) use ( $value , $type ) {
          $query->with(['desa' => function ( $querydesa ) use ( $value , $type ) {
            $querydesa->with('kecamatan');

            if( $type === 'kecamatan' ){
              $querydesa = $querydesa->where('id_kecamatan' , $value);
            }else if($type === 'kabupaten'){
              $querydesa = $querydesa->whereHas('kecamatan' , function($q) use ($value) {
                $q->where('id_kabupaten' , $value);
              });
            }

          }]);
        } , 'ibu' ])->whereYear('tanggal_pemeriksaan' , $tahun);

        $pemereiksaanLansia = PemeriksaanLansia::with(['posyandu' => function ($query) use ( $value , $type ) {
          $query->with(['desa' => function ( $querydesa ) use ( $value , $type ) {
            $querydesa->with('kecamatan');

            if( $type === 'kecamatan' ){
              $querydesa = $querydesa->where('id_kecamatan' , $value);
            }else if($type === 'kabupaten'){
              $querydesa = $querydesa->whereHas('kecamatan' , function($q) use ($value) {
                $q->where('id_kabupaten' , $value);
              });
            }

          }]);
        } , 'lansia' ])->whereYear('tanggal_pemeriksaan' , $tahun);


        if( $model === 'pemeriksaan' ){
          $pemereiksaanAnak = $pemereiksaanAnak
            ->whereIn('jenis_pemeriksaan' , ['Pemeriksaan' , 'pemeriksaan'] );
          $pemereiksaanIbu = $pemereiksaanIbu
            ->whereIn('jenis_pemeriksaan' , ['Pemeriksaan' , 'pemeriksaan'] );
          $pemereiksaanLansia = $pemereiksaanLansia
            ->whereIn('jenis_pemeriksaan' , ['Pemeriksaan' , 'pemeriksaan'] );
        }

        if( $model === 'konsul' ){
          $pemereiksaanAnak = $pemereiksaanAnak
            ->whereIn('jenis_pemeriksaan' , ['Konsultasi' , 'konsultasi'] );
          $pemereiksaanIbu = $pemereiksaanIbu
            ->whereIn('jenis_pemeriksaan' , ['Konsultasi' , 'konsultasi'] );
          $pemereiksaanLansia = $pemereiksaanLansia
            ->whereIn('jenis_pemeriksaan' , ['Konsultasi' , 'konsultasi'] );
        }

        if ( $request->tk == 1 ){
          $id = auth('admin')->user()->nakes->id;
          $arr_id = [];
          $posyanduNakes = NakesPosyandu::where('id_nakes', $id)->with('posyandu')->get();
          
          foreach( $posyanduNakes as $p ){
            $arr_id[] = $p->posyandu->id;
          }
  
          $pemereiksaanAnak = $pemereiksaanAnak->whereIn('id_posyandu' , $arr_id);
          $pemereiksaanIbu = $pemereiksaanIbu->whereIn('id_posyandu' , $arr_id);
          $pemereiksaanLansia = $pemereiksaanLansia->whereIn('id_posyandu' , $arr_id);
  
        }
          
        if( $posyandu !== null ){
          $pemereiksaanAnak = $pemereiksaanAnak->where('id_posyandu' , $posyandu );
          $pemereiksaanIbu =  $pemereiksaanIbu->where('id_posyandu' , $posyandu );
          $pemereiksaanLansia = $pemereiksaanLansia->where('id_posyandu' , $posyandu );
        }

        foreach( $pemereiksaanAnak->get() as $data ){
          
          if( $data->posyandu->desa !== null ) {
            if( array_key_exists( $data->id_posyandu , $dataTabel ) === false ) {
              $dataTabel[$data->id_posyandu] = [
                'posyandu' => $data->posyandu->nama_posyandu,
                'kecamatan' => $data->posyandu->desa->kecamatan->nama_kecamatan,
                'anak'  => 1,
                'laki' => ($data->anak->jenis_kelamin === 'laki-laki') ? 1 : 0,
                'perempuan' => ($data->anak->jenis_kelamin === 'perempuan') ? 1 : 0,
              ];
            } else {
  
              if( isset($dataTabel[$data->id_posyandu]['anak']) === false ) {
                $dataTabel[$data->id_posyandu]['anak'] = 0;
              }
  
              $dataTabel[$data->id_posyandu]['anak'] = $dataTabel[$data->id_posyandu]['anak'] + 1;
              $dataTabel[$data->id_posyandu]['laki'] = ($data->anak->jenis_kelamin === 'laki-laki') ?  $dataTabel[$data->id_posyandu]['laki'] + 1 : $dataTabel[$data->id_posyandu]['laki'];
              $dataTabel[$data->id_posyandu]['perempuan'] = ($data->anak->jenis_kelamin === 'perempuan') ?  $dataTabel[$data->id_posyandu]['perempuan'] + 1 : $dataTabel[$data->id_posyandu]['perempuan'];
  
            }
          }

        }
        
        foreach( $pemereiksaanIbu->get() as $data ){
          
          if( $data->posyandu->desa !== null ) {
            if( array_key_exists( $data->id_posyandu , $dataTabel ) === false ) {
              $dataTabel[$data->id_posyandu] = [
                'posyandu' => $data->posyandu->nama_posyandu,
                'kecamatan' => $data->posyandu->desa->kecamatan->nama_kecamatan,
                'ibu'  => 1,
                'perempuan' => 1,
              ];
            } else {
              
              if( isset($dataTabel[$data->id_posyandu]['ibu']) === false ) {
                $dataTabel[$data->id_posyandu]['ibu'] = 0;
              }
              $dataTabel[$data->id_posyandu]['perempuan'] = $dataTabel[$data->id_posyandu]['perempuan'] + 1;
              $dataTabel[$data->id_posyandu]['ibu'] = $dataTabel[$data->id_posyandu]['ibu'] + 1;
            }
          }
        }

        foreach( $pemereiksaanLansia->get() as $data ){
          
          if( $data->posyandu->desa !== null ) {
            if( array_key_exists( $data->id_posyandu , $dataTabel ) === false ) {
              $dataTabel[$data->id_posyandu] = [
                'posyandu' => $data->posyandu->nama_posyandu,
                'kecamatan' => $data->posyandu->desa->kecamatan->nama_kecamatan,
                'lansia'  => 1,
                'laki' => ($data->lansia->jenis_kelamin === 'laki-laki') ? 1 : 0,
                'perempuan' => ($data->lansia->jenis_kelamin === 'perempuan') ? 1 : 0,
              ];
            } else {
  
              if( isset($dataTabel[$data->id_posyandu]['lansia']) === false ) {
                $dataTabel[$data->id_posyandu]['lansia'] = 0;
              }
  
              $dataTabel[$data->id_posyandu]['lansia'] = $dataTabel[$data->id_posyandu]['lansia'] + 1;
              $dataTabel[$data->id_posyandu]['laki'] = ($data->lansia->jenis_kelamin === 'laki-laki') ?  $dataTabel[$data->id_posyandu]['laki'] + 1 : $dataTabel[$data->id_posyandu]['laki'];
              $dataTabel[$data->id_posyandu]['perempuan'] = ($data->lansia->jenis_kelamin === 'perempuan') ?  $dataTabel[$data->id_posyandu]['perempuan'] + 1 : $dataTabel[$data->id_posyandu]['perempuan'];
  
            }
          }
        }
        
        foreach( $dataTabel as $key => $table ){
            $dataTabel[$key]['anak'] = $table['anak'] ?? 0;
            $dataTabel[$key]['ibu'] = $table['ibu'] ?? 0;
            $dataTabel[$key]['lansia'] = $table['lansia'] ?? 0;
            $dataTabel[$key]['laki']  = $table['laki'] ?? 0;
            $dataTabel[$key]['perempuan']  = $table['perempuan'] ?? 0;

            $dataTabel[$key]['total'] = $dataTabel[$key]['anak'] + $dataTabel[$key]['ibu'] + $dataTabel[$key]['lansia'];
        
          }

      }

      if($model === 'imunisasi' || $model === 'vitamin') {

        $tableModel = null;

        if( $model === 'imunisasi' ){
          $tableModel = new PemberianImunisasi();
        }else{
          $tableModel = new PemberianVitamin();
        }
        $tableModel = $tableModel->with([ 'posyandu' => function ($query) use ( $type , $value) {
          $query->with(['desa' => function ( $querydesa ) use ( $type , $value ) {
            $querydesa->with('kecamatan');

            if( $type === 'kecamatan' ){
              $querydesa = $querydesa->where('id_kecamatan' , $value);
            }else if($type === 'kabupaten'){
              $querydesa = $querydesa->whereHas('kecamatan' , function($q) use ($value) {
                $q->where('id_kabupaten' , $value);
              });
            }

          }]);
        } , 'user']);

        if ( $request->tk == 1 ){
          $id = auth('admin')->user()->nakes->id;
          $arr_id = [];
          $posyanduNakes = NakesPosyandu::where('id_nakes', $id)->with('posyandu')->get();
          
          foreach( $posyanduNakes as $p ){
            $arr_id[] = $p->posyandu->id;
          }
  
          $tableModel = $tableModel->whereIn('id_posyandu' , $arr_id);
  
        }

        if( $posyandu !== null ){
          $tableModel = $tableModel->where('id_posyandu' , $posyandu );
        }

        foreach( $tableModel->get() as $data ){

          if($data->posyandu->desa !== null){
            if( array_key_exists( $data->id_posyandu , $dataTabel ) === false ) {
              $dataTabel[$data->id_posyandu] = [
                'posyandu' => $data->posyandu->nama_posyandu,
                'kecamatan' => $data->posyandu->desa->kecamatan->nama_kecamatan,
                'anak'  => ($data->user->anak !== null) ? 1 : 0,
                'ibu' => ($data->user->ibu !== null) ? 1 : 0,
                'lansia' => ($data->user->lansia !== null) ? 1 : 0,
              ];
  
              if( $data->user->ibu ){
                $dataTabel[$data->id_posyandu]['perempuan'] = 1;
                $dataTabel[$data->id_posyandu]['laki'] = 0;
              }else{
  
                if( $data->user->anak ){
                  $dataTabel[$data->id_posyandu]['perempuan'] = ($data->user->anak->jenis_kelamin === 'perempuan') ? 1 : 0;
                  $dataTabel[$data->id_posyandu]['laki'] = ($data->user->anak->jenis_kelamin === 'laki-laki') ? 1 : 0;
                }else{
                  $dataTabel[$data->id_posyandu]['perempuan'] = ($data->user->lansia->jenis_kelamin === 'perempuan') ? 1 : 0;
                  $dataTabel[$data->id_posyandu]['laki'] = ($data->user->lansia->jenis_kelamin === 'laki-laki') ? 1 : 0;
                }
  
              }
  
            } else {
  
              $dataTabel[$data->id_posyandu]['anak'] = ($data->user->anak !== null) ? $dataTabel[$data->id_posyandu]['anak'] + 1 : $dataTabel[$data->id_posyandu]['anak'];
              $dataTabel[$data->id_posyandu]['ibu'] = ($data->user->ibu !== null) ? $dataTabel[$data->id_posyandu]['ibu'] + 1 : $dataTabel[$data->id_posyandu]['ibu'];
              $dataTabel[$data->id_posyandu]['lansia'] = ($data->user->lansia !== null) ? $dataTabel[$data->id_posyandu]['lansia'] + 1 : $dataTabel[$data->id_posyandu]['lansia'];
              
              if( $data->user->ibu ){
                $dataTabel[$data->id_posyandu]['perempuan'] = $dataTabel[$data->id_posyandu]['perempuan'] + 1;
                $dataTabel[$data->id_posyandu]['laki'] = $dataTabel[$data->id_posyandu]['laki'];
              }else{
  
                if( $data->user->anak ){
                  $dataTabel[$data->id_posyandu]['perempuan'] = ($data->user->anak->jenis_kelamin === 'perempuan') ? $dataTabel[$data->id_posyandu]['perempuan'] + 1 : $dataTabel[$data->id_posyandu]['perempuan'];
                  $dataTabel[$data->id_posyandu]['laki'] = ($data->user->anak->jenis_kelamin === 'laki-laki') ? $dataTabel[$data->id_posyandu]['laki'] + 1 : $dataTabel[$data->id_posyandu]['laki'];
                }else{
                  $dataTabel[$data->id_posyandu]['perempuan'] = ($data->user->lansia->jenis_kelamin === 'perempuan') ? $dataTabel[$data->id_posyandu]['perempuan'] + 1 : $dataTabel[$data->id_posyandu]['perempuan'];
                  $dataTabel[$data->id_posyandu]['laki'] = ($data->user->lansia->jenis_kelamin === 'laki-laki') ? $dataTabel[$data->id_posyandu]['laki'] + 1 : $dataTabel[$data->id_posyandu]['laki'];
                }
  
              }
  
            }
          }

        }

        foreach( $dataTabel as $key => $table ){

          $dataTabel[$key]['total'] = $dataTabel[$key]['anak'] + $dataTabel[$key]['ibu'] + $dataTabel[$key]['lansia'];
      
        }

      }

      return response( $dataTabel , 200 );

    }

    public function tabelfiltertahunan( Request $request ){
      $dataTabel = [];
      $starttahun = $request->starttahun;
      $endtahun = $request->endtahun;
      $model = $request->model;
      $posyandu = $request->posyandu;
      $startYear = Carbon::createFromDate( $starttahun , 1, 1 )->startOfMonth()->format('Y-m-d');
      $endYear = Carbon::createFromDate( $endtahun , 12, 31 )->endOfMonth()->format('Y-m-d');
      
      if($model === 'pemeriksaan' || $model === 'konsul'){

        $pemereiksaanAnak = PemeriksaanAnak::with(['posyandu' => function ($query) {
          $query->with(['desa' => function ( $querydesa ) {
            $querydesa->with('kecamatan');
          }]);
        } , 'anak' ])->whereBetween('tanggal_pemeriksaan' , [ $startYear , $endYear ]);

        $pemereiksaanIbu = PemeriksaanIbu::with(['posyandu' => function ($query) {
          $query->with(['desa' => function ( $querydesa ) {
            $querydesa->with('kecamatan');
          }]);
        } , 'ibu' ])->whereBetween('tanggal_pemeriksaan' , [ $startYear , $endYear ]);

        $pemereiksaanLansia = PemeriksaanLansia::with(['posyandu' => function ($query) {
          $query->with(['desa' => function ( $querydesa ) {
            $querydesa->with('kecamatan');
          }]);
        } , 'lansia' ])->whereBetween('tanggal_pemeriksaan' , [ $startYear , $endYear ]);


        if( $model === 'pemeriksaan' ){
          $pemereiksaanAnak = $pemereiksaanAnak
            ->whereIn('jenis_pemeriksaan' , ['Pemeriksaan' , 'pemeriksaan'] );
          $pemereiksaanIbu = $pemereiksaanIbu
            ->whereIn('jenis_pemeriksaan' , ['Pemeriksaan' , 'pemeriksaan'] );
          $pemereiksaanLansia = $pemereiksaanLansia
            ->whereIn('jenis_pemeriksaan' , ['Pemeriksaan' , 'pemeriksaan'] );
        }

        if( $model === 'konsul' ){
          $pemereiksaanAnak = $pemereiksaanAnak
            ->whereIn('jenis_pemeriksaan' , ['Konsultasi' , 'konsultasi'] );
          $pemereiksaanIbu = $pemereiksaanIbu
            ->whereIn('jenis_pemeriksaan' , ['Konsultasi' , 'konsultasi'] );
          $pemereiksaanLansia = $pemereiksaanLansia
            ->whereIn('jenis_pemeriksaan' , ['Konsultasi' , 'konsultasi'] );
        }

          
        if( $posyandu !== null ){
          $pemereiksaanAnak = $pemereiksaanAnak->where('id_posyandu' , $posyandu );
          $pemereiksaanIbu =  $pemereiksaanIbu->where('id_posyandu' , $posyandu );
          $pemereiksaanLansia = $pemereiksaanLansia->where('id_posyandu' , $posyandu );
        }

        foreach( $pemereiksaanAnak->get() as $data ){
          if( array_key_exists( $data->id_posyandu , $dataTabel ) === false ) {
            $dataTabel[$data->id_posyandu] = [
              'posyandu' => $data->posyandu->nama_posyandu,
              'kecamatan' => $data->posyandu->desa->kecamatan->nama_kecamatan,
              'anak'  => 1,
              'laki' => ($data->anak->jenis_kelamin === 'laki-laki') ? 1 : 0,
              'perempuan' => ($data->anak->jenis_kelamin === 'perempuan') ? 1 : 0,
            ];
          } else {

            if( isset($dataTabel[$data->id_posyandu]['anak']) === false ) {
              $dataTabel[$data->id_posyandu]['anak'] = 0;
            }

            $dataTabel[$data->id_posyandu]['anak'] = $dataTabel[$data->id_posyandu]['anak'] + 1;
            $dataTabel[$data->id_posyandu]['laki'] = ($data->anak->jenis_kelamin === 'laki-laki') ?  $dataTabel[$data->id_posyandu]['laki'] + 1 : $dataTabel[$data->id_posyandu]['laki'];
            $dataTabel[$data->id_posyandu]['perempuan'] = ($data->anak->jenis_kelamin === 'perempuan') ?  $dataTabel[$data->id_posyandu]['perempuan'] + 1 : $dataTabel[$data->id_posyandu]['perempuan'];

          }
        }
        
        foreach( $pemereiksaanIbu->get() as $data ){
          if( array_key_exists( $data->id_posyandu , $dataTabel ) === false ) {
            $dataTabel[$data->id_posyandu] = [
              'posyandu' => $data->posyandu->nama_posyandu,
              'kecamatan' => $data->posyandu->desa->kecamatan->nama_kecamatan,
              'ibu'  => 1,
              'perempuan' => 1,
            ];
          } else {
            
            if( isset($dataTabel[$data->id_posyandu]['ibu']) === false ) {
              $dataTabel[$data->id_posyandu]['ibu'] = 0;
            }
            $dataTabel[$data->id_posyandu]['perempuan'] = $dataTabel[$data->id_posyandu]['perempuan'] + 1;
            $dataTabel[$data->id_posyandu]['ibu'] = $dataTabel[$data->id_posyandu]['ibu'] + 1;
          }
        }

        foreach( $pemereiksaanLansia->get() as $data ){
          if( array_key_exists( $data->id_posyandu , $dataTabel ) === false ) {
            $dataTabel[$data->id_posyandu] = [
              'posyandu' => $data->posyandu->nama_posyandu,
              'kecamatan' => $data->posyandu->desa->kecamatan->nama_kecamatan,
              'lansia'  => 1,
              'laki' => ($data->lansia->jenis_kelamin === 'laki-laki') ? 1 : 0,
              'perempuan' => ($data->lansia->jenis_kelamin === 'perempuan') ? 1 : 0,
            ];
          } else {

            if( isset($dataTabel[$data->id_posyandu]['lansia']) === false ) {
              $dataTabel[$data->id_posyandu]['lansia'] = 0;
            }

            $dataTabel[$data->id_posyandu]['lansia'] = $dataTabel[$data->id_posyandu]['lansia'] + 1;
            $dataTabel[$data->id_posyandu]['laki'] = ($data->lansia->jenis_kelamin === 'laki-laki') ?  $dataTabel[$data->id_posyandu]['laki'] + 1 : $dataTabel[$data->id_posyandu]['laki'];
            $dataTabel[$data->id_posyandu]['perempuan'] = ($data->lansia->jenis_kelamin === 'perempuan') ?  $dataTabel[$data->id_posyandu]['perempuan'] + 1 : $dataTabel[$data->id_posyandu]['perempuan'];

          }
        }
        
        foreach( $dataTabel as $key => $table ){
            $dataTabel[$key]['anak'] = $table['anak'] ?? 0;
            $dataTabel[$key]['ibu'] = $table['ibu'] ?? 0;
            $dataTabel[$key]['lansia'] = $table['lansia'] ?? 0;
            $dataTabel[$key]['laki']  = $table['laki'] ?? 0;
            $dataTabel[$key]['perempuan']  = $table['perempuan'] ?? 0;

            $dataTabel[$key]['total'] = $dataTabel[$key]['anak'] + $dataTabel[$key]['ibu'] + $dataTabel[$key]['lansia'];
        
          }

      }

      if($model === 'imunisasi' || $model === 'vitamin') {

        $tableModel = null;

        if( $model === 'imunisasi' ){
          $tableModel = new PemberianImunisasi();
          $tableModel = $tableModel->whereBetween('tanggal_pemeriksaan' , [ $startYear , $endYear ]);
        }else{
          $tableModel = new PemberianVitamin();
          $tableModel = $tableModel->whereBetween('tanggal_pemeriksaan' , [ $startYear , $endYear ]);
        }
        $tableModel = $tableModel->with([ 'posyandu' => function ($query) {
          $query->with(['desa' => function ( $querydesa ) {
            $querydesa->with('kecamatan');
          }]);
        } , 'user']);
        
        if( $posyandu !== null ){
          $tableModel = $tableModel->where('id_posyandu' , $posyandu );
        }

        foreach( $tableModel->get() as $data ){
          if( array_key_exists( $data->id_posyandu , $dataTabel ) === false ) {
            $dataTabel[$data->id_posyandu] = [
              'posyandu' => $data->posyandu->nama_posyandu,
              'kecamatan' => $data->posyandu->desa->kecamatan->nama_kecamatan,
              'anak'  => ($data->user->anak !== null) ? 1 : 0,
              'ibu' => ($data->user->ibu !== null) ? 1 : 0,
              'lansia' => ($data->user->lansia !== null) ? 1 : 0,
            ];

            if( $data->user->ibu ){
              $dataTabel[$data->id_posyandu]['perempuan'] = 1;
              $dataTabel[$data->id_posyandu]['laki'] = 0;
            }else{

              if( $data->user->anak ){
                $dataTabel[$data->id_posyandu]['perempuan'] = ($data->user->anak->jenis_kelamin === 'perempuan') ? 1 : 0;
                $dataTabel[$data->id_posyandu]['laki'] = ($data->user->anak->jenis_kelamin === 'laki-laki') ? 1 : 0;
              }else{
                $dataTabel[$data->id_posyandu]['perempuan'] = ($data->user->lansia->jenis_kelamin === 'perempuan') ? 1 : 0;
                $dataTabel[$data->id_posyandu]['laki'] = ($data->user->lansia->jenis_kelamin === 'laki-laki') ? 1 : 0;
              }

            }

          } else {

            $dataTabel[$data->id_posyandu]['anak'] = ($data->user->anak !== null) ? $dataTabel[$data->id_posyandu]['anak'] + 1 : $dataTabel[$data->id_posyandu]['anak'];
            $dataTabel[$data->id_posyandu]['ibu'] = ($data->user->ibu !== null) ? $dataTabel[$data->id_posyandu]['ibu'] + 1 : $dataTabel[$data->id_posyandu]['ibu'];
            $dataTabel[$data->id_posyandu]['lansia'] = ($data->user->lansia !== null) ? $dataTabel[$data->id_posyandu]['lansia'] + 1 : $dataTabel[$data->id_posyandu]['lansia'];
            
            if( $data->user->ibu ){
              $dataTabel[$data->id_posyandu]['perempuan'] = $dataTabel[$data->id_posyandu]['perempuan'] + 1;
              $dataTabel[$data->id_posyandu]['laki'] = $dataTabel[$data->id_posyandu]['laki'];
            }else{

              if( $data->user->anak ){
                $dataTabel[$data->id_posyandu]['perempuan'] = ($data->user->anak->jenis_kelamin === 'perempuan') ? $dataTabel[$data->id_posyandu]['perempuan'] + 1 : $dataTabel[$data->id_posyandu]['perempuan'];
                $dataTabel[$data->id_posyandu]['laki'] = ($data->user->anak->jenis_kelamin === 'laki-laki') ? $dataTabel[$data->id_posyandu]['laki'] + 1 : $dataTabel[$data->id_posyandu]['laki'];
              }else{
                $dataTabel[$data->id_posyandu]['perempuan'] = ($data->user->lansia->jenis_kelamin === 'perempuan') ? $dataTabel[$data->id_posyandu]['perempuan'] + 1 : $dataTabel[$data->id_posyandu]['perempuan'];
                $dataTabel[$data->id_posyandu]['laki'] = ($data->user->lansia->jenis_kelamin === 'laki-laki') ? $dataTabel[$data->id_posyandu]['laki'] + 1 : $dataTabel[$data->id_posyandu]['laki'];
              }

            }

          }
        }

        foreach( $dataTabel as $key => $table ){

          $dataTabel[$key]['total'] = $dataTabel[$key]['anak'] + $dataTabel[$key]['ibu'] + $dataTabel[$key]['lansia'];
      
        }

      }

      return response( $dataTabel , 200 );
    }

    public function filtertabel( Request $request ){

      $type = $request->type;
      $tk = $request->tk;
      $dataFilter = [];

      if( $type === 'kecamatan' ){
        
        if( $tk == 1 ){
          
          $id = auth('admin')->user()->nakes->id;

          $queryKecamatan = NakesPosyandu::where('id_nakes', $id)->with(['posyandu' => function( $query ){
            $query->with(['desa' => function($queryDesa) {
              $queryDesa->with('kecamatan');
            }]);
          }])->get();

          foreach( $queryKecamatan as $data ){
            $dataFilter[] = [
              'nama' => $data->posyandu->desa->kecamatan->nama_kecamatan,
              'id'  => $data->posyandu->desa->id_kecamatan
            ];
          }

        }else{
          $queryKecamatan = \App\Kecamatan::all();
          foreach( $queryKecamatan as $data ){
            $dataFilter[] = [ 'nama' => $data->nama_kecamatan , 'id' => $data->id];
          }
        }

      }  
      
      if( $type === 'kabupaten' ){
        
        if( $tk == 1 ){
          $id = auth('admin')->user()->nakes->id;
          $queryKabupaten = NakesPosyandu::where('id_nakes' , $id)->with(['posyandu' => function( $query ){
            $query->with(['desa' => function($queryDesa) {
              $queryDesa->with(['kecamatan' => function($queryKecamatan) {
                $queryKecamatan->with('kabupaten');
              }]);
            }]);
          }])->get();

          foreach( $queryKabupaten as $data ){
            $dataFilter[] = [
              'id' => $data->posyandu->desa->kecamatan->id_kabupaten,
              'nama'  =>  $data->posyandu->desa->kecamatan->kabupaten->nama_kabupaten
            ];
          }

        }else{
          $queryKabupaten = \App\Kabupaten::all();
          foreach( $queryKabupaten as $data ){
            $dataFilter[] = ['nama' => $data->nama_kabupaten , 'id' => $data->id];
          }
        }
        
      }  

      return response($dataFilter);

    }
}
