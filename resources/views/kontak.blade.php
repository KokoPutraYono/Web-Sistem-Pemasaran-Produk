<!DOCTYPE html>
<html>
<head>
	<title>Menu Kontak</title>
	<meta charset="utf-8">
	<style type="text/css">

		ul {
			list-style-type: none;
			margin: 0;
			padding: 0;
			overflow: hidden;
			background-color: #2874A6;
		}

		li{
			float: left;
		}
		li a {
			display: block;
			color: white;
			text-align: center;
			padding: 15px;
			text-decoration: none;

		}
		.wrapper{
			width: 500px;
			margin: auto;
		}
		.wrapper input[type=text],.wrapper input[type=email],
		textarea{
			width: 100%;
			margin-bottom: 15px;
			padding: 8px;
			background: transparent;
			border-color: #2874A6;
			color: black;
			font-size: 15px;
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

		.dropdown1 {
			float: left;
			overflow: hidden;
		}

		.dropdown1 .dropbtn1 {
			font-size: 16px;  
			border: none;
			outline: none;
			color: #FFFFFF;
			padding: 14px 16px;
			background-color: #2874A6;
			font-family: inherit;
			margin: 0;
		}

		.navbar1 a:hover, .dropdown1:hover .dropbtn1 {
			color: #2F5670;
			background-color: white;
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

		.gambar{
			border-style: solid;
  			border-color: #2F5670;
			border-radius: 100%;
			width: 10%;
			height: 10%;
			display: block;
			margin-left: auto;
			margin-right: auto;
		}

		.darkMode {
			background: #4C4C4C;
			color: white;
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

      <li>
        <a href="#" class="bi bi-bell-fill text-warning" ></a>
      </li>
      
      <li style="float: right;" class="login">
        <form action="/logout" method="post">
          {{ csrf_field() }}
          <button style="background-color: #2874A6; color: white; width: 100%; height: 100%;">Log Out</button>
        </form>
	  </li>
	  <!-- <li style="float: right; margin-right: 50px;">
        <a href="#" class="bi bi-brightness-high-fill text-warning" ></a>
      </li> -->
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
	<br>
	<div class="container">

		<img class="gambar" src="{{asset('logo5.png')}}" >
		<br><br>

		<form action="/admin/kontakStore" method="post">
			{{ csrf_field() }}
			<table class="wrapper" >
				<tr>
					<td style="width: 15%"><label for="email">E-Mail</label></td>
					<td><input type="text" name="email" id="" placeholder="" required="required" style="background-color: white"></td>
				</tr>
				<tr>
					<td><label for="deskripsi">Deskripsi</label></td>
					<td><input type="text" name="deskripsi" placeholder="" required="required" style="background-color: white"></input></td>
				</tr>
				<tr>
					<td><label for="pesan">Pesan</label></td>
					<td><textarea name="pesan" placeholder="" rows="5" cols="10" required="required" style="background-color: white"></textarea></td>
				</tr>
				<tr>
					<td></td>
					<td><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" style="background-color: #2874A6; color: white; width: 20%; height: 100%;">Kirim</button></td>

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

</body>
</html>