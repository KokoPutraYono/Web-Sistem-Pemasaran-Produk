<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Notifications\PesanNotification;
use Notification;


class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function pesan()
    {
        $pesan = DB::table('pesan')->paginate(10);
        $logo = DB::table('logo')->get();

        return view('adminPesan',['data_pesan'=>$pesan, 'logo'=>$logo]);
    }

    public function kontak()
    {
        $logo = DB::table('logo')->get();

        return view('kontak', ['logo'=>$logo]);
    }

    public function KontakStore(Request $request)
    {
        $user = User::all();
        DB::table('pesan')->insert([
            'nama_email' => $request->email,
            'deskripsi' => $request->deskripsi,
            'pesan' => $request->pesan
        ]);
        
        Notification::send($user, new PesanNotification($request->deskripsi));
        
        return redirect('/kontak');
    }

    public function HapusPesan($id)
    {
        DB::table('pesan')->where('id', $id)->delete();

        return redirect('/admin/pesan');
    }

    public function dassboard()
    {
        $dassboard = DB::table('data_produk')->get();
        $logo = DB::table('logo')->get();
        $user = User::find(1);
        
        return view('dassboard', ['dassboard' => $dassboard, 'logo'=>$logo], compact('user'));
    }

    public function produk()
    {
        $produk = DB::table('data_produk')->paginate(3);
        $logo = DB::table('logo')->get();
        $user = User::find(1);

        return view('Admin',['data_produk'=>$produk, 'logo'=>$logo], compact('user'));
    }

    public function produkTambah()
    {
        $logo = DB::table('logo')->get();
        $user = User::find(1);

        return view('/Admin/TambahProduk', ['logo'=>$logo], compact('user'));
    }

    public function produkStore(Request $request)
    {
        $file = $request->file('image');
        $ext = $file->getClientOriginalExtension();

        $dateTime = date('Ymd_his');
        $newName = 'image_'.$dateTime.'.'.$ext;

        $file->move(public_path('/images'.env('PATH_IMAGE')),$newName);

        $length = 10;
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        //insert data ke tabel 
        DB::table('data_produk')->insert([
            'kode_produk' => $randomString,
            'nama_produk' => $request->namabarang,
            'deskripsi' => $request->desk,
            'image' =>$newName,
        ]);

        return redirect('/admin/produk');
    }

    public function produkEdit($id)
    {
        $produk = DB::table('data_produk')->where('id', $id)->get();
        $logo = DB::table('logo')->get();
        $user = User::find(1);

        return view('/Admin/EditProduk', ['produk_edit' => $produk, 'logo'=>$logo], compact('user'));
    }

    public function produkUpdate(Request $request, $id)
    {
        if ( $request->image !== null) {

            $file = $request->file('image')->getClientOriginalExtension();

            $dateTime = date('Ymd_his');
            $newName = 'image_'.$dateTime.'.'.$file;

            $file->move(public_path('/images'.env('PATH_IMAGE')),$newName);

             DB::table('data_produk')->where('id', $id)->update([
                'kode_produk'=> $request->kodebarang,
                'nama_produk'=> $request->namabarang,
                'deskripsi'=> $request->desk,
                'image'=> $newName,
            ]);
        }else{
            DB::table('data_produk')->where('id', $id)->update([
                'kode_produk'=> $request->kodebarang,
                'nama_produk'=> $request->namabarang,
                'deskripsi'=> $request->desk,
                
            ]);
        }

        return redirect('/admin/produk');
    }

    public function produkHapus($id)
    {
        DB::table('data_produk')->where('id', $id)->delete();

        return redirect('/admin/produk');
    }

    public function user()
    {
        $dataUser = DB::table('users')->paginate(10);
        $logo = DB::table('logo')->get();
        $user = User::find(1);

        return view('AdminUser',['data_user'=>$dataUser, 'logo'=>$logo], compact('user'));
    }

    public function userTambah()
    {
        $logo = DB::table('logo')->get();
        $user = User::find(1);

        return view('/User/TambahUser', ['logo'=>$logo], compact('user'));
    }

    public function userStore(Request $request)
    {
        DB::table('users')->insert([
            'name' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->pass)
        ]);

        return redirect('/admin/user');
    }

    public function userEdit($id)
    {
        $dataUser = DB::table('users')->where('id', $id)->get();
        $logo = DB::table('logo')->get();
        $user = User::find(1);

        return view('/User/EditUser', ['user_edit' => $dataUser, 'logo'=>$logo], compact('user'));
    }

    public function userUpdate(Request $request, $id)
    {
        DB::table('users')->where('id', $id)->update([
            'name'=> $request->username,
            'email'=> $request->email,
            'password'=> $request->pass,
        ]);

        return redirect('/admin/user');
    }

    public function HapusUser($id)
    {
        DB::table('users')->where('id', $id)->delete();

        return redirect('/admin/user');
    }

    public function wilayah()
    {
        $wilayah = DB::table('data_wilayah')->paginate(13);
        $logo = DB::table('logo')->get();
        $user = User::find(1);
        
        return view('AdminWilayah', ['data_wilayah' => $wilayah, 'logo'=>$logo], compact('user'));

    }

    public function WilayahTambah($id)
    {
        $wilayah = DB::table('data_produk')->where('id', $id)->get();
        $logo = DB::table('logo')->get();
        $user = User::find(1);

        return view('/Wilayah/TambahWil', ['wilayah_tambah' => $wilayah, 'logo'=>$logo], compact('user'));
    }

    public function wilayahStore(Request $request)
    {
        DB::table('data_wilayah')->insert([
            'kode_produk' => $request->kodeproduk,
            'nama_produk' => $request->namaproduk,
            'wilayah' => $request->wilayah,
        ]);

        return redirect('/admin/wilayah');
    }

    public function wilayahEdit($id)
    {
        $wilayah = DB::table('data_wilayah')->where('id', $id)->get();
        $logo = DB::table('logo')->get();
        $user = User::find(1);

        return view('/Wilayah/EditWil', ['wilayah_edit' => $wilayah, 'logo'=>$logo], compact('user'));
    }

    public function wilayahUpdate(Request $request, $id)
    {
        DB::table('data_wilayah')->where('id', $id)->update([
            'kode_produk' => $request->kodeproduk,
            'nama_produk' => $request->namaproduk,
            'wilayah' => $request->wilayah,
        ]);

        return redirect('/admin/wilayah');
    }

    public function wilayahHapus($id)
    {
        DB::table('data_wilayah')->where('id', $id)->delete();

        return redirect('/admin/wilayah');
    }

    public function distribusi($kode)
    {
        $produk = DB::table('data_produk')->where('kode_produk', $kode)->get();
        $wil = DB::table('data_wilayah')->where('kode_produk', $kode)->get();
        $logo = DB::table('logo')->get();
        $komentar = DB::table('komen')->where('kode_produk', $kode)->get();
        $user = User::find(1);

        
        return view('distribusi', ['detail' => $produk, 'wil' => $wil, 'logo'=>$logo, 'komen' =>$komentar], compact('user'));    
    }

    public function login()
    {
        $logo = DB::table('logo')->get();
        return view('login', ['logo'=>$logo]);
    }

    public function loginStore(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required'
        ]);
 
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
 
            return redirect()->intended('/admin/produk');
        }
 
        return back()->with('loginError', 'Login failed!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    
        return redirect('/');
    }

    public function setting()
    {
        $logo = DB::table('logo')->get();
        $user = User::find(1);

        return view('setting', ['logo' => $logo], compact('user'));
    }

    public function settingUpdate(Request $request, $id)
    {
        DB::table('logo')->where('id', $id)->update([
            'nama_web' => $request -> logo,
        ]);

        return redirect('/admin/setting');
    }

    public function komentar()
    {
        $komen = DB::table('komen')->paginate(10);

        $logo = DB::table('logo')->get();

        return view('adminKomen', ['komen' => $komen, 'logo' => $logo]);
    }

    public function storeKometar(Request $request)
    {
        DB::table('komen')->insert([
            'kode_produk' => $request->kode_produk,
            'nama_produk' => $request->nama_produk,
            'nama' => $request->nama,
            'email' => $request->email,
            'Komentar' => $request->komentar,
        ]);

        return redirect('/dassboard');
    }

    public function hapusKomen($id)
    {
        DB::table('komen')->where('id', $id)->delete();

        return redirect('/admin/komentar');
    }

    public function hapusNotifikasi($id){
        DB::table('notifications')->where('notifiable_id', $id)->delete();

        return redirect('/dassboard');
    }
}
