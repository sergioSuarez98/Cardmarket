<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Register</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <style>
    @import url('https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;1,700&display=swap');

    *{
      box-sizing: border-box;
    }
    body{
      margin: auto;
      background-color: #4CAF50;
    }
    h1{
      font-family: 'Roboto'
    }
    .header {
      padding: 60px;
      text-align: center;
      background: #1abc9c;
      color: white;
      font-size: 30px;
    }

    /* Add a black background color to the top navigation */
    .topnav {
      background-color: #333;
      overflow: hidden;

    }

    /* Style the links inside the navigation bar */
    .topnav a {
      float: left;
      color: #f2f2f2;
      text-align: center;
      padding: 14px 16px;
      text-decoration: none;
      font-size: 17px;
    }

    /* Change the color of links on hover */
    .topnav a:hover {
      background-color: #ddd;
      color: black;
    }

    /* Add a color to the active/current link */
    .topnav a.active {
      background-color: #4CAF50;
      color: white;
    }
    form {
      /* Center the form on the page */
      margin: 0 auto;
      width: 400px;
      /* Form outline */
      padding: 1em;
      border: 1px solid #CCC;
      border-radius: 1em;
    }

    
    label {
      /* Uniform size & alignment */
      display: inline-block;
      width: 90px;
      text-align: right;
    }




    input:focus,
    textarea:focus {
      /* Additional highlight for focused elements */
      border-color: #000;
    }

    textarea {
      /* Align multiline text fields with their labels */
      vertical-align: top;

      /* Provide space to type some text */
      height: 5em;
    }

    .button {
      /* Align buttons with the text fields */
      padding-left: 90px; /* same size as the label elements */
    }

    button {
  /* This extra margin represent roughly the same space as the space
  between the labels and their text fields */
  margin-left: .5em;
}
#button{
  width: 70px;
  margin-left: 10vh;
}
</style>
<script>
 function getMessage() {
  $.ajax({
   type:'POST',
   url:'/getmsg',
   data:'_token = <?php echo csrf_token() ?>',
   success:function(data) {
    $("#msg").html(data.msg);
  }
});
}
</script>
</head>
<body>
  <div class="header">
    <h1>Cardmarket</h1>
    <div class="topnav">
      <a  href="inicio">Home</a>
      <a href="#news">Buscar carta</a>
      <a href="registro">Registrarse</a>
      <a href="active">Logear</a>
    </div>
  </div>
  <h1 class="display-2">Log In</h1>
  <form method="post">        

    <div class="mb-3">
      <label for="exampleFormControlInput1" class="form-label">Username</label>
      <input id="username" type="text" name="username" class="form-control-sm" id="exampleFormControlInput1" placeholder="name@example.com">
    </div>

  
    <div class="mb-3">
      <label for="exampleFormControlInput1" class="form-label">Password</label>
      <input id="password" type="password" name="password" class="form-control-sm" id="exampleFormControlInput1" >
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
   
      $password = $('#password').val();
     
      var user = {   

        username: $username,
      
        password: $password,
        
      }

      $.post("http://localhost/Cardmarket/public/api/users/login",
        JSON.stringify(user)
        ,

        function(data, status){
          
          var splitted = data.split(":");
          var api_token = splitted[1];
          localStorage.setItem("api_token",api_token);
          console.log(api_token);
          if (splitted[0] == "Ok.Token") {
                    //window.location.href = "http://localhost/Cardmarket/public/inicio"
                }else{
                    alert("Data: " + data + "\nStatus: " + status);
                }
          
      });
    });
  </script>


</body>
</html>