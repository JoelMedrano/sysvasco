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
            <h1 class="box-title">AVIOS <button class="btn btn-success" id="btnagregar" onclick="mostrarform(true)"><i
                  class="fa fa-plus-circle"></i> Agregar</button></h1>
            <div class="box-tools pull-right">
            </div>
          </div>
          <!-- /.box-header -->
          <!-- centro -->
          <div class="panel-body table-responsive" id="listadoregistros">
            <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
              <thead>
                <th>Id Avios</th>
                <th>Id Combo</th>
                <th>Id FT</th>
                <th>Modelo</th>
                <th>Nombre del Modelo</th>
                <th>Cod. Combo</th>
                <th>Combo</th>
                <th>Opciones</th>
              </thead>
              <tbody>
              </tbody>
              <tfoot>
                <th>Id Avios</th>
                <th>Id Combo</th>
                <th>Id FT</th>
                <th>Modelo</th>
                <th>Nombre del Modelo</th>
                <th>Cod. Combo</th>
                <th>Combo</th>
                <th>Opciones</th>
              </tfoot>
            </table>
          </div>
          <div class="panel-body" style="height: 400px;" id="formularioregistros">
            <form name="formulario" id="formulario" method="POST">

              <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <label>COMBOS(*):</label>
                <input type="hidden" name="idavios" id="idavios">
                <select id="idmft_color" name="idmft_color" class="form-control selectpicker" data-live-search="true"
                  required>

                </select>
              </div>

              <div class="form-group col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <label>Imagen de Avios:</label>
                <input type="file" class="form-control" name="avios" id="avios">
                <input type="hidden" name="aviosactual_avios" id="aviosactual_avios">
                <img src="" width="150px" height="180px" id="avios_muestra">
              </div>

              <div class="form-group col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <label></label>
                </div>
                <a data-toggle="modal" href="#myModal">
                  <button id="btnAgregarArt" type="button" class="btn btn-primary"> <span class="fa fa-plus-circle"></span>   Agregar Materia Prima</button>
                </a>
              </div>


              <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                <table id="detalles" class="table table-striped table-bordered table-condensed table-hover table-responsive">
                  <thead style="background-color:#A9D0F5">
                    <th>Opciones</th>
                    <th>Artículo</th>
                    <th>Detalle</th>
                    <th>Cod. Fabrica</th>
                    <th>Und. Medida</th>
                    <th>Ubicacion Prenda</th>
                    <th>Consumo x Pda.</th>
                    <th>Consumo x Pda + % Teñido</th>
                    <th>Proveedor</th>
                  </thead>
                  <tfoot>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
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
  <div class="modal-dialog" style="width: 100% !important;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">Seleccione un Artículo</h4>
      </div>
      <div class="modal-body">
        <table id="tblarticulos" class="table table-striped table-bordered table-condensed table-hover">
          <thead>
            <th>Opciones</th>
            <th>Cod. Linea</th>
            <th>Linea</th>
            <th>CodPro</th>
            <th>CodFab</th>
            <th>Descripcion</th>
            <th>Color</th>
            <th>Und</th>
            <th>Stock</th>
            <th>Precio</th>
            <th>Proveedor</th>
          </thead>
          <tbody>

          </tbody>
          <tfoot>
            <th>Opciones</th>
            <th>Cod. Linea</th>
            <th>Linea</th>
            <th>CodPro</th>
            <th>CodFab</th>
            <th>Descripcion</th>
            <th>Color</th>
            <th>Und</th>
            <th>Stock</th>
            <th>Precio</th>
            <th>Proveedor</th>
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
<script type="text/javascript" src="scripts/ft_hoja3.js"></script>
<?php
}
ob_end_flush();
?>