<!-- <?php

// namespace App\Http\Controllers;
// use Carbon\Carbon;
// use App\Posyandu;
// use App\Admin;
// use App\Pegawai;
// use App\Kabupaten;
// use App\Kecamatan;
// use App\Desa;
// use App\Kegiatan;

// use Illuminate\Http\Request;

// class MasterDataController extends Controller
// {
//     public function listPosyandu()
//     {
//         $admin = Admin::with('pegawai')->get();
//         $posyandu = Posyandu::with('pegawai')->orderBy('nama_posyandu', 'asc')->get();
//         $pegawai = Pegawai::where('jabatan', 'admin')->get();

//         return view('pages/admin/master-data/data-posyandu/data-posyandu', compact('posyandu', 'pegawai'));
//     }

//     public function addPosyandu()
//     {
//         $kabupaten = Kabupaten::get();
//         $kecamatan = Kecamatan::get();
//         $desa = Desa::get();

//         return view('pages/admin/master-data/data-posyandu/new-posyandu', compact('kabupaten', 'kecamatan', 'desa'));
//     }

//     public function storePosyandu(Request $request)
//     {
//         $this->validate($request,[
//             'nama_posyandu' => "required|regex:/^[a-z ]+$/i|min:2|max:27",
//             'kabupaten' => 'required|exists:tb_kabupaten,nama_kabupaten',
//             'kecamatan' => 'required|exists:tb_kecamatan,nama_kecamatan',
//             'desa' => 'required|exists:tb_desa,nama_desa',
//             'banjar' => "required|regex:/^[a-z ]+$/i|min:3",
//             'telp_posyandu' => "nullable|numeric|digits_between:10,15|unique:tb_posyandu,nomor_telepon",
//             'alamat_posyandu' => "required|min:7",
//             'lat' => "required|regex:/^[0-9.-]+$/i|min:5",
//             'lng' => "required|regex:/^[0-9.-]+$/i|min:5",
//             'nama_pegawai' => "required|regex:/^[a-z ]+$/i|min:2|max:50",
//             'tempat_lahir' => "required|regex:/^[a-z ]+$/i|min:3",
//             'tgl_lahir' => "required|date",
//             'gender' => "required",
//             'nik' => "required|numeric|unique:tb_pegawai,nik|digits:16",
//             'email' => "required|email|unique:tb_admin,email",
//             'telp_pegawai' => "required|numeric|digits_between:12,15|unique:tb_pegawai,nomor_telepon",
//             'telegram' => "nullable|min:3|unique:tb_pegawai,username_telegram",
//             'alamat_pegawai' => "required|regex:/^[a-z .,0-9]+$/i|min:7",
//             'password' => 'required|min:8|max:50|confirmed'
//         ],
//         [
//             'nama_posyandu.required' => "Nama Posyandu wajib diisi",
//             'nama_posyandu.regex' => "Format penamaan posyandu tidak sesuai",
//             'nama_posyandu.min' => "Nama posyandu minimal 2 huruf",
//             'nama_posyandu.max' => "Nama posyandu maksimal 27 huruf",
//             'kabupaten.required' => "Kabupaten wajib diisi",
//             'kabupaten.exists' => "Kabupaten yang dimasukan tidak tersedia",
//             'kecamatan.required' => "Kecamatan wajib diisi",
//             'kecamatan.exists' => "Kecamatan yang dimasukan tidak tersedia",
//             'desa.required' => "Desa wajib diisi",
//             'desa.exists' => "Desa yang dimasukan tidak tersedia",
//             'banjar.required' => "Banjar wajib diisi",
//             'banjar.regex' => "Format nama banjar tidak sesuai",
//             'banjar.min' => "Nama banjar minimal 3 huruf",
//             'telp_posyandu.numeric' => "Nomor telepon posyandu harus berupa angka",
//             'telp_posyandu.digits_between' => "Nomor telepon posyandu harus berjumlah 10 sampai 15 digit",
//             'telp_posyandu.unique' => "Nomor telepon posyandu sudah digunakan",
//             'alamat_posyandu.required' => "Alamat posyandu wajib diisi",
//             'alamat_posyandu.regex' => "Format alamat posyandu tidak sesuai",
//             'alamat_posyandu.min' => "Alamat posyandu minimal 7 karakter",
//             'lat.required' => "Koordinat Latitude posyandu wajib diisi",
//             'lat.regex' => "Format koordinat Latitude posyandu tidak sesuai",
//             'lng.required' => "Koordinat Longitude posyandu wajib diisi",
//             'lng.regex' => "Format koordinat Longitude posyandu tidak sesuai",
//             'nama_pegawai.required' => "Nama pegawai wajib diisi",
//             'nama_pegawai.regex' => "Format nama pegawai tidak sesuai",
//             'nama_pegawai.min' => "Nama pegawai minimal 2 karakter",
//             'nama_pegawai.max' => "Nama pegawai maksimal 50 karakter",
//             'tempat_lahir.regex' => "Format tempat lahir tidak sesuai",
//             'tempat_lahir.min' => "Tempat lahir minimal 3 karakter",
//             'tgl_lahir.required' => "Tanggal lahir wajib diisi",
//             'tgl_lahir.date' => "Tanggal lahir harus berupa tanggal",
//             'gender.required' => "Jenis kelamin wajib dipilih",
//             'nik.required' => "NIK wajib diisi",
//             'nik.numeric' => "NIK telah digunakan sebelumnya",
//             'nik.digits' => "NIK harus berjumlah 16 karakter",
//             'email.required' => "Email pegawai wajib diisi",
//             'email.email' => "Masukan email yang valid",
//             'email.unique' => "Email telah digunakan sebelumnya",
//             'telp_pegawai.required' => "Nomor telepon pegawai wajib diisi",
//             'telp_pegawai.numeric' => "Nomor telepon pegawai harus berupa angka",
//             'telp_pegawai.digits_between' => "Nomor telepon harus berjumlah 12 sampai 15 digit",
//             'telp_pegawai.unique' => "Nomor telepon sudah pernah digunakan",
//             'telegram.min' => "Username telegram terlalu pendek",
//             'telegram.unique' => "Username telegram sudah digunakan",
//             'alamat_pegawai.required' => "Alamat pegawai wajib diisi",
//             'alamat_pegawai.regex' => "Format alamat pegawai tidak sesuai",
//             'alamat_pegawai.min' => "Alamat pegawai minimal 7 karakter",
//             'password.required' => "Password wajib diisi",
//             'password.min' => "Password minimal 8 karakter",
//             'password.max' => "Password maksimal 50 karakter",
//             'password.confirmed' => "Konfirmasi password tidak sesuai"
//         ]);

