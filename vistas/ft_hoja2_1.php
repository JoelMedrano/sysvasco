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
            <h1 class="box-title">FICHAS TECNICAS - Especificaciones Técnicas <button class="btn btn-success" id="btnagregar"
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
                <th>Modelo</th>
                <th>Color</th>
                <th>Tela 1era Principal</th>
                <th>Color</th>
                <th>Tela 2da Principal</th>
                <th>Color</th>
                <th>Tela Complemento</th>
                <th>Color</th>
                <th>Opciones</th>
              </thead>
              <tbody>
              </tbody>
              <tfoot>
                <th>Id</th>
                <th>Modelo</th>
                <th>Color</th>
                <th>Tela 1era Principal</th>
                <th>Color</th>
                <th>Tela 2da Principal</th>
                <th>Color</th>
                <th>Tela Complemento</th>
                <th>Color</th>
                <th>Opciones</th>
              </tfoot>
            </table>
          </div>

          <div class="panel-body" id="formularioregistros">
            <form name="formulario" id="formulario" method="POST">

              <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">

                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <label>Ficha Tecnica(*):</label>
                  <input type="hidden" name="idftc" id="idftc">
                  <select id="idmft" name="idmft" class="form-control selectpicker" data-live-search="true" required>
                  </select>
                </div>

                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <label>Combo(*):</label>
                  <select id="com_color" name="com_color" class="form-control selectpicker" data-live-search="true"
                    required>
                  </select>
                </div>

              </div>

              <div class="form-group col-lg-8 col-md-8 col-sm-8 col-xs-12">

                <div class="form-group col-lg-8 col-md-8 col-sm-7 col-xs-12">
                  <label>Tela 1(*):</label>
                  <select id="tela1" name="tela1" class="form-control selectpicker" data-live-search="true">
                  </select>
                </div>

                <div class="form-group col-lg-4 col-md-4 col-sm-5 col-xs-12">
                  <label>Color 1(*):</label>
                  <select id="color1" name="color1" class="form-control selectpicker" data-live-search="true">
                  </select>
                </div>

                <div class="form-group col-lg-8 col-md-8 col-sm-7 col-xs-12">
                  <label>Tela 2(*):</label>
                  <select id="tela2" name="tela2" class="form-control selectpicker" data-live-search="true">
                  </select>
                </div>

                <div class="form-group col-lg-4 col-md-4 col-sm-5 col-xs-12">
                  <label>Color 2(*):</label>
                  <select id="color2" name="color2" class="form-control selectpicker" data-live-search="true">
                  </select>
                </div>

                <div class="form-group col-lg-8 col-md-8 col-sm-7 col-xs-12">
                  <label>Tela 3(*):</label>
                  <select id="tela3" name="tela3" class="form-control selectpicker" data-live-search="true">
                  </select>
                </div>

                <div class="form-group col-lg-4 col-md-4 col-sm-5 col-xs-12">
                  <label>COLOR 3(*):</label>
                  <select id="color3" name="color3" class="form-control selectpicker" data-live-search="true">
                  </select>
                </div>

              </div>


              <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i> Guardar</button>

                <button class="btn btn-danger" onclick="cancelarform()" type="button"><i class="fa fa-arrow-circle-left"></i>
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
