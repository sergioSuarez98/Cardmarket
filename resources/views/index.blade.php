<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cardmarket</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="http://localhost:8888/Cardmarket/resources/css/app.css">

</head>
<body>
<div class="header">
    <h1>Cardmarket</h1>
<div class="topnav">
  <a class="active" href="#home">Home</a>
  <a href="hola">Buscar carta</a>
  <a href="registro">Registrarse</a>
  <a href="login">Logear</a>
  <a href="restore">Recuperar Contraseña</a>
</div>
</div>

<h1 class="display-2">Crear carta</h1>

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
        $url = "http://localhost:8888/Cardmarket/public/api/cards/create"
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