//         Validate Password
//         $this->validate([
//             'last_password' => "required|min:6",
//             'password' => 'required|confirmed|min:6'
//         ]);

//         $admin = Admin::where('id', $this->adminID)->get()->first();

//         if (Hash::check($this->last_password, $admin->password)) {
//             Admin::where('id', $this->adminID)->update([
//                 'password' => bcrypt($this->password)
//             ]);

//             $this->clearModal();

//             session()->flash('messageSuccess', 'Password anda berhasil di ubah');

//         } else{
//             session()->flash('messageFailed', 'Password lama anda tidak sesuai');
//         }

//         $admin = Admin::create([
//             'email' => $request->email,
//             'password' => $request->password,
//             'profile_image' => "profile123",
//             'is_verified' => "1"
//         ]);

//         $desa = Desa::where('nama_desa', $request->desa)->get()->first();

//         $posyandu = Posyandu::create([
//             'id_desa' => $desa->id,
//             'id_admin' => $admin->id,
//             'id_chat_group_tele' => NULL,
//             'nama_posyandu' => $request->nama_posyandu,
//             'alamat' => $request->alamat_posyandu,
//             'nomor_telepon' => $request->telp_posyandu,
//             'banjar' => $request->banjar,
//             'latitude' => $request->lat,
//             'longitude' => $request->lng
//         ]);

//         $tgl_lahir_indo = $request->tgl_lahir;
//         $tgl_lahir_eng = explode("-", $tgl_lahir_indo);
//         $tahun = $tgl_lahir_eng[2];
//         $bulan = $tgl_lahir_eng[1];
//         $tgl = $tgl_lahir_eng[0];
//         $tgl_lahir = $tahun.$bulan.$tgl;

