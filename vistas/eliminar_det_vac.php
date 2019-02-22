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
                          <h1 class="box-title">Eliminar Detalle Vacaciones 
                          <a href="vacaciones.php" class="btn btn-success" role="button">Vacaciones</a>
                          </h1>
                          
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive" id="listadoregistros">
                        <table id="tbllistadoDetalle" class="table table-striped table-bordered table-condensed table-hover">
                          <thead>
                            <th>Id.Trab</th>
                            <th>Trabajador</th>
                            <th>Doc.</th>
                            <th>Item</th>
                            <th>Periodo</th>
                            <th>Del</th>
                            <th>Al</th>
                            <th>Total Dias</th>
                            <th>Dias Pend</th>
                            <th>Observaciones</th>
                            <th>Periodo</th>
                            <th>Eliminar</th>
                          </thead>
                          <tbody>                            
                          </tbody>
                          <tfoot>
                            <th>Id.Trab</th>
                            <th>Trabajador</th>
                            <th>Doc</th>
                            <th>Item</th>
                            <th>Periodo</th>
                            <th>Del</th>
                            <th>Al</th>
                            <th>Total Dias</th>
                            <th>Dias Pendientes</th>
                            <th>Observaciones</th>
                            <th>Periodo</th>
                            <th>Eliminar</th>
                          </tfoot>
                        </table>
                    </div>

                    <!--Fin centro -->
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
<script type="text/javascript" src="scripts/vacaciones.js"></script>
<?php 
}
ob_end_flush();
?>