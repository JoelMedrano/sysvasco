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

if ($_SESSION['ventas']==1)
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
                          <h1 class="box-title">Vacaciones<button class="btn btn-success" id="btnagregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Agregar</button></h1>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive" id="listadoregistros">
                        <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                          <thead>
                            
                            <th>Codigo</th>
                            <th>Dni</th>
                            <th>Sucursal Anexo</th>
                            <th>Area</th>
                            <th>Funcion</th>
                            <th>Nombres</th>
                            <th>Estado</th>
                            <th>Opciones</th>
                          </thead>
                          <tbody>                            
                          </tbody>
                          <tfoot>
                            
                            <th>Codigo</th>
                            <th>Dni</th>
                            <th>Sucursal Anexo</th>
                            <th>Area</th>
                            <th>Funcion</th>
                            <th>Nombres</th>
                            <th>Estado</th>
                            <th>Opciones</th>
                          </tfoot>
                        </table>
                    </div>
                    <div class="panel-body" style="height: 400px;" id="formularioregistros">
                        <form name="formulario" id="formulario" method="POST">
                          <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                            <label>Trabajador(*):</label>
                            <select id="id_nomtrab" name="id_nomtrab" class="form-control selectpicker" data-live-search="true" required>
                            </select>
                          </div>
                          <div class="form-group col-lg-1 col-md-1 col-sm-6 col-xs-12">
                            <label>Codigo.Trab:</label>
                            <input type="text" readonly class="form-control" name="id_trab" id="id_trab">
                          </div>
                           <div class="form-group col-lg-1 col-md-1 col-sm-6 col-xs-12">
                            <label>Dni:</label>
                            <input type="text" readonly class="form-control" name="nro_doc" id="nro_doc">
                          </div>

                          <div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">
                            <label>Sucursal:</label>
                            <input type="text" readonly class="form-control" name="sucursal" id="sucursal"  placeholder="Sucursal">
                          </div>
                          <div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">
                            <label>Area:</label>
                            <input type="text" readonly class="form-control" name="area_trab" id="area_trab"  placeholder="Area" >
                          </div>
                          <div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">
                            <label>Fec.Ingreso:</label>
                            <input type="text" readonly class="form-control" name="fec_ing_trab" id="fec_ing_trab"  placeholder="Fecha de Ingreso">
                          </div>
                        
                          <br>


                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12"  align="right">
                            <a data-toggle="modal" href="#myModal">
                              <button id="btnAgregarArt" type="button" class="btn btn-primary"> <span class="fa fa-plus"></span> Agregar Periodo</button>
                            </a>
                          </div>


                          <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                            <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
                              <thead style="background-color:#A9D0F5">
                                    <th>Item</th>
                                    <th>Periodo</th>
                                    <th>Del</th>
                                    <th>Al</th>
                                    <th>Total Dias</th>
                                    <th>Dias Pend</th>
                                    <th>Obser Detalle</th>
                                    <th>Vencidas</th>
                                    <th>Truncas</th>
                                    <th>Inicio</th>
                                    <th>Salida</th>
                                    <th>Tot.Dias</th>
                                    <th>Dias Pend</th>
                                    <th>Observaciones</th>
                                    <th>Opciones</th>
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
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th>Opciones</th>
                                </tfoot>
                                <tbody>
                                </tbody>
                            </table>
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

  <!-- Modal -->
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
    <div class="modal-dialog" style="width: 65% !important;">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Seleccione un Periodo</h4>
        </div>
        <div class="modal-body">
          <table id="tblarticulos" class="table table-striped table-bordered table-condensed table-hover">
            <thead>
                <th>Opciones</th>
                <th>Id.Periodo</th>
                <th>Periodo</th>
            </thead>
            <tbody>
              
            </tbody>
            <tfoot>
              <th>Opciones</th>
                <th>Id.Periodo</th>
                <th>Periodo</th>
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
<script type="text/javascript" src="scripts/vacaciones.js"></script>
<?php 
}
ob_end_flush();
?>