//         Pegawai::create([
//             'id_posyandu' => $posyandu->id,
//             'id_admin' => $admin->id,
//             'nama_pegawai' => $request->nama_pegawai,
//             'tempat_lahir' => $request->tempat_lahir,
//             'tanggal_lahir' => $tgl_lahir,
//             'jenis_kelamin' => $request->gender,
//             'alamat' => $request->alamat_pegawai,
//             'nomor_telepon' => $request->no_telp,
//             'jabatan' => "admin",
//             'username_telegram' => $request->telegram,
//             'nik' => $request->nik,
//             'file_ktp' => "qqsda134"
//         ]);

//         return redirect()->route("Data Posyandu");
//     }

//     public function testing()
//     {
//         Carbon::setLocale('id');
//         $today = Carbon::now()->setTimezone('GMT+8')->toTimeString();
        
//         untuk di db
//         $waktuSaatIni = Carbon::now()->setTimezone('GMT+8');

//         disable created dan update di db
//         public $timestamps = false;

//         $now = Carbon::parse($today);

//         $compare = Carbon::parse('2021-03-19 21:19:15');
        
//         $duration = $compare->diff($now);

//         $minutes = ($duration->i);

//         return($minutes);
//     }

//     public function detailPosyandu(Posyandu $posyandu)
//     {
//         Carbon::setLocale('id');
//         $today = Carbon::now()->setTimezone('GMT+8')->toDateString();

//         $dataPosyandu = Posyandu::with('pegawai')->where('id', $posyandu->id)->get();
//         $pegawai = Pegawai::where('id_posyandu', $posyandu->id)->get();

//         Upcoming Event Checking
//         $nextKegiatan = Kegiatan::where('id_posyandu', $posyandu->id)->where('start_at', '>', $today)->get();

//         Ended Event Checking
//         $lastKegiatan = Kegiatan::where('id_posyandu', $posyandu->id)->where('end_at', '<', $today)->get();

//         In progres Event Checking
//         $currentKegiatan = Kegiatan::where('id_posyandu', $posyandu->id)->where('start_at', '<', $today)->where('end_at', '>', $today)->get();

//         return view('pages/admin/master-data/data-posyandu/detail-posyandu', compact(
//             'dataPosyandu', 'pegawai', 'nextKegiatan', 'lastKegiatan', 'currentKegiatan'
//         ));
//         return $kegiatanPosyandu;
//     }

//     public function editPosyandu(Posyandu $posyandu)
//     {
//         Carbon::setLocale('id');
//         $today = Carbon::now()->setTimezone('GMT+8')->toDateString();

//         $dataPosyandu = Posyandu::with('pegawai')->where('id', $posyandu->id)->get();
//         $pegawai = Pegawai::where('id_posyandu', $posyandu->id)->get();

//         Upcoming Event Checking
//         $nextKegiatan = Kegiatan::where('id_posyandu', $posyandu->id)->where('start_at', '>', $today)->get();

//         Ended Event Checking
//         $lastKegiatan = Kegiatan::where('id_posyandu', $posyandu->id)->where('end_at', '<', $today)->get();

//         In progres Event Checking
//         $currentKegiatan = Kegiatan::where('id_posyandu', $posyandu->id)->where('start_at', '<', $today)->where('end_at', '>', $today)->get();

//         return view('pages/admin/master-data/data-posyandu/edit-posyandu', compact(
//             'dataPosyandu', 'pegawai', 'nextKegiatan', 'lastKegiatan', 'currentKegiatan'
//         ));
//         return $kegiatanPosyandu;
//     }

