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

 $fecha=date("d/m/Y");
          



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
                          <h1 class="box-title">Permisos <button class="btn btn-success" id="btnagregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Agregar</button> <a href="../reportes/rptpermisos.php" target="_blank"><button class="btn btn-info">Reporte</button></a></h1>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive" id="listadoregistros">
                        <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                          <thead>
                          
                            <th>Fec.Emision</th>
                            <th>Fec.Procede</th>
                            <th>Solicitante</th>
                            <th>Colaborador</th>
                            <th>Tipo Permiso</th>
                            <th>Motivo</th>
                            <th>JEF.OPE</th>
                            <th>RR.HH</th>
                            <th>Est.Reg</th>
                            <th>Ver</th>
                            <th>JEF.OPE</th>
                            <th>RR.HH</th>
                            <th>Anular</th>
                          </thead>
                          <tbody>                            
                          </tbody>
                          <tfoot>
                            <th>Fec.Emision</th>
                            <th>Fec.Procede</th>
                            <th>Solicitante</th>
                            <th>Colaborador</th>
                            <th>Tipo Permiso</th>
                            <th>Motivo</th>
                            <th>JEF.OPE</th>
                            <th>RR.HH</th>
                            <th>Est.Reg</th>
                            <th>Ver</th>
                            <th>JEF.OPE</th>
                            <th>RR.HH</th>
                            <th>Anular</th>
                          </tfoot>
                        </table>
                    </div>
                    <div class="panel-body" id="formularioregistros">
                        <form name="formulario" id="formulario" method="POST">
                 
                       <div class="form-group  col-xs-12">

                                  

                                  <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                    <label>Fec.Procede:</label>
                                    <input type="hidden" class="form-control" name="fecha_emision" id="fecha_emision"   value= "<?=$fecha ?>" required  autocomplete="off">
                                    <input type="date" class="form-control" name="fecha_procede" id="fecha_procede"  value= "<?=$fecha ?>"  required  autocomplete="off">
                                  </div>

                                  <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                    <label>Fec.Hasta:</label>
                                    <input type="date" class="form-control" name="fecha_hasta" id="fecha_hasta"  value= "<?=$fecha ?>"  required autocomplete="off">
                                  </div>

                                  <div class="form-group col-lg-1 col-md-1 col-sm-1 col-xs-12">
                                    <label>Dias:</label>
                                    <input type="text" class="form-control" name="dias" id="dias"  readonly  autocomplete="off">
                                  </div>

                                  <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                  </div>


                                  <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                      <label>Fechas de Pago por Vacaciones:</label>
                                      <select id="id_fecha_pago1" name="id_fecha_pago1" class="form-control selectpicker" data-live-search="true"  autocomplete="off"></select>
                                  </div>

                                  <div class="form-group col-lg-1 col-md-1 col-sm-1 col-xs-12">
                                      <label>Monto a Pagar:</label>
                                      <input type="text" class="form-control" name="monto_a_pagar" id="monto_a_pagar" readonly   autocomplete="off">
                                  </div>

                                                       


                         </div>    


                          <div class="form-group  col-xs-12">  

                                    <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                      <label>Codigo de Personal(*):</label>
                                      <input type="hidden" name="id_permiso" id="id_permiso">
                                      <select id="id_trab" name="id_trab" class="form-control selectpicker" data-live-search="true"  autocomplete="off"></select>
                                    </div>
                                     
                                     <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                     </div>


                                    <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                     <label></label>
                                      <select id="id_fecha_pago2" name="id_fecha_pago2" class="form-control selectpicker" data-live-search="true"  autocomplete="off"></select>
                                    </div>

                          </div>

                          <div class="form-group  col-xs-12">  

                                    <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                      <label>Tipo de Permiso(*):</label>
                                      <select id="tip_permiso" name="tip_permiso" class="form-control selectpicker" data-live-search="true"  autocomplete="off"></select>
                                    </div>
                                  
                                    

                                     <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                     </div>


                                      <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                     <label></label>
                                      <select id="id_fecha_pago3" name="id_fecha_pago3" class="form-control selectpicker" data-live-search="true"  autocomplete="off"></select>
                                    </div>


                                 


                                  
                          </div>

                          <div class="form-group  col-xs-12">  

                                    <div class="form-group col-lg-1 col-md-1 col-sm-1 col-xs-12">
                                      <label>Hora Ingreso:</label>
                                      <input type="time" class="form-control" name="hora_ing" id="hora_ing" autocomplete="off">
                                    </div>
                                    <div class="form-group col-lg-1 col-md-1 col-sm-1 col-xs-12">
                                      <label>Hora Salida:</label>
                                      <input type="time" class="form-control" name="hora_sal" id="hora_sal" autocomplete="off">
                                    </div>

                                     <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                      <label>Motivo:</label>
                                      <input type="text" class="form-control" style="text-transform: uppercase" name="motivo" id="motivo"  required autocomplete="off">
                                    <br>
                                                          <button class="btn btn-success" type="button" onclick="restarHoras()">Restar</button>

                                    </div>

                                     <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                     </div>

                                  

                                   



                                    <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                     <label></label>
                                      <select id="id_fecha_pago4" name="id_fecha_pago4" class="form-control selectpicker" data-live-search="true"  autocomplete="off"></select>
                                    </div>

                          </div>


                          <div class="form-group  col-xs-12">  


                                     <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                      <label>Subir Imagen1:</label>
                                      <input type="file" class="form-control" name="imagen1" id="imagen1">
                                      <input type="hidden" name="imagenactual1" id="imagenactual1">
                                      <img src="" width="150px" height="120px" id="imagenmuestra1">
                                     </div>

                                     <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                      <label>Subir Imagen2:</label>
                                      <input type="file" class="form-control" name="imagen2" id="imagen2">
                                      <input type="hidden" name="imagenactual2" id="imagenactual2">
                                      <img src="" width="150px" height="120px" id="imagenmuestra2">
                                     </div>
                          </div>

                          <div class="form-group  col-xs-12">  


                                     <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                      <label>Subir Imagen3:</label>
                                      <input type="file" class="form-control" name="imagen3" id="imagen3">
                                      <input type="hidden" name="imagenactual3" id="imagenactual3">
                                      <img src="" width="150px" height="120px" id="imagenmuestra3">
                                     </div>


                                     <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                      <label>Subir Imagen4:</label>
                                      <input type="file" class="form-control" name="imagen4" id="imagen4">
                                      <input type="hidden" name="imagenactual4" id="imagenactual4">
                                      <img src="" width="150px" height="120px" id="imagenmuestra4">
                                     </div>

                           </div>


                            <div class="form-group  col-xs-12">  
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
<script type="text/javascript" src="scripts/permiso_personal.js"></script>
<?php 
}
ob_end_flush();
?>