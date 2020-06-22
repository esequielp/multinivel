<?php

require_once 'config.class.php';

// conexion de base de datos
$conexion = Conexion::singleton_conexion();

if (isset($_POST['nickname'])){
  
   
   $SQL = 'INSERT INTO usuarios(username,password) VALUES (:usernme,:password)';
   $sentence = $conexion -> prepare($SQL);
   $sentence -> bindParam(':usernme',$_POST['nickname'],PDO::PARAM_STR);
   $sentence -> bindParam(':password',$_POST['contrasena'],PDO::PARAM_STR);
   $sentence -> execute();
   $lastiduser = $conexion -> lastInsertId();

   $SQLT = 'INSERT INTO arbol(lugar,lado,iduser) VALUES (:lugar,:lado,:iduser)';
   $stn = $conexion -> prepare($SQLT);
   $stn -> bindParam(':lugar',$_POST['lugar'],PDO::PARAM_INT);
   $stn -> bindParam(':lado',$_POST['lado'],PDO::PARAM_INT);
   $stn -> bindParam(':iduser',$lastiduser,PDO::PARAM_INT);
   $stn -> execute();

   header('Location: index.php');



}



?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Arbol Binario</title>

    <!-- Bootstrap -->
    <link href="style.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>


    <div class="container" style="margin-top: 100px;">
      <div class="well text-center">
         <form method="POST" action="">
           
               <label>Usuario:</label>
               <input type="text" name="nickname" class="form-control">
               <p></p>
               <label>Contraseña:</label>
               <input type="text" name="contrasena" class="form-control">
               <input type="hidden" name="lugar" value="<?php echo $_GET['p']; ?>">
               <input type="hidden" name="lado" value="<?php echo $_GET['lado']; ?>">
               <p></p>
               <button class="btn btn-success btn-lg">Agregar</button>


         </form>
      </div>
    </div>


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <!-- FunctionsAnimate.JS -->
    <script src="js/functions-animate.js"></script>
  </body>
</html>