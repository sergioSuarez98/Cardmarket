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
  <h1 class="display-2">Search card</h1>
  <form method="post">

    <div class="mb-3">
      <label for="exampleFormControlInput1" class="form-label">Name</label>
      <input id="name" type="text" name="name" class="form-control-sm" id="exampleFormControlInput1" placeholder="Niebla">
    </div>




    <div>
      <input type="submit" id="enviar" value="Enviar">
    </div>

  </form>

  <script>
  $("#enviar").click(function (e) {
        e.preventDefault();

        $name = $('#name').val();

        $url = "http://localhost:8888/Cardmarket/public/api/sales/find/"+$name
        console.log("boton pulsado");
        $.ajax({
        url: $url,
        type: 'GET',
        headers: {"api_token": localStorage.getItem('api_token')},


        success: function(data, status){
          console.log(data);
          if (data == "OK") {
              alert("Carta creada correctamente" + "\nStatus: " + status);
            }else{
            alert("Data: " + data + "\nStatus: " + status);

            }
          }
        })
    });

 </script>

</body>
</html>
