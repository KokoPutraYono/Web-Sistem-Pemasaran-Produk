<!DOCTYPE html>
<html>
<head>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" type="text/css" href="{{ asset('style.css') }}">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
  <title>Data Produk</title>
  <style>
    .darkMode {
			background: #4C4C4C;
			color: white;
		}
  </style>
</head>
<body>
  <ul>
    @foreach($logo as $lo)
		<li class="judul">{{$lo->nama_web}}</li>
		@endforeach
  		<li class="turun"><a class="active dropbtn">Admin</a>
        <div class="turun-konten">
          <a href="/admin/user">Menu User</a>
          <a href="/admin/produk">Menu Produk</a>
          <a href="/admin/wilayah">Menu Wilayah</a>
          <a href="/admin/pesan">Menu Pesan</a>
          <a href="/admin/komentar">Menu Komentar</a>
          <a href="/admin/setting">Setting</a>
        </div>
      </li>
      <li><a href="/dassboard">Dashboard</a></li>

      <!-- notifikasi -->
      <li class="turun">
        @if(count(auth()->user()->Notifications ) == 0)
          <a href="#" class="bi bi-bell-fill text-warning" ></a>
        @else
            <a href="#" class="bi bi-bell-fill text-warning" > {{count(auth()->user()->Notifications)}}</a>
        @endif
        <div class="turun-konten" style="color: #2F5670; font-size: 20px; font-weight: Bold">
        
        @if(count(auth()->user()->Notifications ) >= 4)
        @php
          $i = 0;
          @endphp
          @foreach(auth()->user()->Notifications as $notification)
            @php
            $i = $i + 1;
            @endphp

              @if($i == 1)
                <a style="color: red" href="/notifikasi/hapus/{{$notification->notifiable_id}}">Hapus Semua</a>
              @endif
            
          @endforeach
          <a href="/admin/pesan">Pesan masuk Lebih dari 3</a>
        @else
          @php
          $i = 0;
          @endphp
          @foreach(auth()->user()->Notifications as $notification)
            @php
            $i = $i + 1;
            @endphp

              @if($i == 1)
                <a style="color: red" href="/notifikasi/hapus/{{$notification->notifiable_id}}">Hapus Semua</a>
              @endif
            <a href="/admin/pesan">{{$notification->data['name']}}</a>
            
          @endforeach
          
        @endif
      </li>

      <li style="float: right;">
        <form action="/logout" method="post">
          {{ csrf_field() }}
          <button style="background-color: #2874A6; color: white; width: 100%; height: 100%;">Log Out</button>
        </form>
			</li>

      <li style="float: right; margin-right: 50px;">
        <!-- sun atau matahari -->
        <a onclick="setDarkMode()" id="darkBtn"><i class="bi bi-brightness-high-fill text-warning"></i></a>
      </li>
    
    @guest
      <li><a href="/dassboard">Dashboard</a></li>
  	  <li><a href="/kontak">Kontak</a></li>
		  <li style="float: right;" class="login"><a href="/login">Log In</a></li>
		@endguest
	</ul>

  <div class="container">
    <table>
      <tr>
        <th>Kode Barang</th>
        <th>Nama Barang</th>
        <th>Deskripsi</th>
        <th>Gambar</th>
      </tr>
      @foreach($data_produk as $pro)
      <tr>
        <td width="10%">{{$pro->kode_produk}}</td>
        <td width="15%">{{$pro->nama_produk}}</td>
        <td width="30%">{{$pro->deskripsi}}</td>
        <td width="15%"><img src="{{ url('images/'.$pro->image) }}" width="100%" align="center"></td>
        <td class="ehd"><a href="/admin/produkEdit/{{$pro->id}}" class="ehl"><i class="fa-solid fa-pen"></i></a></td>
        <td class="ehd"><a href="/admin/produkHapus/{{$pro->id}}" class="ehl" onclick="fHapus()"><i class="fa-solid fa-trash"></i></a></td>
        <td class="eht"><a href="/admin/wilayahTambah/{{$pro->id}}" class="ehl"><i class="fa-solid fa-location-dot"></i>Tambah Wilayah</a></td>
      </tr>
      @endforeach
    </table>

    <div class="mb-3" style="display: flex; justify-content: center;">
      {!!$data_produk->links()!!}
    </div>

    <a href="/admin/produkTambah" class="klik">Tambah</a>
  </div>

  <script>
		if (localStorage.getItem('theme') == 'dark')
			setDarkMode()
		
		function setDarkMode() {
			let emoticon = ''
			let isDark = document.body.classList.toggle('darkMode')

			if (isDark) {
				// sun atau matahari
				emoticon = '<i class="bi bi-moon-stars-fill text-warning"></i>'
				localStorage.getItem('theme', 'dark')
					
			}else{
				// moon atau bulan
				emoticon = '<i class="bi bi-brightness-high-fill text-warning"></i>'
				localStorage.removeItem('theme')
			}
			document.getElementById('darkBtn').innerHTML = emoticon
		}
	</script>
  
<script>
function fHapus() {
  var txt;
  if (confirm("Yakin Ingin Menghapus?")) {
  } else {
  }
}
</script>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>


</body>
</html>