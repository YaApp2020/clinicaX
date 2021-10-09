
<?php include '../layout/header.php';

//$branch_id = $_GET['id'];
?>

    <!-- Font Awesome -->

    <link rel="stylesheet" href="../layout/plugins/datatables/dataTables.bootstrap.css">
    <link rel="stylesheet" href="../layout/dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="../layout/plugins/select2/select2.min.css">
    <link rel="stylesheet" href="css/medico.css" type="text/css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
    folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="../layout/dist/css/skins/_all-skins.min.css">
  <body class="nav-md"><?php 
//    if ($usuario=="si") {
      # code...
    
?>
    <div class="container body">
      <div class="main_container">
        <?php include '../layout/main_sidebar.php';?>

        <!-- top navigation -->
       <?php include '../layout/top_nav.php';?>      <!-- /top navigation -->
       <style>
label{

color: black;
}
li {
  color: white;
}
ul {
  color: white;
}
#buscar{
  text-align: right;
}
       </style>

        <!-- page content -->
        <div class="right_col" role="main">

  <?php
     if(isset($_REQUEST['cid']))
            {
              $cid=$_REQUEST['cid'];
            }
            else
            {
            $cid=$_POST['cid'];
          }


?>

            <?php
             //         if ($guardar=="si") {
                    
                      ?>

                  <?php
               //       }
                      ?>

                  <!-- Date range -->
 <!--end of modal-->
                  <div class="box-header">
                    <h3 class="htitle" >Historial Cita</h3>
                </div><!-- /.box-header -->
              
              <a class="btn-regresar" href="medico_historial.php" role="button"><i class="glyphicon glyphicon-arrow-left"></i> Regresar</a>
                <div class="box-body">
                

                  <table id="example2" class="table table-bordered table-striped">
                    <thead>
                        <tr class="encabezado">
                          <th>Paciente</th>
                          <th>Fecha</th>
                          <th>Observaciones</th>
                          <th>Estado</th>
                          <th>Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
<?php

$auto="";

   // $branch=$_SESSION['branch'];
    $query=mysqli_query($con,"
     select 
                 m.nombre as  medico,
                 p.primernombre as  paciente,
                 c.fecha,
                 c.observaciones,
                 c.estado_cita,
               c.id_cita from cita c 
               inner join usuario m on c.id_medico = m.id 
               inner join u_pacientes p on p.numerodedocumento = c.id_paciente where m.id='$cid'")or die(mysqli_error());
    $i=0;
    
    while($row=mysqli_fetch_array($query)){

$id_cita=$row['id_cita'];


    $i++;
?>
                      <tr style="background: white;" >
                  <td><?php echo $row['paciente'];?></td>     
                  <td><?php echo $row['fecha'];?></td>    
                  <td><?php echo $row['observaciones'];?></td>  
                  <td><?php echo $row['estado_cita'];?></td> 
                  <td style="text-align: center;" >
                                <?php
                      ?>
                  <a class="btn btn-danger" href="<?php  echo "../medico/eliminar_historial_cita.php?id_cita=$id_cita&cid=$cid";?>"  onClick="return confirm('¿Está seguro de que quieres eliminar??');"  role="button"><i class="glyphicon glyphicon-trash" ></i></a>
                <?php
                                ?>  
                  </td>  
          </tr>

 <!--end of modal-->

<?php }?>
                    </tbody>

                  </table>
                </div><!-- /.box-body -->

            </div><!-- /.col -->

          </div><!-- /.row -->
                </div><!-- /.box-body -->

            </div>
        </div>
      </div>
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right">
                    <a href="https://beatifullshop.co/app/clinica/">DOCTORPRJ IPS</a>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

  <?php include '../layout/datatable_script.php';?>



        <script>
        $(document).ready( function() {
                $('#example2').dataTable( {
                  "language": {
                    "paginate": {
                      "previous": "anterior",
                      "next": "posterior"
                    },
                    "search": "Buscar:",


                  },

                  "info": false,
                  "lengthChange": false,
                  "searching": false,


  "searching": true,
                }

              );
              } );
    </script>
                                         <?php 
 // }    
?>



    <!-- /gauge.js -->
  </body>
</html>
