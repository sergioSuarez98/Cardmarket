<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cardmarket</title>
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

  <h2>Crear carta</h2>

  <form>
    <div class="mb-3">
      <label for="exampleFormControlInput1" class="form-label">Nueva Carta</label>
      <input id="name" type="text" name="name" class="form-control-sm" id="exampleFormControlInput1" placeholder="Niebla">
    </div>
    <div class="mb-3">
      <label for="exampleFormControlInput1" class="form-label">Descripcion</label>
      <input id="description" type="text" name="description" class="form-control-sm" id="exampleFormControlInput1" placeholder="Maravilloso">
    </div>
  <div class="mb-3">
      <label for="exampleFormControlInput1" class="form-label">Coleccion</label>
      <input id="collection" type="text" name="collection" class="form-control-sm" id="exampleFormControlInput1" placeholder="New magic 2021">
    </div>
    <div class="mb-3">
     
     <input type="button" name="enviar" value="Buscar" id="createCard">
    </div>

  </form>
  <script>
  /*function getToken(){
    var api_token = localStorage.getItem('api_token');
    console.log(api_token);
    document.body.innerHTML += "<h2>"+api_token+"</h2>";

  }*/
  $("#createCard").click(function (e) {
        e.preventDefault();
        
        $name = $('#name').val();
        $description = $('#description').val();
        $collection = $('#collection').val();
        $url = "http://localhost:8888/cardmarket/public/api/cards/create"
        var card = {name: $name, description: $description, collection: $collection}
        $.ajax({
        url: $url,
        type: 'POST',
        headers: {"api_token": localStorage.getItem('api_token')},
        data: JSON.stringify(card),
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