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
                          <h1 class="box-title">Habilitar Descuento de Tardanzas - Permisos x Horas en el Reloj</h1>  

                        <div class="box-tools pull-right">
                       </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->

                    <div class="panel-body table-responsive" id="listadoregistros">
                        <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                          <thead>
                            <th>Año</th>
                            <th>Fec.Pago</th>
                            <th>Fecha</th>
                            <th>Trabajador</th>
                            <th>Tiempo</th>
                            <th>Tipo.Permiso</th>
                            <th>Situacion</th>
                            <th>Descontar</th>
                           <!---  <th>Editar</th> -->
                          </thead>
                          <tbody>                            
                          </tbody>
                          <tfoot>
                            <th>Año</th>
                            <th>Fec.Pago</th>
                            <th>Fecha</th>
                            <th>Trabajador</th>
                            <th>Tiempo</th>
                            <th>Tipo.Permiso</th>
                            <th>Situacion</th>
                            <th>Descontar</th>
                          <!---  <th>Editar</th> -->
                          </tfoot>
                        </table>
                    </div>
                    <div class="panel-body" style="height: 620px;" id="formularioregistros">
                        <form name="formulario" id="formulario" method="POST">
                          
                      
                        
                          
                       <div class="box-header with-border">

                            <div class="form-group  col-xs-12">
                                <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">Trabajador:</label>
                                <div class="col-lg-2">
                                  <input type="date" class="form-control" name="fec_nac_trab" id="fec_nac_trab">
                                  <input type="hidden" readonly class="form-control" name="id_hor_per" id="id_hor_per">
                                </div>
                                <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">Lugar Nac:</label>
                                <div class="col-lg-1">
                                  <input type="text" class="form-control" name="fecha" id="fecha"  autocomplete="off">
                                </div>
                                <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">Nacionalidad</label>
                                <div class="col-lg-1">
                                  <input type="text" class="form-control" name="nacionalidad" id="nacionalidad"  autocomplete="off">
                                </div>
                                <label class="col-col-lg-2 col-md-2 col-sm-2 control-label">Est.Civil(*):</label>
                                <div class="col-lg-2">
                                   <select id="id_est_civil" name="id_est_civil" class="form-control selectpicker" data-live-search="true" ></select>
                                </div>
                            </div>

                          
                           
                            <!-- fila 1 -->
                           <div class="form-group  col-xs-12">
                                <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">Tipo de Doc(*):</label>
                                <div class="col-lg-2">
                                  <select id="id_tip_doc" name="id_tip_doc" class="form-control selectpicker" data-live-search="true" required></select>
                                </div>
                                <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">Dni(*):</label>
                                <div class="col-lg-1">
                                  <input type="text" class="form-control" name="num_doc_trab" id="num_doc_trab" required  autocomplete="off">
                                </div>
                                <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">Tlf. Docimicilio:</label>
                                <div class="col-lg-1">
                                  <input type="text" class="form-control" name="num_tlf_dom" id="num_tlf_dom"  autocomplete="off">
                                </div>
                                <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">Tlf. Celular:</label>
                                <div class="col-lg-1">
                                  <input type="text" class="form-control" name="num_tlf_cel" id="num_tlf_cel"  autocomplete="off"> 
                                </div>
                                <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">E-Mail</label>
                                <div class="col-lg-2">
                                  <input type="text" class="form-control" name="email_trab" id="email_trab"  autocomplete="off">
                                </div>
                            </div>

                    </div>



                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12"  align="right">
                            <a data-toggle="modal" href="#myModal">
                              <button id="btnAgregarArt" type="button" class="btn btn-primary"> <span class="fa fa-plus"></span> Agregar Permiso-Falta de otro Periodo de Pago</button>
                            </a>
                          </div>


                          <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                            <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
                              <thead style="background-color:#A9D0F5">
                                    <th>Item</th>
                                    <th>Fecha</th>
                                    <th>Trabajador</th>
                                    <th>Tiempo</th>
                                    <th>Incidencia</th>
                                    <th>Tipo</th>
                                    <th>Motivo</th>

                                </thead>
                                <tfoot>
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
            </thead>
            <tbody>
              
            </tbody>
            <tfoot>
                <th>Opciones</th>
                <th>Id.Periodo</th>
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
<script type="text/javascript" src="scripts/habilitardscto_permisostardanzas_xhorasenreloj.js"></script>
<?php 
}
ob_end_flush();
?>


