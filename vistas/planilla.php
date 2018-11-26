<?php
//Activamos el almacenamiento en el buffer
ob_start();
session_start();

if (!isset($_SESSION["nombre"]))
{
  header("Location: login.html");
}
else
{
require 'header.php';
if ($_SESSION['rrhh']==1)
{
?>

<!--Contenido-->
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">        
        <!-- Main content -->
        <section class="content">
            <div class="row">
              <div class="col-md-12">
                  <div class="box">
                    <div class="box-header with-border">
                          <h1 class="box-title">Planilla
                         </h1>
                         <div class="box-tools pull-right">
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive" id="listadoregistros">
                        <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                          <thead>
                            <th>-</th>
                            <th>Año</th>
                            <th>Mes</th>
                            <th style="width:15px" >Exportar a Excel</th>
                            <th style="width:15px" >Estado Primera Quincena</th>
                            <th style="width:15px" >Estado Segunda Quincena</th>
                            <th style="width:15px" >Cerrar Primera Quincena</th>
                            <th style="width:15px" >Cerrar Segunda Quincena</th>
                          </thead>
                          <tbody>                            
                          </tbody>
                          <tfoot>
                            <th>-</th>
                            <th>Año</th>
                            <th>Mes</th>
                            <th style="width:15px" >Exportar a Excel</th>
                            <th style="width:15px" >Estado Primera Quincena</th>
                            <th style="width:15px" >Estado Segunda Quincena</th>
                            <th style="width:15px" >Cerrar Primera Quincena</th>
                            <th style="width:15px" >Cerrar Segunda Quincena</th>
                          </tfoot>
                        </table>
                    </div>

                    <!--M,J,K,G,M -->


                  



                  </div><!-- /.box -->
              </div><!-- /.col -->
          </div><!-- /.row -->
      </section><!-- /.content -->

    </div><!-- /.content-wrapper -->
  <!--Fin-Contenido-->
<?php
}
else
{
  require 'noacceso.php';
}
require 'footer.php';
?>
<script type="text/javascript" src="../public/js/JsBarcode.all.min.js"></script>
<script type="text/javascript" src="../public/js/jquery.PrintArea.js"></script>
<script type="text/javascript" src="scripts/planilla.js"></script>
<?php 
}
ob_end_flush();
?>