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
                          <h1 class="box-title">Pago Vacaciones Destajeros</h1>
                           <button class="btn btn-success" id="btnagregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Agregar</button>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive" id="listadoregistros">
                        <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                          <thead>
                            <th>EST.</th>
                            <th>Dni</th>
                            <th>Codigo</th>
                            <th>Sucursal Anexo</th>
                            <th>Area</th>
                            <th>Funcion</th>
                            <th>Nombres</th>
                            <th>Est.Trabajador</th>
                            <th>Opciones</th>
                          </thead>
                          <tbody>                            
                          </tbody>
                          <tfoot>
                            <th>EST.</th>
                            <th>Dni</th>
                            <th>Codigo</th>
                            <th>Sucursal Anexo</th>
                            <th>Area</th>
                            <th>Funcion</th>
                            <th>Nombres</th>
                            <th>Est.Trabajador</th>
                            <th>Opciones</th>
                          </tfoot>
                        </table>
                    </div>
                    <div class="panel-body" style="height: 620px;" id="formularioregistros">
                        <form name="formulario" id="formulario" method="POST">


                        
                           <!-- fila 1 -->
                           <div class="form-group  col-xs-12">


                                <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">Ap.Paterno(*):</label>
                                <div class="col-lg-4">
                                  <select id="id_nomtrab" name="id_nomtrab" class="form-control selectpicker" data-live-search="true" required>
                                  </select>
                                </div>
                          

                                <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">Ap.Paterno(*):</label>
                                <div class="col-lg-2">
                                   <input type="text" class="form-control" name="apepat_trab" id="apepat_trab" required autocomplete="off">
                                </div>
                                <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">Ap.Materno(*):</label>
                                <div class="col-lg-2">
                                   <input type="text" class="form-control" name="apemat_trab" id="apemat_trab" required autocomplete="off">
                                </div>
                                <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">Id.trabajador(*):</label>
                                <div class="col-lg-1">
                                   <input type="text" readonly class="form-control" name="id_trab" id="id_trab"  autocomplete="off">
                                </div>
                             
                           </div>



                       
                           <!-- fila 1 -->
                           <div class="form-group  col-xs-12">

                                <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">Mes6:</label>
                                <div class="col-lg-2">
                                   <input type="text" class="form-control" name="apepat_trab" id="apepat_trab" required autocomplete="off">
                                </div>
                                <label class="col-col-lg-1 col-md-1 col-sm-1 control-label"></label>
                                <div class="col-lg-2">
                                   <input type="text" class="form-control" name="apemat_trab" id="apemat_trab" required autocomplete="off">
                                </div>
                             
                           </div>

                           <!-- fila 1 -->
                           <div class="form-group  col-xs-12">

                                <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">Mes5:</label>
                                <div class="col-lg-2">
                                   <input type="text" class="form-control" name="apepat_trab" id="apepat_trab" required autocomplete="off">
                                </div>
                                <label class="col-col-lg-1 col-md-1 col-sm-1 control-label"></label>
                                <div class="col-lg-2">
                                   <input type="text" class="form-control" name="apemat_trab" id="apemat_trab" required autocomplete="off">
                                </div>
                             
                           </div>




                           <div class="form-group  col-xs-12">

                                <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">Mes4:</label>
                                <div class="col-lg-2">
                                   <input type="text" class="form-control" name="apepat_trab" id="apepat_trab" required autocomplete="off">
                                </div>
                                <label class="col-col-lg-1 col-md-1 col-sm-1 control-label"></label>
                                <div class="col-lg-2">
                                   <input type="text" class="form-control" name="apemat_trab" id="apemat_trab" required autocomplete="off">
                                </div>
                             
                           </div>



                           <div class="form-group  col-xs-12">

                                <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">Mes3:</label>
                                <div class="col-lg-2">
                                   <input type="text" class="form-control" name="apepat_trab" id="apepat_trab" required autocomplete="off">
                                </div>
                                <label class="col-col-lg-1 col-md-1 col-sm-1 control-label"></label>
                                <div class="col-lg-2">
                                   <input type="text" class="form-control" name="apemat_trab" id="apemat_trab" required autocomplete="off">
                                </div>
                             
                           </div>



                           <div class="form-group  col-xs-12">

                                <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">Mes2:</label>
                                <div class="col-lg-2">
                                   <input type="text" class="form-control" name="apepat_trab" id="apepat_trab" required autocomplete="off">
                                </div>
                                <label class="col-col-lg-1 col-md-1 col-sm-1 control-label"></label>
                                <div class="col-lg-2">
                                   <input type="text" class="form-control" name="apemat_trab" id="apemat_trab" required autocomplete="off">
                                </div>
                             
                           </div>


                            <div class="form-group  col-xs-12">

                                <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">Mes1:</label>
                                <div class="col-lg-2">
                                   <input type="text" class="form-control" name="apepat_trab" id="apepat_trab" required autocomplete="off">
                                </div>
                                <label class="col-col-lg-1 col-md-1 col-sm-1 control-label"></label>
                                <div class="col-lg-2">
                                   <input type="text" class="form-control" name="apemat_trab" id="apemat_trab" required autocomplete="off">
                                </div>
                             
                           </div>



                           <div class="form-group  col-xs-12">

                                <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">Asig.Familiar:</label>
                                <div class="col-lg-2">
                                   <input type="text" class="form-control" name="apepat_trab" id="apepat_trab" required autocomplete="off">
                                </div>
                                <label class="col-col-lg-1 col-md-1 col-sm-1 control-label"></label>
                                <div class="col-lg-2">
                                   <input type="text" class="form-control" name="apemat_trab" id="apemat_trab" required autocomplete="off">
                                </div>
                             
                           </div>



                            <div class="form-group  col-xs-12">

                                <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">Total.Promedio:</label>
                                <div class="col-lg-2">
                                   <input type="text" class="form-control" name="apepat_trab" id="apepat_trab" required autocomplete="off">
                                </div>
                                <label class="col-col-lg-1 col-md-1 col-sm-1 control-label"></label>
                                <div class="col-lg-2">
                                   <input type="text" class="form-control" name="apemat_trab" id="apemat_trab" required autocomplete="off">
                                </div>
                             
                           </div>



                            <div class="form-group  col-xs-12">

                                <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">Pago a Considerar Vacaciones:</label>
                                <div class="col-lg-2">
                                   <input type="text" class="form-control" name="apepat_trab" id="apepat_trab" required autocomplete="off">
                                </div>
                                <label class="col-col-lg-1 col-md-1 col-sm-1 control-label"></label>
                                <div class="col-lg-2">
                                   <input type="text" class="form-control" name="apemat_trab" id="apemat_trab" required autocomplete="off">
                                </div>
                             
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
<script type="text/javascript" src="scripts/vacaciones.js"></script>
<?php 
}
ob_end_flush();
?>


