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
                          <h1 class="box-title">Horas Lactancia <button class="btn btn-success" id="btnagregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Agregar</button> </h1>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive" id="listadoregistros">
                        <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                          <thead>
                            <th>HL</th>
                            <th>Año</th>
                            <th>Fecha de Pago</th>
                            <th>Opciones</th>
                          </thead>
                          <tbody>                            
                          </tbody>
                          <tfoot>
                            <th>HL</th>
                            <th>Año</th>
                            <th>Fecha de Pago</th>
                            <th>Opciones</th>
                          </tfoot>
                        </table>
                    </div>


                    <div class="panel-body" style="height: 620px;" id="formularioregistros">
                        <form name="formulario" id="formulario" method="POST">
                          
                        <div class="box-header with-border">
                                    <div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">
                                      <label>Año:</label>
                                      <input type="text" readonly class="form-control" name="Ano" id="Ano" autocomplete="off">
                                      <input type="hidden"  class="form-control" name="id_cp" id="id_cp" >
                                    </div>
                        </div>


                        <div class="box-header with-border">
                                    <div class="form-group col-lg-2 col-md-2 col-sm-6 col-xs-12">
                                      <label>Codigo:</label>
                                      <input type="text" readonly class="form-control" name="id_hor_lac" id="id_hor_lac" autocomplete="off">
                                    </div>
                        </div>


                        <div class="box-header with-border">
                                     <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                       <label>Fecha:</label>
                                          <select id="fec_des1" name="fec_des1" class="form-control selectpicker" data-live-search="true"></select> 
                                    </div>
                        </div>


                       <div class="box-header with-border">
                                     <div class="form-group col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                      <label>Horas de Lactancia:</label>
                                      <input type="number"  class="form-control" name="cantidad_horas" id="cantidad_horas"  autocomplete="off">
                                    </div>
                       </div>


                        
                          <br>




                         

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
          <h4 class="modal-title">Seleccione los trabajadores que llegaron su meta</h4>
        </div>
        <div class="modal-body">
          <table id="tblarticulos" class="table table-striped table-bordered table-condensed table-hover">
            <thead>
                <th>Opciones</th>
                <th>Id.Trabajador</th>
                <th>Nombres</th>
                <th>Sueldo</th>
                <th>Bono</th>
            </thead>
            <tbody>
              
            </tbody>
            <tfoot>
                <th>Opciones</th>
                <th>Id.Trabajador</th>
                <th>Nombres</th>
                <th>Sueldo</th>
                <th>Bono</th>
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
<script type="text/javascript" src="scripts/horas_lactancia.js"></script>
<?php 
}
ob_end_flush();
?>


