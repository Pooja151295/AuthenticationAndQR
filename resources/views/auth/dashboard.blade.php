<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>How to Generate QR Code in Laravel 8</title>
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"/>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
</head>
<body>
	<nav class="navbar navbar-light navbar-expand-lg mb-5" style="background-color: #e3f2fd;">
		<a class="nav-link" href="{{ route('signout') }}">Logout</a>
	</nav>
	<div class="container mt-4">

		<div class="card">
			<div class="card-header">
				<h2>Scan For Your Information</h2>
			</div>
			<div class="card-body">
			<img height="115" width="115" src="data:image/png;base64,{{ DNS2D::getBarcodePNG(' Your Name is '.$user->firstname.' '.$user->lastname.' And Email Id is '.$user->email,'QRCODE') }}" alt="barcode" />
				<!-- {!! QrCode::size(250)->generate($user->firstname) !!} -->
			</div>
			<div class="card-header">
				<h2>Edit Data</h2>
			</div>
			<div class="card-header">
				<form name="editForm" id="editForm" method="POST" action="update">
					@csrf
					<input value=<?php echo $user->id; ?> id="id" class="form-control" name="id" hidden>
					<label>First Name: </label><input type="text" value= <?php echo $user->firstname; ?> id="firstname" class="form-control" name="firstname">
					<label>Last Name: </label><input type="text" value= <?php echo $user->lastname; ?> id="lastname" class="form-control" name="lastname">
					<label>Email: </label><input type="text" value= <?php echo $user->email; ?> id="email" class="form-control" name="email" readonly="readonly">
					<label>Profile Picture: </label><input type="file" name="image" class="form-control"><br>
					<button class="btn btn-success btn-submit">Update</button>
				</form>
			</div>
		</div>

	</div>
</body>
<script type="text/javascript">
		// $(document).ready(function () {
		// $("editForm").on("submit",function (event) {
		// var formData = {
		// firstname: $("#firstname").val(),
		// lastname: $("#lastname").val(),
		// email: $("#email").val(),
		// };
		// var	firstname =  $("#firstname").val();
		// var lastname =  $("#lastname").val();
		// var form = new FormData(document.getElementById('editForm'));
		// var image = document.getElementById('image').files[0];
		// $.ajaxSetup({
		// 	headers: {
		// 	'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		// 	}
		// });
// 		var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
// 		$.ajax({
// 		type: "POST",
// 		url: action,
// 		data: {formData:formData,_token: CSRF_TOKEN} ,
// 		// data: {_token: CSRF_TOKEN,firstname:firstname,lastname:lastname,form:form} ,
		
// 		dataType: "json",
// 		encode: true,
// 		}).done(function (data) {
// 		console.log(data);
// 		});

// 		event.preventDefault();
// 	});
// });
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	}
	});
	$(".btn-submit").click(function(e){

  

e.preventDefault();



var firstname = $("input[name=firstname]").val();
var lastname = $("input[name=lastname]").val();
var id = $("input[name=id]").val();
var email = $("input[name=email]").val();
console.log(id)


$.ajax({

   type:'POST',

   url:"{{ route('update.post') }}",

   data:{firstname:firstname, lastname:lastname, email:email, id:id},

   success:function(data){

	  alert(data.success);

   }

});



});
</script>
</html>