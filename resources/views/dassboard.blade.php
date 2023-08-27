<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Dassboard</title>
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
		
	</style>

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
</head>
<!-- style="background-color: #474747" -->
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

	<div class="container">
		<br/><br/>
		@foreach($dassboard as $das)
		<table border="1" style="float: left; margin-right: 30px; margin-bottom: 50px;" rules="all" >
			<tr>
				<td>
					<a href="">
						<img src="{{ url('images/'.$das->image) }}" alt="image" width="170" height="190">
					</a>
				</td>
			</tr>
			<tr align="center" bgcolor="#2874A6">
				<td >
					<a href="/detail/{{$das->kode_produk}}">{{$das->nama_produk}}</a>
				</td>
			</tr>
		</table>
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
	<!-- <script src="{{ mix('js/dark.js') }}"></script> -->

	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
  	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
	
</body>
</html>