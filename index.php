<?php
   // Include Class Arbol
   require_once 'arbol.class.php';
   // Asignar variable a la clase
   $arbol = new Arbol();

if ( isset($_GET['posicion']) ) {

  $posicion=$_GET['posicion'];

}else{

  $posicion=1;
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Arbol Para Multinivel en PHP</title>

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


    <div class="container" style="margin-top: 50px;">
      <?php
          
            //$arbol->createDesktop($posicion);
            $arbol->createMatrix(1);

      ?>
    </div>


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <!-- FunctionsAnimate.JS -->
    <script src="js/functions-animate.js"></script>
  </body>
</html>