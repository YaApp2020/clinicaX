<?php include '../layout/header.php';
date_default_timezone_set('America/Lima');
?>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>DOCTORPRJ IPS</title>

    <!-- Bootstrap -->
    <link href="../layout/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../layout/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../layout/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="../layout/vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <!-- bootstrap-progressbar -->
    <link href="../layout/vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
    <!-- JQVMap -->
    <link href="../layout/vendors/jqvmap/dist/jqvmap.min.css" rel="stylesheet"/>
    <!-- bootstrap-daterangepicker -->
    <link href="../layout/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../layout/build/css/custom.min.css" rel="stylesheet">
                <script type="text/javascript" src="../layout/js/jquery.js"></script>
        <script type="text/javascript" src="../layout/js/chartJS/Chart.min.js"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="localhost/www/clinicaX/pagina/layout/plugins/datatables/dataTables.bootstrap.css">
    <link rel="stylesheet" href="localhost/www/clinicaX/pagina/layout/dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="localhost/www/clinicaX/pagina/layout/plugins/select2/select2.min.css">
    <link rel="stylesheet" href="css/cita.css" type="text/css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
        folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="../layout/dist/css/skins/_all-skins.min.css">
  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <?php include '../layout/main_sidebar.php';?>

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

<!--start of script--> 


<!--start of modal-->
<div class="modal fade" id="modalEventos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="tituloEvento"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

<div class="modal-body">
    

      <input type="hidden" id="txtID" name="txtID"/></br>
    <input type="hidden" id="txtFecha" name="txtFecha"/></br>
    
      <div class="form-row">
          <div class="form-group col-md-8">
              <label>Titulo:</label>
                <input type="text" id="txtTitulo" class="form-control" /></br>
          </div>
          <div class="form-group col-md-4">
                <label>Hora:</label>
                <div class="input-group clockpicker" data-autoclose="trie">
                    <input type="text" id="txtHora" value="12:30" class="form-control"/></br>
                </div>
          </div>
        
        </div>
          <div class="form-group ">
                <label>Descripción:</label>  
                <textarea type="text" id="txtDescripcion" rows="3" class="form-control"></textarea>
          </div>
          <div class="form-group">
                Color: <input type="color" value="#ff0000" id="txtColor" class="form-control" style="height:35px;"/>
          </div>
      <div class="modal-footer">
        <button type="button" id="btnAgregar" class="btn btn-success">Agregar</button>
        <button type="button" id="btnEliminar" class="btn btn-danger">Eliminar</button>
        <button type="button" id="btnModificar" class="btn btn-info">Modificar</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
      </div>
    </div>
  </div>
</div>

                  <div class="box-header">
                  <h3 class="htitle">Lista de Citas</h3>

              </div><!-- /.box-header -->
              <a class = "btn btn-plantilla2 " href = "" onclick = "window.print()"><i class ="glyphicon glyphicon-print"></i> Imprimir</a>
              <a class = "btn btn-plantilla" href = "cita_agregar.php" id="myButtonx" name="myButtonx" role="button"><i class ="glyphicon glyphicon-plus"></i> Agendar</a>

                <div class="box-body">


                        <table id="id_tabla" data-click-to-select="true" class="dataTable no-footer table table-bordered table-striped">
                          <thead>
                              <tr class="encabezado">
                                  <th>Paciente</th>
                                  <th>Médico</th>
                                  <th data-sortable="true">Fecha</th>
                                  <th>Observaciones</th>
                                  <th>Estado</th>
                                  <th > Acciones </th>
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
                        inner join u_pacientes p on p.numerodedocumento = c.id_paciente ")or die(mysqli_error());
                        $i=0;
                        $alt=0;
                        while($row=mysqli_fetch_array($query)){

                    $id_cita=$row['id_cita'];

                        $i++;
                    ?>


                        
                    <?php
                    if(!strcmp($row['estado_cita'],'cancelado')){
                    echo "<tr style='background: white;' >";

                    }else{
                          if($alt==1){
                                        echo "<tr class='alt '>";
                            }else{
                                  echo "<tr>";
                            }
                    }

                    ?>
        <td><?php echo $row['medico'];?></td>              
        <td><?php echo $row['paciente'];?></td>     
        <td><?php echo $row['fecha'];?></td>    
        <td><?php echo $row['observaciones'];?></td>  
        <td><?php echo $row['estado_cita'];?></td>       
                          <td>
                                <?php
                      if(!strcmp($row['estado_cita'],'cancelado')){

                      }else{
                        echo "<a class='btn btn-danger btn-print myButton2' href='../cita/editar_cita.php?id_cita=".$id_cita." role='button'><li class='glyphicon glyphicon-edit'></li></a>
                      <a class='btn btn-primary btn-print myButton3' href='../cita/eliminar_cita.php?id_cita=".$id_cita."&observaciones=".$row['observaciones']." Cancelado por: ".$tipo.":".$session_id."'  onClick=\"return confirm('¿Está seguro de que quieres eliminar??');\"  role='button'><li class='glyphicon glyphicon-trash'></li></a>";
                        
                      }            
                          ?>

                                  </td>
                                            </tr>
                      <?php 

                      $alt++;
                                    if($alt==2){$alt=0;}
}?>
                    </tbody>

                  </table>

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
                                <a href="https://beatifullshop.co/app/clinica">DOCTORPRJ IPS
