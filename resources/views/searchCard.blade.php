<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Register</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <link rel="stylesheet" href="http://localhost:8888/Cardmarket/resources/css/app.css">


</head>
<body>
<div class="header">
    <h1>Cardmarket</h1>
    <div class="topnav">
      <a  href="inicio">Home</a>
      <a class="active">Buscar carta</a>
      <a href="registro">Registrarse</a>
      <a href="login">Logear</a>
      <a href="restore">Recuperar Contraseña</a>
    </div>
  </div>
  <h1 class="display-2">Buscar Carta</h1>
  <form >

    <div class="mb-3">
      <label for="exampleFormControlInput1" class="form-label">Nombre carta</label>
      <input id="name" type="text" name="name" class="form-control-sm" id="exampleFormControlInput1" placeholder="Niebla">
    </div>



    <div>
    <input type="button" name="enviar" value="Buscar" id="v">
    </div>

  </form>


  <script>
         $("#search").click(function (e) {
		    e.preventDefault();


		    $nombre = $('#name').val();
            //$card = {"name":"cerdo"}
		    var url = "http://localhost:8888/Cardmarket/public/api/sales/find/"+$nombre
            //$json = JSON.stringify($card)
            console.log("BOTON PULSADO");
		     $.ajax({

				url: url,
				type: 'GET',
				headers: {"api_token": localStorage.getItem('api_token')},
                //  data: $json,

				success: function(data, status){
					console.log(data);
                    alert("Data: " + data + "\nStatus: " + status);

    				var table = '<table><tr><th>id</th><th>Card Name</th><th>Description</th><th>Collection</th><th>nombre admin</th></tr>';
    				for (var i in data) {
					    table += '<tr>';
					    for (var j in data[i]) {
      						table += '<td>' + data[i][j] + '</td>';
     					}
     					table += '</tr>';
					}
					table += '</table>';
					document.body.innerHTML += table;
    			}
  			})

		});

  </script>

</body>
</html>
