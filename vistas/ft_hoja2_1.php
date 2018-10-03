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

if ($_SESSION['udp']==1)
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
            <h1 class="box-title">FICHAS TECNICAS - Combinaciones - Combinaciones <button class="btn btn-success" id="btnagregar"
                onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Agregar</button></h1>
            <div class="box-tools pull-right">
            </div>
          </div>
          <!-- /.box-header -->
          <!-- centro -->
          <div class="panel-body table-responsive" id="listadoregistros">
            <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
              <thead>
                <th>Id</th>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Nombre</th>
                <th>Diseñado Por</th>
                <th>Elaborado Por</th>
                <th>F. Creación</th>
                <th>Visto Bueno</th>
                <th>Estado</th>
                <th>Opciones</th>
              </thead>
              <tbody>
              </tbody>
              <tfoot>
                <th>Id</th>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Nombre</th>
                <th>Diseñado Por</th>
                <th>Elaborado Por</th>
                <th>F. Creación</th>
                <th>Visto Bueno</th>
                <th>Estado</th>
                <th>Opciones</th>
              </tfoot>
            </table>
          </div>
          <div class="panel-body" id="formularioregistros">
            <form name="formulario" id="formulario" method="POST">

              <div class="form-group col-lg-3 col-md-2 col-sm-6 col-xs-12">
                <label>Ficha Tecnica:</label>
                <input type="text" class="form-control" name="idmft" id="idmft">
              </div>

              <div class="form-group col-lg-3 col-md-8 col-sm-12 col-xs-12">
                <label>Modelo(*):</label>
                <select id="cod_mod" name="cod_mod" class="form-control selectpicker" data-live-search="true" required>
                </select>
              </div>

              <div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">

                <a data-toggle="modal" href="#myModal">
                  <button id="btnAgregarArt" type="button" class="btn btn-primary"> <span class="fa fa-plus"></span>
                    Agregar Combos</button>
                </a>
              </div>

              <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
                  <thead style="background-color:#A9D0F5">
                    <th>Opciones</th>
                    <th>Combo Color</th>
                    <th>Tela 1</th>
                    <th>Color 1</th>
                    <th>Tela 2</th>
                    <th>Color 2</th>
                    <th>Tela 3</th>
                    <th>Color 3</th>
                  </thead>
                  <tfoot>
                    <th>Opciones</th>
                    <th>Combo Color</th>
                    <th>Tela 1</th>
                    <th>Color 1</th>
                    <th>Tela 2</th>
                    <th>Color 2</th>
                    <th>Tela 3</th>
                    <th>Color 3</th>
                  </tfoot>
                  <tbody>

                  </tbody>
                </table>
              </div>

              <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i> Guardar</button>

                <button id="btnCancelar" class="btn btn-danger" onclick="cancelarform()" type="button"><i class="fa fa-arrow-circle-left"></i>
                  Cancelar</button>
              </div>
            </form>
          </div>
          <!--Fin centro -->
        </div><!-- /.box -->
      </div><!-- /.col -->
    </div><!-- /.row -->
  </section><!-- /.content -->

</div><!-- /.content-wrapper -->
<!--Fin-Contenido-->

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" style="width: 65% !important;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title"><b>Seleccione una Materia Prima</b></h4>
      </div>
      <div class="modal-body">
        <table id="tblarticulos" class="table table-striped table-bordered table-condensed table-hover">
          <thead>
            <th>Opciones</th>
            <th>Id</th>
            <th>Modelo</th>
            <th>Nombre</th>
            <th>Cod. Color</th>
            <th>Color</th>
          </thead>
          <tbody>

          </tbody>
          <tfoot>
            <th>Opciones</th>
            <th>Id</th>
            <th>Modelo</th>
            <th>Nombre</th>
            <th>Cod. Color</th>
            <th>Color</th>
          </tfoot>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
<!-- Fin modal -->
<?php
}
else
{
  require 'noacceso.php';
}

require 'footer.php';
?>
<script type="text/javascript" src="scripts/ft_hoja2_1.js"></script>
<?php
}
ob_end_flush();
?>
