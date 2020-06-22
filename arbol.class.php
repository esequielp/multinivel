<?php

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
                   <td>'.$this->checkPosition($first).'<p></p> izquierdo</td>
                   <td>'.$this->checkPosition($second).'<p></p> derecho</td>
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
                   <td>'.$this->checkPosition($ffirst).'<p></p> izquierdo</td>
                   <td>'.$this->checkPosition($ssecond).'<p></p> derecho</td>
                   <td>'.$this->checkPosition($tthird).'<p></p> izquierdo</td>
                   <td>'.$this->checkPosition($ffourth).'<p></p> derecho</td>
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
                   <td>'.$this->checkPosition($fffirst).'<p></p> izquierdo</td>
                   <td>'.$this->checkPosition($sssecond).'<p></p> derecho</td>
                   <td>'.$this->checkPosition($ttthird).'<p></p> izquierdo</td>
                   <td>'.$this->checkPosition($fffourth).'<p></p> derecho</td>
                   <td>'.$this->checkPosition($fifth).'<p></p> izquierdo</td>
                   <td>'.$this->checkPosition($sixth).'<p></p> derecho</td>
                   <td>'.$this->checkPosition($seventh).'<p></p> izquierdo</td>
                   <td>'.$this->checkPosition($eighth).'<p></p> derecho</td>
                 </tr>
              </table>

            </div>
         ';








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
        		  return '<a href="index.php?padre='.$position.'" style="color: #FFF;background: #63bb13;">'.$key['username'].'</a>';
        	}
        }

    }






















































}