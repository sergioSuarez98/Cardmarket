<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Register</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <link rel="stylesheet" href="http://localhost/cardmarket/resources/css/app.css">

</script>
</head>
<body>
<div class="header">
    <h1>Cardmarket</h1>
    <div class="topnav">
      <a  href="inicio">Home</a>
      <a href="search">Buscar carta</a>
      <a class="active">Registrarse</a>
      <a href="login">Logear</a>
      <a href="restore">Recuperar Contraseña</a>
    </div>
  </div>
  <h1 class="display-2">Sign Up</h1>
  <form method="POST">        

    <div class="mb-3">
      <label for="exampleFormControlInput1" class="form-label">Username</label>
      <input id="username" type="text" name="username" class="form-control-sm" id="exampleFormControlInput1" placeholder="name@example.com">
    </div>

    <div class="mb-3">
      <label for="exampleFormControlInput1" class="form-label">Email </label>
      <input id="email" type="email" name="email" class="form-control-sm" id="exampleFormControlInput1" placeholder="name@example.com">
    </div>
    <div class="mb-3">
      <label for="exampleFormControlInput1" class="form-label">Password</label>
      <input id="password" type="password" name="password" class="form-control-sm" id="exampleFormControlInput1" >
    </div>


    <div>
      <label for="exampleFormControlInput1" class="form-label">Role</label>
      <select id="role" name="role" class="form-select-sm " aria-label=".form-select-lg example">
        <option selected>Open this select menu</option>
        <option value="Individual">Individual</option>
        <option value="Admin">Admin</option>
        <option value="Profesional">Profesional</option>
      </select>
    </div>

    <div>
      <input type="submit" id="enviar" value="Enviar">
    </div>

  </form>


  <script>
    $("#enviar").click(function(e){
      e.preventDefault(); 
      console.log("Boton pulsado")

      $username = $('#username').val();
      $email = $('#email').val();
      $password = $('#password').val();
      $role = $('#role').val();
      var user = {   

        username: $username,
        email: $email,
        password: $password,
        role: $role
      }

      $.post("http://localhost/Cardmarket/public/api/users/create",
        JSON.stringify(user)
        ,

        function(data, status){
          
          var splitted = data.split(" ");

          if (splitted[0] == "OK") {
                    window.location.href = "http://localhost/Cardmarket/public/login"
                }else{
                    alert("Data: " + data + "\nStatus: " + status);
                }
          
      });
    });
  </script>


</body>
</html>