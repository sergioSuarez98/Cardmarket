<!DOCTYPE html>
<html lang="en">
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="http://localhost:8888/cardmarket/resources/css/app.css">
</head>
<body>
<div class="header">
    <h1>Cardmarket</h1>
    <div class="topnav">
      <a  href="inicio">Home</a>
      <a href="search">Buscar carta</a>
      <a href="registro">Registrarse</a>
      <a href="login">Logear</a>
      <a class="active">Recuperar Contraseña</a>
    </div>
  </div>
  <h1 class="display-2">Recuperar contraseña</h1>

  <form action>

  <div class="mb-3">
      <label for="exampleFormControlInput1" class="form-label">Email</label>
      <input id="email" type="text" name="email" class="form-control-sm" id="exampleFormControlInput1" placeholder="example@gmail.com">
    </div>
    <div class="mb-3">

     <input type="button" name="enviar" value="Buscar" id="restore">
    </div>

  </form>

  <script>
    $("#restore").click(function(e){
      e.preventDefault();


      $email = $('#email').val();



      var user = {

        email: $email

      }

      $.post("http://localhost/Cardmarket/public/api/users/forgotPassword",
        JSON.stringify(user)
        ,

        function(data, status){

          var splitted = data.split(":");


          if (splitted[0] == "Ok") {
                    window.location.href = "http://localhost:8888/Cardmarket/public/login"
                }else{
                    alert("Data: " + data + "\nStatus: " + status);
                }

      });
    });
  </script>




</body>
</html>
