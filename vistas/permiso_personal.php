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
if ($_SESSION['almacen']==1)
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
                          
                            <th>Fecha Emision</th>
                            <th>Fecha Procede</th>
                            <th>Colaborador</th>
                            <th>Tipo Permiso</th>
                            <th>Motivo</th>
                            <th>Estado de Aprobacion</th>
                            <th>Estado de Registro</th>
                            <th>Visualizar</th>
                            <th>Aprobar</th>
                            <th>Anular</th>
                          </thead>
                          <tbody>                            
                          </tbody>
                          <tfoot>
                            <th>Fecha Emision</th>
                            <th>Fecha Procede</th>
                            <th>Colaborador</th>
                            <th>Tipo Permiso</th>
                            <th>Motivo</th>
                            <th>Estado de Aprobacion</th>
                            <th>Estado de Registro</th>
                            <th>Opciones</th>
                            <th>Aprobar</th>
                            <th>Anular</th>
                          </tfoot>
                        </table>
                    </div>
                    <div class="panel-body" id="formularioregistros">
                        <form name="formulario" id="formulario" method="POST">
                 
               

                           <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <label>Fec.Emisión:</label>
                            <input type="text" class="form-control" name="fecha_emision" id="fecha_emision"   value= "<?=$fecha ?>" required>
                          </div>

                           <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <label>Fec.Procede:</label>
                            <input type="text" class="form-control" name="fecha_procede" id="fecha_procede"  value= "<?=$fecha ?>"  required>
                          </div>

                           <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <label>Fec.Hasta:</label>
                            <input type="text" class="form-control" name="fecha_hasta" id="fecha_hasta"  value= "<?=$fecha ?>"  required>
                          </div>

                          

                          <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <label>Codigo de Personal(*):</label>
                            <input type="hidden" name="id_permiso" id="id_permiso">
                            <select id="id_trab" name="id_trab" class="form-control selectpicker" data-live-search="true" required></select>
                          </div>


                           <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                            <label>Tipo de Permiso(*):</label>
                            <select id="tip_permiso" name="tip_permiso" class="form-control selectpicker" data-live-search="true" required></select>
                          </div>

                          

                          <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <label>Hora Ingreso(*):</label>
                            <input type="time" class="form-control" name="hora_ing" id="hora_ing">
                          </div>

                          <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                            <label>Hora Salida :</label>
                            <input type="time" class="form-control" name="hora_sal" id="hora_sal">
                          </div>

                          <div class="form-group col-lg-8 col-md-8 col-sm-8 col-xs-12">
                            <label>Motivo:</label>
                            <input type="text" class="form-control" name="motivo" id="motivo"  required>
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