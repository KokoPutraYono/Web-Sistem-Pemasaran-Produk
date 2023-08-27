<!DOCTYPE html>
<html>
<head>
	<title></title>
	<meta charset="utf-8">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link rel="stylesheet" type="text/css" href="{{ asset('style.css') }}">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
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
  		<li><a href="/dassboard">Dashboard</a></li>
  		<li><a href="/kontak">Kontak</a></li>
		<li style="float: right; margin-right: 120px;">
        <!-- sun atau matahari -->
        <a onclick="setDarkMode()" id="darkBtn"><i class="bi bi-brightness-high-fill text-warning"></i></a>
      </li>
	</ul>

	<form action="/loginStore" method="post" style="padding-top: 10%">
		{{ csrf_field() }}
			<div class="wrapper">
            	@if(session()->has('success'))
            	<h4>{{ session('success')}}</h4>
				@endif
				@if(session()->has('loginError'))
            	<h4>{{ session('loginError')}}</h4>
            	@endif
			</div><br><br>
		<div class="wrapper">
			<label class="font">Email</label>
			<input type="email" name="email" style="background-color: white" id="email" value="{{old('email')}}" autofocus required>

            <label class="font">Password</label>
			<input type="password" style="background-color: white" name="password" id="password" required>

			<div class="popup" onclick="myFunction()"><button style="background-color: #2874A6; color: white; width: 140%; height: 100%;">Log in</button>
				<span class="popuptext" id="myPopup">Login</span>
			</div>
		</div>
	</form>

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
		function myFunction() {
  			var popup = document.getElementById("myPopup");
  			popup.classList.toggle("show");
		}
		</script>
	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

</body>
</html>