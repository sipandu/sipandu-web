<?php

namespace App\Http\Controllers\User\Auth;
use App\KK;
use App\User;
use App\Anak;
use App\Ibu;
use App\Lansia;
use App\Kabupaten;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class RegisController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware('guest')->except('logout');
    // }


    public function landingRegis(Request $request)
    {
        return view('pages/auth/regis-landing');
    }

    public function landingVerif(Request $request)
    {
        return view('pages/auth/verif-landing');
    }

    // Source dimana melakukan pengecekan noKK pada Database //
    public function submitLanding(Request $request)
    {
        $noKK = $request->noKK;
        $selectKK = KK::where('no_kk', $noKK)->first();
        $role = $request->role;
        if($selectKK != null){
            $idKK = $selectKK->id;
            return view('pages/auth/user/form-register',['idKK' => $idKK,'role' => $role,'noKK' => $request->noKK]);
        }else{
            $idKK = null;
            return view('pages/auth/user/form-register',['idKK' => $idKK,'role' => $role,'noKK' => $request->noKK]);
        }

    }



    public function showRegisFormAnak(Request $request)
    {
        $kabupaten = Kabupaten::all();
        return view('pages/auth/user/data-diri/anak',compact('kabupaten'));
    }

    public function showRegisFormIbu(Request $request)
    {
        $kabupaten = Kabupaten::all();
        return view('pages/auth/user/data-diri/ibu',compact('kabupaten'));
    }

    public function showRegisFormLansia(Request $request)
    {
        $kabupaten = Kabupaten::all();
        return view('pages/auth/user/data-diri/lansia',compact('kabupaten'));
    }


    public function test(Request $request)
    {
        return view('category',compact('categories'));
        // $kecamatan = Kecamatan::where('id_kabupaten','2')->get();
        // return $kecamatan->nama_kecamatan;

        // $kabupaten = new Kecamatan;
        // $kabupaten = Kabupaten::with('kecamatan')->where('id',2)->first();
        // echo($kabupaten->kecamatan->nama_kecamatan);

        // $user = new User;
        // $select = User::with('anak')->first();
        // $test = $user->anak()->where('id_user',6)->first();
        // echo($select->anak->nama_anak);


    }


    // Fungsi dari registrasi awal user baik itu lansia,ibu dan anak //
    public function sumbmitRegisAnak(Request $request){
        if($request->idKK != null){
            $this->validate($request, [
                'name' => 'required',
                'email' => 'required',
                'password' => 'required',
            ]);

            $user = new User;
            $user->id_kk = $request->idKK;
            $user->email = $request->email;
            $user->profile_image = "/images/upload/Profile/deafult.jpg";
            $user->id_chat_tele = 0;
            $user->password = Hash::make($request->password);
            $user->is_verified = 0;
            $user->save();

            $anak = new Anak;
            $anak->nama_anak = $request->name;
            $user->anak()->save($anak);


            echo("berhasil Input Data");

        }else{
            $this->validate($request, [
                'name' => 'required',
                'email' => 'required',
                'password' => 'required',
                'img_kk'=> 'required|image|mimes:jpeg,png,jpg',
            ]);

            $path ='/images/upload/KK/'.time().'-'.$request->img_kk->getClientOriginalName();
            $imageName = time().'-'.$request->img_kk->getClientOriginalName();

            $request->img_kk->move(public_path('images/upload/KK'),$imageName);

            $kk = new KK;
            $kk->no_kk = $request->noKK;
            $kk->file_kk = $path;
            $kk->save();

            $user = new User;
            $user->id_kk = $request->idKK;
            $user->email = $request->email;
            $user->id_chat_tele = 0;
            $user->password = Hash::make($request->password);
            $user->profile_image = "/images/upload/Profile/deafult.jpg";
            $user->is_verified = 0;
            $kk->user()->save($user);

            $anak = new Anak;
            $anak->nama_anak = $request->name;
            $user->anak()->save($anak);

            echo("berhasil Input Data");

        }



    }

    public function sumbmitRegisLansia(Request $request){
        if($request->idKK != null){
            $this->validate($request, [
                'name' => 'required',
                'email' => 'required',
                'password' => 'required',
            ]);

            $user = new User;
            $user->id_kk = $request->idKK;
            $user->email = $request->email;
            $user->profile_image = "/images/upload/Profile/deafult.jpg";
            $user->id_chat_tele = 0;
            $user->password = Hash::make($request->password);
            $user->is_verified = 0;
            $user->save();

            $lansia = new Lansia;
            $lansia->nama_lansia = $request->name;
            $user->lansia()->save($lansia);


            echo("berhasil Input Data");

        }else{
            $this->validate($request, [
                'name' => 'required',
                'email' => 'required',
                'password' => 'required',
                'img_kk'=> 'required|image|mimes:jpeg,png,jpg',
            ]);

            $path ='/images/upload/KK/'.time().'-'.$request->img_kk->getClientOriginalName();
            $imageName = time().'-'.$request->img_kk->getClientOriginalName();

            $request->img_kk->move(public_path('images/upload/KK'),$imageName);

            $kk = new KK;
            $kk->no_kk = $request->noKK;
            $kk->file_kk = $path;
            $kk->save();

            $user = new User;
            $user->id_kk = $request->idKK;
            $user->email = $request->email;
            $user->id_chat_tele = 0;
            $user->password = Hash::make($request->password);
            $user->profile_image = "/images/upload/Profile/deafult.jpg";
            $user->is_verified = 0;
            $kk->user()->save($user);

            $lansia = new Lansia;
            $lansia->nama_lansia = $request->name;
            $user->lansia()->save($lansia);

            echo("berhasil Input Data");

        }

    }

    public function sumbmitRegisIbu(Request $request){
        if($request->idKK != null){
            $this->validate($request, [
                'name' => 'required',
                'email' => 'required',
                'password' => 'required',
            ]);

            $user = new User;
            $user->id_kk = $request->idKK;
            $user->email = $request->email;
            $user->profile_image = "/images/upload/Profile/deafult.jpg";
            $user->id_chat_tele = 0;
            $user->password = Hash::make($request->password);
            $user->is_verified = 0;
            $user->save();

            $ibu = new Ibu;
            $ibu->nama_ibu_hamil = $request->name;
            $user->ibu()->save($ibu);


            echo("berhasil Input Data");

        }else{
            $this->validate($request, [
                'name' => 'required',
                'email' => 'required',
                'password' => 'required',
                'img_kk'=> 'required|image|mimes:jpeg,png,jpg',
            ]);

            $path ='/images/upload/KK/'.time().'-'.$request->img_kk->getClientOriginalName();
            $imageName = time().'-'.$request->img_kk->getClientOriginalName();

            $request->img_kk->move(public_path('images/upload/KK'),$imageName);

            $kk = new KK;
            $kk->no_kk = $request->noKK;
            $kk->file_kk = $path;
            $kk->save();

            $user = new User;
            $user->id_kk = $request->idKK;
            $user->email = $request->email;
            $user->id_chat_tele = 0;
            $user->password = Hash::make($request->password);
            $user->profile_image = "/images/upload/Profile/deafult.jpg";
            $user->is_verified = 0;
            $kk->user()->save($user);

            $ibu = new Ibu;
            $ibu->nama_ibu_hamil = $request->name;
            $user->ibu()->save($ibu);

            echo("berhasil Input Data");

        }

    }
    // akhir dari fungsi registrasi user awal belum termasuk dari data diri //


    // Awal dari registrasi lanjut data diri user //
    public function submitDatadiriAnak(Request $request){
        dd($request->all());
        $this->validate($request, [
            'KIA' => 'required',
            'namaAyah' => 'required',
            'namaIbu' => 'required',
            'tempatLahir' => 'required',
            'tanggalLahir' => 'required',
            'anakKe' => 'required',
            'notlpn' => 'required',
            'gender' => 'required',
            'kabupaten' => 'required',
            'kecamatan' => 'required',
            'desa' => 'required',
            'banjar' => 'required',
            'alamat' => 'required',
        ]);

        $alamat = $request->alamat;
        $kabupaten = $request->kabupaten;
        $kecamatan = $request->kecamatan;
        $desa = $request->desa;
        $banjar = Posyandu::where('id',$request->banjar)->first();
        $mergeAlamat = $alamat.', '.$banjar->banjar.', '.$desa.', '.$kecamatan.', '.$kabupaten;

        $anak = new Anak;
        $anak->id_posyandu = $request->banjar;
        $anak->nama_ayah = $request->namaAyah;
        $anak->nama_ibu = $request->namaIbu;
        $anak->tempat_lahir = $request->tempatLahir;
        $anak->tanggal_lahir = $request->tanggalLahir;
        $anak->jenis_kelamin = $request->gender;
        $anak->anak_ke = $request->anakKe;
        $anak->alamat = $mergeAlamat;
        $anak->nomor_telepon = $request->notlpn;
        $anak->NIK = $request->KIA;
        $anak->save();


    }




}
