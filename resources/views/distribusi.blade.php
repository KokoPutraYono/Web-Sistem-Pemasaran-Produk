<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Distribusi</title>
	<style type="text/css">
		ul {
			list-style-type: none ;
			margin: 0;
			padding: 0;
			overflow: hidden;
			background-color: #2874A6;
		}
		li{
			float: left;
		}
		.login {
  			background-color: #175873;
  			color: #2F5670;
  			margin: 2px;
		}
		li a{
			display: block;
			color: white;
			text-align: center;
			padding: 14px;
			text-decoration: none;
		}
		li b{
			font-family:Billion Dreams ;
			display: block;
			color: white;
			text-align: center;
			padding: 14px;
			text-decoration: none;
			
		}
		td a{
			display: block;
			color: white;
			text-align: center;
			padding: 14px;
			text-decoration: none;
		}
		.turun {
			float: left;
			overflow: hidden;
		}

		.turun .dropbtn {
			font-size: 16px;  
			border: none;
			outline: none;
			color: #2F5670;
			padding: 14px 16px;
			background-color: #FFFFFF;
			font-family: inherit;
			margin: 0;
		}

		.navbar a:hover, .turun:hover .dropbtn {
			color: #2F5670;
			background-color: white;
		}

		.turun-konten {
			display: none;
			position: absolute;
			background-color: #f9f9f9;
			min-width: 160px;
			box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
			z-index: 1;
		}

		.turun-konten a {
			float: none;
			color: #000000;
			padding: 12px 16px;
			text-decoration: none;
			display: block;
			text-align: left;
		}

		.turun-konten a:hover {
			background-color: white;
		}

		.turun:hover .turun-konten {
			display: block;
		}
		.judul {
			display: block;
			font-family: Billion Dreams;
			font-size: 20px;
			color: white;
			text-align: center;
			padding: 8px 35px;
			text-decoration: none;
		}

		.darkMode {
			background: #4C4C4C;
			color: white;
		}
		.komen{
			border: 1;
			border-color: #4C4C4C;

		}
		.pjg{
			width: 100%;
			padding: 5px;
			background-color: white;
		}
		.p3{
			padding-top: 5px;
			padding-right: 5px;
			padding-bottom: 5px;
		}
	</style>

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
</head>
<body>
	<ul>
		@foreach($logo as $lo)
		<li class="judul">{{$lo->nama_web}}</li>
		@endforeach
		@auth
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
      
      <li style="float: right;" class="login">
        <form action="/logout" method="post">
          {{ csrf_field() }}
          <button style="background-color: #2874A6; color: white; width: 100%; height: 100%;">Log Out</button>
        </form>
	  </li>
	  <li style="float: right; margin-right: 50px;">
        <!-- sun atau matahari -->
        <a onclick="setDarkMode()" id="darkBtn"><i class="bi bi-brightness-high-fill text-warning"></i></a>
      </li>
    @endauth
    @guest
      <li><a href="/dassboard">Dashboard</a></li>
  	  <li><a href="/kontak">Kontak</a></li>
	  <li style="float: right;" class="login"><a href="/login">Log In</a></li>
	  <li style="float: right; margin-right: 50px;">
        <!-- sun atau matahari -->
        <a onclick="setDarkMode()" id="darkBtn"><i class="bi bi-brightness-high-fill text-warning"></i></a>
      </li>
	@endguest
	</ul>
	
	<br/><br/>
	<div class="container">
		@foreach($detail as $det)
		<table border="1" style="float: left; margin-right: 30px;" rules="all" >
			<tr>
				<td>
					<a href="">
						<img src="{{ url('images/'.$det->image) }}" alt="image" width="170" height="190">
					</a>
				</td>
			</tr>
			<tr align="center" bgcolor="#2874A6" style="color:white; padding:30px">
				<td>
					<div style="padding:15px">{{$det->nama_produk}}</div>
				</td>
			</tr>
		</table>
			@foreach($wil as $w)
			<a href="https://www.google.com/maps/search/?api=1&query={{$w->wilayah}}" style="display: inline; color: #2F5670; font-size: 22px"><li>{{$w->wilayah}}</li></a><br/><br/>
			@endforeach
		<br><br>
		<div style="margin: 50px; font-size: 20px">{{$det->deskripsi}}</div>
		@endforeach
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

	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
  	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

  	<div class="container">
		<form action="/distribusi/komentarStore" method="post">
			{{ csrf_field() }}
			<table class="wrapper" bgcolor="#F2F3F4" border="1" rules="rows" style="margin-bottom: 50px">
				<tr bgcolor="#78B7F6">
					<td class="p3" colspan="2"><label for="komentar" style="color: white; font-size: 20px; color: #0E355B">Semua Komentar</label></td>
				</tr>
				@foreach($komen as $komen)
				<tr bgcolor="white">
					<td style="padding-right: 18px"><p>{{$komen->nama}}</p></td>
					<td style="padding-right: 18px"><p>{{$komen->komentar}}</p></td>
				</tr>
				@endforeach
			</table>
			<table class="wrapper" bgcolor="#F2F3F4" border="2" style="margin-bottom: 15px">
				@foreach($detail as $det)
				<input class="pjg" type="text" name="kode_produk" id="" placeholder="" hidden value="
				{{$det->kode_produk}}">
				<input class="pjg" type="text" name="nama_produk" id="" placeholder="" hidden value="
				{{$det->nama_produk}}">

				@endforeach
				<tr bgcolor="#FCF27D">
					<td class="p3" colspan="2"><label for="komentar" style="color: white; font-size: 20px; color: #0E355B">Isikan Komentarmu</label></td>
				</tr>
				<tr>
					<td style="width: 15%"><label for="email">E-Mail</label></td>
					<td><input class="pjg" type="text" name="email" id="" placeholder="" required="required"></td>
				</tr>
				<tr>
					<td><label for="nama">Nama Anda</label></td>
					<td><input class="pjg" type="text" name="nama" placeholder="" required="required"></input></td>
				</tr>
				<tr>
					<td><label for="komenta">Komentar Anda</label></td>
					<td><textarea class="pjg" name="komentar" placeholder="" rows="5" cols="10" required="required"></textarea></td>
				</tr>
				<tr>
					<td></td>
					<td><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" style="background-color: #2874A6; color: white; width: 20%; height: 100%; margin-bottom: 15px">Kirim</button></td>

					<!-- Modal -->
					<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content border border-3 border-primary">
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLabel">Apakah Anda Yakin Ingin Mengirimkan Pesan Ini?</h5>
								<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
							</div>
							
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
								<button class="btn btn-primary">Iya</button>
							</div>
							</div>
						</div>
					</div>
				</tr>
			</table>
		</form>
	</div>
</body>
</html>