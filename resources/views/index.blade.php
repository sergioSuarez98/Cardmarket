<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cardmarket</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
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
</style>
</head>
<body>
<div class="header">
    <h1>Cardmarket</h1>
<div class="topnav">
  <a class="active" href="#home">Home</a>
  <a href="#news">Buscar carta</a>
  <a href="registro">Registrarse</a>
  <a href="login">Logear</a>
</div>
   </div>

    <button onclick="getToken()">Mostrar token</button>

  <script>
  function getToken(){
    var api_token = localStorage.getItem('api_token');
    console.log(api_token);
    document.body.innerHTML += "<h2>"+api_token+"</h2>";

  }
  </script> 
    
</body>
</html>