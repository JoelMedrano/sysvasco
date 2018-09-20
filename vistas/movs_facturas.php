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
if ($_SESSION['almacen']==1)
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
                          <h1 class="box-title">Artículo</h1>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive" id="listadoregistros">
                        <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                          <thead>
                            <th>Tipo</th>
                            <th>Documento</th>
                            <th>Fecha</th>
                            <th>Código</th>
                            <th>Cliente</th>
                            <th>Peso del Pedido</th>
                          </thead>
                          <tbody>
                          </tbody>
                          <tfoot>
                            <th>Tipo</th>
                            <th>Documento</th>
                            <th>Fecha</th>
                            <th>Código</th>
                            <th>Cliente</th>
                            <th>Peso del Pedido</th>
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
<script type="text/javascript" src="scripts/movs_facturas.js"></script>
<?php
}
ob_end_flush();
?>
