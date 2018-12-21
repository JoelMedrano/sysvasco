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
                          <h1 class="box-title">Registro Manual  de Horas y Dias <button class="btn btn-success" id="btnagregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Agregar</button> <a href="../reportes/rptpermisos.php" target="_blank"><button class="btn btn-info">Reporte</button></a></h1>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive" id="listadoregistros">
                        <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                          <thead>
                            <th>-</th>
                            <th>Fecha de Registro</th>
                            <th>Sucursal</th>
                            <th>Area</th>
                            <th>Colaborador</th>
                            <th>Ver</th>
                          </thead>
                          <tbody>                            
                          </tbody>
                          <tfoot>
                            <th>-</th>
                            <th>Fecha de Registro</th>
                            <th>Sucursal</th>
                            <th>Area</th>
                            <th>Colaborador</th>
                            <th>Ver</th>
                          </tfoot>
                        </table>
                    </div>
                    <div class="panel-body" id="formularioregistros">
                        <form name="formulario" id="formulario" method="POST">
                 
                       <div class="form-group  col-xs-12">

                                 
                                  <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                      <label>Codigo de Personal(*):</label>
                                      <input type="hidden" name="id_rmhd" id="id_rmhd">
                                      <select id="id_trab" name="id_trab" class="form-control selectpicker" data-live-search="true"  autocomplete="off"></select>
                                    </div>


                                  <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                    <label>Fecha Reloj</label>
                                    <input type="date" class="form-control" name="fecha" id="fecha"   required autocomplete="off">
                                  
                                    
                                  </div>


                                   <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                    <label></label>
                                     <br>
                                    <button class="btn btn-success" type="button" onclick="filtrar()">Filtrar</button>
                                  </div>


                                  

                                                       


                         </div>    


                          <div class="form-group  col-xs-12">  

                                    <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                      <label>Hora Ingreso:</label>
                                      <input type="varchar" class="form-control" name="hora_ing" id="hora_ing" autocomplete="off">
                                    </div>
                                   <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                      <label>Hora Salida:</label>
                                      <input type="varchar" class="form-control" name="hora_sal" id="hora_sal" autocomplete="off">
                                    </div>


                                    <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                     <label></label>
                                      <select id="id_accion" name="id_accion" class="form-control selectpicker" data-live-search="true"  autocomplete="off"></select>
                                    </div>

                          </div>

                          
                        

                          <div class="form-group  col-xs-12">  

                                   

                                     <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                      <label>Observacion:</label>
                                      <input type="text" class="form-control"  name="obs" id="obs"  required autocomplete="off">
                                  
                                    </div>

                                     <div class="form-group col-lg-1 col-md-1 col-sm-1 col-xs-12">
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
<script type="text/javascript" src="scripts/registro_manual_horas_dias.js"></script>
<?php 
}
ob_end_flush();
?>