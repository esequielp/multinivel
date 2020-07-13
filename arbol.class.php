<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once 'config.class.php';

Class Arbol
{

    /*#######################################################################################################################

       Con esta función creo la estructura que necesito con todo y sus posiciones, la estrctura que manejo es una piramide
       simple, de 3 niveles, con sus derechos e izquierdos, entonces lo que necesito son 15 bloques, uso un FOR para crearlos
       solamente por medio de IF's especifico en que lugar van y el resultado final seria asi.

                                        /                1             \
                                     --------------------------------------
                                    /      2             |           3     \
                                 ----------------------------------------------
                                /   4      |      5      |     6     |     7   \
                              ----------------------------------------------------
                             /  8     9   |   10    11   |  12    13  |  14    15 \
                            ---------------------------------------------------------

        No es un arbol binario pero maneja el orden piramidal que necesito y lo hace matematicamente correcto y es muy simple
        3 niveles con sus respectivos numeros, esta función solo puede hacer la estructura de un numero de 14 digitos maximo
        estamos hablando de 99,999,999,999,999 por que el siguiente dato de este numero seria 1.0E+14, asi que en teoria podre 
        meter a mi base de datos Noventa y nueve billones, novecientos noventa y nueve mil novecientos noventa y nueve millones,
        novecientos noventa y nueve mil novecientos noventa y nueve registros, estamos hablando de 13,437,248,051.5989 veces las
        personas que viven en el planeta (segun el registro del 2016) y digo que es posible por que el valor maximo de BIGINT
        en la base de datos mysql es: 9,223,372,036,854,775,807 ( ͡° ͜ʖ ͡°).

    #######################################################################################################################*/

    public function createDesktop($number){

         $izquierdo = 1;
         $derecho = 2;

          
         // Primer bloque
         echo '
         <div id="firstblock" class="col-md-12 text-center">
               '.$this->checkPosition($number).'
         </div>
         ';

         // Segundo Bloque

          /* Lugares */
          $first = $number * 2;
          $second = $first + 1;

          echo '
            <div id="secondblock" class="col-md-12">
              <table class="table">
                 <tr>
                   <td>'.$this->checkPosition($first).'<p></p>'. $first .' izquierdo</td>
                   <td>'.$this->checkPosition($second).'<p></p>'. $second .' derecho</td>
                 </tr>
              </table>
            </div>
          ';

         // Tercer Bloque
         $ffirst = $first * 2;
         $ssecond = $ffirst + 1;
         $tthird = $ssecond + 1;
         $ffourth = $tthird + 1;


         echo'
            <div id="thirdblock" class="col-md-12">
              <table class="table">
                 <tr>
                   <td>'.$this->checkPosition($ffirst).'<p></p> '. $ffirst .' izquierdo</td>
                   <td>'.$this->checkPosition($ssecond).'<p></p> '. $ssecond .' derecho</td>
                   <td>'.$this->checkPosition($tthird).'<p></p> '. $tthird .' izquierdo</td>
                   <td>'.$this->checkPosition($ffourth).'<p></p> '. $ffourth .' derecho</td>
                 </tr>
              </table>
            </div>
         ';

         // Cuarto Bloque
         $fffirst = $ffirst * 2;
         $sssecond = $fffirst + 1;
         $ttthird = $sssecond + 1;
         $fffourth = $ttthird + 1;
         $fifth = $fffourth + 1;
         $sixth = $fifth + 1;
         $seventh = $sixth + 1;
         $eighth = $seventh + 1;


         echo'
            <div id="fourthblock" class="col-md-12">

              <table class="table">
                 <tr>
                   <td>'.$this->checkPosition($fffirst).'<p></p>'. $fffirst .' izquierdo</td>
                   <td>'.$this->checkPosition($sssecond).'<p></p>'. $sssecond .'  derecho</td>
                   <td>'.$this->checkPosition($ttthird).'<p></p>'. $ttthird .'  izquierdo</td>
                   <td>'.$this->checkPosition($fffourth).'<p></p>'. $fffourth .'  derecho</td>
                   <td>'.$this->checkPosition($fifth).'<p></p> '. $fifth .' izquierdo</td>
                   <td>'.$this->checkPosition($sixth).'<p></p>'. $sixth .'  derecho</td>
                   <td>'.$this->checkPosition($seventh).'<p></p>'. $seventh .'  izquierdo</td>
                   <td>'.$this->checkPosition($eighth).'<p></p> '. $eighth .' derecho</td>
                 </tr>
              </table>

            </div>
         ';








    }


    public function createMatrix($idpadre){
         // conexion de base de datos
         $conexion = Conexion::singleton_conexion();

         $izquierdo = 1;
         $derecho = 2;

         //********* PRIMER BLOQUE *********//
         $idpadre =1;
         $nivel=1;
         $start_position="";
         $stop_position="";
         echo $this->createBlock($idpadre,$nivel,$start_position,$stop_position);

        //********* SEGUNDO BLOQUE *********//
         $idpadre =1;
         $nivel=2;
         $start_position=1;
         $stop_position=2;
         echo $this->createBlock($idpadre,$nivel,$start_position,$stop_position);

        //********* TERCER BLOQUE *********//
         $idpadre =1;
         $nivel=3;
         $start_position=3;
         $stop_position=6;
         echo $this->createBlock($idpadre,$nivel,$start_position,$stop_position);

        //********* CUARTO BLOQUE *********//
         $idpadre =1;
         $nivel=4;
         $start_position=7;
         $stop_position=14;
         echo $this->createBlock($idpadre,$nivel,$start_position,$stop_position);

    }

    public function createBlock($idpadre,$nivel,$start_position,$stop_position){
    
    $conexion = Conexion::singleton_conexion();
     //////*********  Primer Bloque    ***************** ////////////// 
        $block ="";
        $body_block ="";

        $SQL = "SELECT usuarios.id,usuarios.username, arbol.position, arbol.iduser FROM arbol 
                INNER JOIN usuarios ON arbol.iduser = usuarios.id 
                WHERE arbol.idpadre = ? AND arbol.position BETWEEN ? AND ? 
                ORDER BY POSITION ";  
        $block_container="firstblock";
        if($nivel ==1){
        $SQL = "SELECT usuarios.id,usuarios.username, arbol.position, arbol.iduser FROM arbol 
                INNER JOIN usuarios ON arbol.iduser = usuarios.id 
                WHERE usuarios.id = ? 
                ORDER BY POSITION ";
        }elseif($nivel ==2){
          $block_container="secondblock";
        }elseif($nivel ==3){
          $block_container="thirdblock";
        }elseif($nivel ==4){
          $block_container="fourthblock";
        }
        
       
        $sentence = $conexion -> prepare($SQL);
        
        //$sentence -> bindParam(':idpadre',$idpadre);

        $sentence->bindParam(1, $idpadre);

        if($nivel !=1){
            $sentence->bindParam(2, $start_position);
            $sentence->bindParam(3, $stop_position);
        }

        $sentence -> execute();
        

        $results = $sentence -> fetchAll();
        //
       // echo "<pre>";
      // print_r($results);
       //exit;

        if (empty($results)){
               echo "Lugar Vacio";
               //return '<a href="agregar.php?p='.$position.'&side=">Agregar</a>';
        }else{
          
         $block = '
         <div id="'.$block_container.'" class="col-md-12">
         <table class="table">
         <tr>
         ';

          foreach ($results as $key){
                 
            if ($key['iduser']==99999999) {
              $body_block .= '<td><a href="agregar.php?p='.$position.'&side=">Agregar</a></td>'; 
            } else {
               $body_block .= '<td><a href="index.php?posicion='.$key['position'].'" style="color: #FFF;background: #63bb13;">'.$key['username'].'</a></td>'; 
            }
        
         }
              $block .= $body_block . ' </tr>
              </table>
            </div>
         ';

        }

        return $block;

    }

    
    public function checkPosition($position){



    	// conexion de base de datos
    	$conexion = Conexion::singleton_conexion();

        $SQL = 'SELECT usuarios.username, arbol.lugar FROM arbol INNER JOIN usuarios ON arbol.iduser = usuarios.id WHERE arbol.lugar = :lugar';
        $sentence = $conexion -> prepare($SQL);
        $sentence -> bindParam(':lugar', $position, PDO::PARAM_INT);
        $sentence -> execute();
        $results = $sentence -> fetchAll();
        if (empty($results)){
        	     return '<a href="agregar.php?p='.$position.'&side=">Agregar</a>';
        }else{
        	foreach ($results as $key){
        		  return '<a href="index.php?posicion='.$position.'" style="color: #FFF;background: #63bb13;">'.$key['username'].'</a>';
        	}
        }

    }






















































}