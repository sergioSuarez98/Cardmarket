<?php 
 /*$username  = $_GET['username'];
 $email  = $_GET['email'];
 $password = $_GET['password'];
 $role = $_GET['role'];

$data = [
    "username" => $username,
    "email" => $email,
    "password" => $password,
    "role" => $role
];

$json = json_encode($data);
print_r($json);*/

?>
<html>
<head>
	<title>Ajax Example</title>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


	
</head>

<body>
	<div >This message will be replaced using Ajax. 
	Click the button to replace the message.</div>

	<form method="post">
		<input type="button" value="Enviar" id="enviar">
	</form>
	

	<script>
		$("#enviar").click(function(){
			console.log("Boton pulsado")
			var user = {   

				username: "SeroTest",
				email: "sdddasdsd",
				password: "1234",
				role: "Individual"


			}
			$.post("http://localhost:8888/cardmarket/public/api/users/create",
			JSON.stringify(user)
			,

			function(data, status){
				//alert("Data: " + data + "\nStatus: " + status);
				console.log(data);
			});
		});
	</script>

</body>

</html>