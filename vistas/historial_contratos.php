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
                          <h1 class="box-title">Contratos</h1>
                           </h1>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive" id="listadoregistros">
                        <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                          <thead>
                            <th>Est.</th>
                            <th>Sucursal Anexo</th>
                            <th>Area</th>
                            <th>Funcion</th>
                            <th>Nombres</th>
                            <th>Ver Historial</th>
                          </thead>
                          <tbody>                            
                          </tbody>
                          <tfoot>
                            <th>Est.</th>
                            <th>Sucursal Anexo</th>
                            <th>Area</th>
                            <th>Funcion</th>
                            <th>Nombres</th>
                            <th>Ver Historial</th>
                          </tfoot>
                        </table>
                    </div>
                    <div class="panel-body" style="height: 620px;" id="formularioregistros">
                        <form name="formulario" id="formulario" method="POST">

                        <div class="form-group  col-xs-12">

                                    <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                      <label>Trabajador(*):</label>
                                      <select id="id_nomtrab" name="id_nomtrab" class="form-control selectpicker" data-live-search="true" required>
                                      </select>
                                    </div>
                                    <div class="form-group col-lg-1 col-md-1 col-sm-6 col-xs-12">
                                      <label>Codigo.Trab:</label>
                                      <input type="text" readonly class="form-control" name="id_trab" id="id_trab">
                                      <input type="hidden" class="form-control" name="CantItems" id="CantItems">
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

                        </div>

                         <div class="col-lg-6 col-sm-6 col-md-6 col-xs-6">
                            <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
                              <thead style="background-color:#A9D0F5">
                                    <th width="3000px">Item</th>
                                    <th width="3000px">Fecha Desde</th>
                                    <th width="3000px">Fecha Hasta</th>
                                    <th width="3000px">Meses Renovados</th>
                                    <th width="3000px">Situacion Informativa</th>
                                </thead>
                                <tfoot>
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
<script type="text/javascript" src="scripts/historial_contratos.js"></script>
<?php 
}
ob_end_flush();
?>


