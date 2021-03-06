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
                          <h1 class="box-title">Excepciones Horario - Pago<button class="btn btn-success" id="btnagregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Agregar</button></h1>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive" id="listadoregistros">
                        <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                          <thead>
                            <th>-</th>
                            <th>Codigo.Trab</th>
                            <th>Trabajador</th>
                            <th>Area</th>
                            <th>Estado</th>
                            <th>Ver</th>
                            <th>Anular</th>
                          </thead>
                          <tbody>                            
                          </tbody>
                          <tfoot>
                            <th>-</th>
                            <th>Codigo.Trab</th>
                            <th>Trabajador</th>
                            <th>Area</th>
                            <th>Estado</th>
                            <th>Ver</th>
                            <th>Anular</th>
                          </tfoot>
                        </table>
                    </div>
                    <div class="panel-body" id="formularioregistros">
                        <form name="formulario" id="formulario" method="POST">



                         <div class="box-header">
                         </div>
                          

                         <div class="box-header">
                         </div>
                        
                         <div class="box-header">
                          

                                <div class="form-group col-lg-1 col-md-1 col-sm-1 col-xs-12">
                                  <label>Codigo:</label>
                                  <input type="text" class="form-control" readonly name="id_excepcion" id="id_excepcion">
                                </div>

                                <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                  <label>Trabajador:</label>
                                  <select id="id_trab" name="id_trab" class="form-control selectpicker" data-live-search="true"></select>
                                </div>

                         </div>


                         
                         <div class="box-header">
                         </div>


                         <div class="box-header">
                         </div>

                          


                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i> Guardar</button>

                            <button class="btn btn-danger" onclick="cancelarform()" type="button"><i class="fa fa-arrow-circle-left"></i> Cancelar</button>
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
<script type="text/javascript" src="../public/js/JsBarcode.all.min.js"></script>
<script type="text/javascript" src="../public/js/jquery.PrintArea.js"></script>
<script type="text/javascript" src="scripts/excepciones_horario_pago.js"></script>
<?php 
}
ob_end_flush();
?>