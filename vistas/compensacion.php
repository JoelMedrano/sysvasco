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
                  <h1 class="box-title">Compensación <button class="btn btn-success" id="btnagregar" onclick="mostrarform(true)"><i
                        class="fa fa-plus-circle"></i> Agregar</button></h1>
                  <div class="box-tools pull-right">
                  </div>
                </div>
                <!-- /.box-header -->
                <!-- centro -->
                <div class="panel-body table-responsive" id="listadoregistros">
                  <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                    <thead>
                      <th>Id</th>
                      <th>Nombre</th>
                      <th>Tipo Planilla</th>
                      <th>Sucursal</th>
                      <th>Funcion</th>
                      <th>Area</th>
                      <th>Estado</th>
                      <th>DNI</th>
                      <th>Opciones</th>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot>
                      <th>Id</th>
                      <th>Nombre</th>
                      <th>Tipo Planilla</th>
                      <th>Sucursal</th>
                      <th>Funcion</th>
                      <th>Area</th>
                      <th>Estado</th>
                      <th>DNI</th>
                      <th>Opciones</th>
                    </tfoot>
                  </table>
                </div>

                <div class="panel-body" style="height: 400px;" id="formularioregistros">
                  <form name="formulario" id="formulario" method="POST">

                    <div class="form-group col-lg-4 col-md-6 col-sm-6 col-xs-12">

                      <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <label>Trabajador(*):</label>
                        <input type="text" name="id_compensacion" id="id_compensacion">
                        <select id="id_trab" name="id_trab" class="form-control selectpicker" data-live-search="true" required></select>
                      </div>

                    </div>

                    <div class="form-group col-lg-8 col-md-6 col-sm-6 col-xs-12">

                      <div class="form-group col-lg-6 col-md-12 col-sm-12 col-xs-12">
                        <label>Tardanzas(*):</label>
                        <select id="id_hor_per" name="id_hor_per" class="form-control selectpicker" data-live-search="true" required></select>
                      </div>

                      <div class="form-group col-lg-6 col-md-12 col-sm-12 col-xs-12">
                        <label>Cantidad de Horas(*):</label>
                        <select id="hor_per" name="hor_per" class="form-control selectpicker" data-live-search="true" required></select>
                      </div>

                      <div class="form-group col-lg-6 col-md-12 col-sm-12 col-xs-12">
                        <label>Horas Extra(*):</label>
                        <select id="id_hor_ext" name="id_hor_ext" class="form-control selectpicker" data-live-search="true" required></select>
                      </div>

                      <div class="form-group col-lg-6 col-md-12 col-sm-12 col-xs-12">
                        <label>Cantidad de Horas Extra(*):</label>
                        <select id="hor_ext" name="hor_ext" class="form-control selectpicker" data-live-search="true" required></select>
                      </div>

                      <div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">

                        <label>Compensar:</label>
                        <input type="text" class="form-control" name="total" id="total" placeholder="00:00">
                        <br>
                        <button class="btn btn-success" type="button" onclick="restarHoras()">Restar</button>

                      </div>

                    </div>

                    <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                      <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i> Compensar</button>

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
<script type="text/javascript" src="scripts/compensacion.js"></script>
<?php 
}
ob_end_flush();
?>