</a>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>

  <?php include '../layout/datatable_script.php';?>



        <script>
        $(document).ready( function() {
            $('id_tabla').DataTable();
            
                $('#id_tabla').dataTable( {
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




    <!-- /gauge.js -->
  </body>
</html>
<style>



.myButtonx {
	box-shadow: 0px 10px 14px -7px #276873;
	background:linear-gradient(to bottom, #b39d59 5%, #ebb11e 100%);
	background-color:#b39d59;
	border-radius:8px;
	display:inline-block;
	cursor:pointer;
	color:#ffffff;
	font-family:Arial;
	font-size:15px;
	font-weight:bold;
		padding:3px 5px;
	text-decoration:none;
	text-shadow:0px 1px 0px #3d768a;
}
.myButtonx:hover {
	background:linear-gradient(to bottom, #ebb11e 5%, #b39d59 100%);
	background-color:#ebb11e;
}
.myButtonx:active {
	position:relative;
	top:1px;
}




 .datagridx {
        font: normal 12px/150% Arial,
        Helvetica,
        sans-serif; 
        background: #fff; 
        overflow: hidden; 
        border: 1px solid #006699;
        -webkit-border-radius: 3px;
        -moz-border-radius: 3px; 
        border-radius: 3px; 
        }
        .datagrid table td,
        .datagrid table th {
        padding: 3px 10px; 
        }
        .datagrid table thead th {background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #006699), color-stop(1, #00557F) );background:-moz-linear-gradient( center top, #006699 5%, #00557F 100% );filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#006699', endColorstr='#00557F');background-color:#006699; color:#FFFFFF; font-size: 15px; font-weight: bold; border-left: 1px solid #0070A8; } .datagrid table thead th:first-child { border: none; }.datagrid table tbody td { color: #00496B; border-left: 1px solid #E1EEF4;font-size: 12px;font-weight: normal; }.datagrid table tbody .alt td { background: #E1EEF4; color: #00496B; }.datagrid table tbody td:first-child { border-left: none; }.datagrid table tbody tr:last-child td { border-bottom: none; }.datagrid table tfoot td div { border-top: 1px solid #006699;background: #E1EEF4;} .datagrid table tfoot td { padding: 0; font-size: 12px } .datagrid table tfoot td div{ padding: 2px; }.datagrid table tfoot td ul { margin: 0; padding:0; list-style: none; text-align: right; }.datagrid table tfoot  li { display: inline; }.datagrid table tfoot li a { text-decoration: none; display: inline-block;  padding: 2px 8px; margin: 1px;color: #FFFFFF;border: 1px solid #006699;-webkit-border-radius: 3px; -moz-border-radius: 3px; border-radius: 3px; background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #006699), color-stop(1, #00557F) );background:-moz-linear-gradient( center top, #006699 5%, #00557F 100% );filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#006699', endColorstr='#00557F');background-color:#006699; }.datagrid table tfoot ul.active, .datagrid table tfoot ul a:hover { text-decoration: none;border-color: #006699; color: #FFFFFF; background: none; background-color:#00557F;}
  
  
  .myButton1 {
	box-shadow: 0px 10px 14px -7px #3e7327;
	background:linear-gradient(to bottom, #77b55a 5%, #72b352 100%);
	background-color:#77b55a;
	border-radius:4px;
	border:1px solid #4b8f29;
	display:inline-block;
	cursor:pointer;
	color:#ffffff;
	font-family:Arial;
	font-size:15px;
	font-weight:bold;
	padding:3px 5px;
	text-decoration:none;
	text-shadow:0px 1px 0px #5b8a3c;
}
.myButton1:hover {
	background:linear-gradient(to bottom, #72b352 5%, #77b55a 100%);
	background-color:#72b352;
}
.myButton1:active {
	position:relative;
	top:1px;
}

.myButton2 {
	box-shadow: 0px 10px 14px -7px #707327;
	background:linear-gradient(to bottom, #b39a59 5%, #ebe236 100%);
	background-color:#b39a59;
	border-radius:4px;
	border:1px solid #7b8f29;
	display:inline-block;
	cursor:pointer;
	color:#ffffff;
	font-family:Arial;
	font-size:15px;
	font-weight:bold;
	padding:1px 4px;
	text-decoration:none;
	text-shadow:0px 1px 0px #d6d645;
}
.myButton2:hover {
	background:linear-gradient(to bottom, #ebe236 5%, #b39a59 100%);
	background-color:#ebe236;
}
.myButton2:active {
	position:relative;
	top:1px;
}

.myButton3 {
	box-shadow: 0px 10px 14px -7px #735527;
	background:linear-gradient(to bottom, #d94f04 5%, #f596a6 100%);
	background-color:#d94f04;
	border-radius:4px;
	border:1px solid #e8a079;
	display:inline-block;
	cursor:pointer;
	color:#ffffff;
	font-family:Arial;
	font-size:15px;
	font-weight:bold;
	padding:1px 5px;
	text-decoration:none;
	text-shadow:0px 1px 0px #f2beb1;
}
.myButton3:hover {
	background:linear-gradient(to bottom, #f596a6 5%, #d94f04 100%);
	background-color:#f596a6;
}
.myButton3:active {
	position:relative;
	top:1px;
}

.fondotabla {
	box-shadow: 0px 10px 14px -7px #276873;
  background:linear-gradient(to bottom, #ffc477 5%, #fb9e25 100%);
	background-color:#ffc477;

	color:#ffffff;
	font-family:Arial;
	font-size:12px;
	font-weight:bold;

}
</style>