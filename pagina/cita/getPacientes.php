<?php
session_start();
include('../../dist/includes/dbcon.php');


if(isset($_POST['datopaciente'])){
$datopaciente=$_POST['datopaciente'];
}
$length = strlen(utf8_decode($datopaciente));

     
      $x = 0;

   
 
       $result = mysqli_query( $con, "SELECT * FROM u_pacientes WHERE  (numerodedocumento LIKE '$datopaciente%%' OR primerapellido LIKE '$datopaciente%%' OR segundoapellido LIKE '$datopaciente%%')" )or die( mysqli_error() );
    $bufer="";

  while ($row = mysqli_fetch_assoc($result)) {
     //var_dump($row);
    
$bufer=$bufer.'<option data-value='.utf8_encode($row['numerodedocumento']).'>'.$row['numerodedocumento']." ".utf8_encode($row['primernombre']).' '.utf8_encode($row['segundonombre']).' '.utf8_encode($row['primerapellido']).' '.utf8_encode($row['segundoapellido']).'</option>'."#&$".$row['primernombre'];
if($x>26){break;}
      $x++;
   }

echo  trim($bufer);;
 

      
         

        
      
      ?>  