//     public function updatePosyandu(Request $request, Posyandu $posyandu)
//     {
//         $request->validate([
//             'nama' => "required|regex:/^[a-z ]+$/i|min:2|max:27",
//             'banjar' => "required|regex:/^[a-z ]+$/i|min:3",
//             'telp' => "required|numeric|digits_between:10,15",
//             'alamat' => "required|regex:/^[a-z ,.]+$/i|min:7",
//             'lat' => "required|regex:/^[0-9.-]+$/i|min:5",
//             'lng' => "required|regex:/^[0-9.-]+$/i|min:5"
//         ],
//         [
//             'nama.required' => "Nama Posyandu wajib diisi",
//             'nama.regex' => "Format penamaan posyandu tidak sesuai",
//             'nama.min' => "Nama posyandu minimal 2 huruf",
//             'nama.max' => "Nama posyandu maksimal 27 huruf",
//             'banjar.required' => "Banjar wajib diisi",
//             'banjar.regex' => "Format nama banjar tidak sesuai",
//             'banjar.min' => "Nama banjar minimal 3 huruf",
//             'telp.numeric' => "Nomor telepon posyandu harus berupa angka",
//             'telp.digits_between' => "Nomor telp posyandu harus berjumlah 10 sampai 15 digit",
//             'alamat.required' => "Alamat posyandu wajib diisi",
//             'alamat.regex' => "Format alamat posyandu tidak sesuai",
//             'alamat.min' => "Alamat posyandu minimal 7 karakter",
//             'lat.required' => "Koordinat Latitude posyandu wajib diisi",
//             'lat.regex' => "Format koordinat Latitude posyandu tidak sesuai",
//             'lng.required' => "Koordinat Longitude posyandu wajib diisi",
//             'lng.regex' => "Format koordinat Longitude posyandu tidak sesuai"
//         ]);

//         $data = Posyandu::where('id', $posyandu->id)->update([
//             'nama_posyandu' => $request->nama,
//             'banjar' => $request->banjar,
//             'nomor_telepon' => $request->telp,
//             'alamat' => $request->alamat,
//             'latitude' => $request->lat,
//             'longitude' => $request->lng,
//         ]);

//         if ($data > 0) {
//             return redirect()->route('Detail Posyandu', [$posyandu->id]);
//         } else if ($data < 1) {
//             return ('Input Gagal');
//         }

//         return $request;
//     }

//     public function updateAdminPosyandu(Request $request, Pegawai $pegawai)
//     {
//         $request->validate([
//             'nama' => "required|regex:/^[a-z ]+$/i|min:2|max:27",
//             'banjar' => "required|regex:/^[a-z ]+$/i|min:3",
//             'telp' => "required|numeric|digits_between:10,15",
//             'alamat' => "required|regex:/^[a-z ,.]+$/i|min:7",
//             'lat' => "required|regex:/^[0-9.-]+$/i|min:5",
//             'lng' => "required|regex:/^[0-9.-]+$/i|min:5"
//         ],
//         [
//             'nama.required' => "Nama Posyandu wajib diisi",
//             'nama.regex' => "Format penamaan posyandu tidak sesuai",
//             'nama.min' => "Nama posyandu minimal 2 huruf",
//             'nama.max' => "Nama posyandu maksimal 27 huruf",
//             'banjar.required' => "Banjar wajib diisi",
//             'banjar.regex' => "Format nama banjar tidak sesuai",
//             'banjar.min' => "Nama banjar minimal 3 huruf",
//             'telp.numeric' => "Nomor telepon posyandu harus berupa angka",
//             'telp.digits_between' => "Nomor telp posyandu harus berjumlah 10 sampai 15 digit",
//             'alamat.required' => "Alamat posyandu wajib diisi",
//             'alamat.regex' => "Format alamat posyandu tidak sesuai",
//             'alamat.min' => "Alamat posyandu minimal 7 karakter",
//             'lat.required' => "Koordinat Latitude posyandu wajib diisi",
//             'lat.regex' => "Format koordinat Latitude posyandu tidak sesuai",
//             'lng.required' => "Koordinat Longitude posyandu wajib diisi",
//             'lng.regex' => "Format koordinat Longitude posyandu tidak sesuai"
//         ]);

//         $data = Pegawai::where('nik', $pegawai->nik)->update([
//             'jabatan' => 'disactive'
//         ]);

//         $posyandu = Posyandu::where('id', $pegawai->id_posyandu)->get()->first();

//         if ($data > 0) {
//             return redirect()->route('Detail Posyandu', [$posyandu->id]);
//         } else if ($data < 1) {
//             return ('Input Gagal');
//         }

//         return $pegawai;
//     }   
// }
