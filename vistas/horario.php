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
                          <h1 class="box-title">Horarios<button class="btn btn-success" id="btnagregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Agregar</button></h1>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive" id="listadoregistros">
                        <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                          <thead>
                            <th>Codigo</th>
                            <th>Descripcion</th>
                            <th>Estado</th>
                            <th>Activar</th>
                            <th>Opciones</th>
                          </thead>
                          <tbody>                            
                          </tbody>
                          <tfoot>
                            <th>Codigo</th>
                            <th>Descripcion</th>
                            <th>Estado</th>
                            <th>Activar</th>
                            <th>Visualizar</th>
                          </tfoot>
                        </table>
                    </div>
                    <div class="panel-body" id="formularioregistros">
                        <form name="formulario" id="formulario" method="POST">
                       <div class="box-header with-border">

                                <div class="form-group col-lg-1 col-md-1 col-sm-1 col-xs-12">
                                  <label>Codigo:</label>
                                  <input type="text" class="form-control" name="id_horario" id="id_horario"  readonly>
                                </div>

                                <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                  <label>Descripcion:</label>
                                  <input type="text" class="form-control" name="descrip" id="descrip"   autocomplete="off"  >
                                </div>

                                <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                  <label>Turno(*):</label>
                                  <select id="id_turno" name="id_turno" class="form-control selectpicker" data-live-search="true"></select>
                                </div>

                       </div>

                      <div class="box-header with-border">
                                <div class="form-group col-lg-2 col-md-1 col-sm-2 col-xs-12">
                                  <label>Lunes Ingreso:</label>
                                  <input type="text" class="form-control" name="lunes_ingreso" id="lunes_ingreso" placeholder="Hora Inicio"   autocomplete="off">
                                </div>
                                <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                  <label>Lunes Salida:</label>
                                  <input type="text" class="form-control" name="lunes_salida" id="lunes_salida"  placeholder="Hora Fin"   autocomplete="off">
                                </div>

                                <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                  <label>Martes Ingreso:</label>
                                  <input type="text" class="form-control" name="martes_ingreso" id="martes_ingreso" placeholder="Hora Inicio"   autocomplete="off">
                                </div>
                                <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                  <label>Martes Salida:</label>
                                  <input type="text" class="form-control" name="martes_salida" id="martes_salida"  placeholder="Hora Fin"   autocomplete="off">
                                </div>


                                 <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                  <label>Miercoles Ingreso:</label>
                                  <input type="text" class="form-control" name="miercoles_ingreso" id="miercoles_ingreso" placeholder="Hora Inicio"   autocomplete="off">
                                </div>
                                <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                  <label>Miercoles Salida:</label>
                                  <input type="text" class="form-control" name="miercoles_salida" id="miercoles_salida"  placeholder="Hora Fin"   autocomplete="off">
                                </div>


                      </div>

                      <div class="box-header with-border">
                                <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                  <label>Jueves Ingreso:</label>
                                  <input type="text" class="form-control" name="jueves_ingreso" id="jueves_ingreso" placeholder="Hora Inicio"   autocomplete="off">
                                </div>
                                <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                  <label>Jueves Salida:</label>
                                  <input type="text" class="form-control" name="jueves_salida" id="jueves_salida"  placeholder="Hora Fin"   autocomplete="off">
                                </div>

                                <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                  <label>Viernes Ingreso:</label>
                                  <input type="text" class="form-control" name="viernes_ingreso" id="viernes_ingreso" placeholder="Hora Inicio"   autocomplete="off">
                                </div>
                                <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                  <label>Viernes Salida:</label>
                                  <input type="text" class="form-control" name="viernes_salida" id="viernes_salida"  placeholder="Hora Fin"   autocomplete="off">
                                </div>


                                 <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                  <label>Sabado Ingreso:</label>
                                  <input type="text" class="form-control" name="sabado_ingreso" id="sabado_ingreso" placeholder="Hora Inicio"   autocomplete="off">
                                </div>
                                <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                  <label>Sabado Salida:</label>
                                  <input type="text" class="form-control" name="sabado_salida" id="sabado_salida"  placeholder="Hora Fin"   autocomplete="off">
                                </div>
                          
                          
                     </div>    


                     <div class="box-header with-border">


                                <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                  <label>Domingo Ingreso:</label>
                                  <input type="text" class="form-control" name="domingo_ingreso" id="domingo_ingreso" placeholder="Hora Inicio"   autocomplete="off">
                                </div>
                                <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                  <label>Domingo Salida:</label>
                                  <input type="text" class="form-control" name="domingo_salida" id="domingo_salida"  placeholder="Hora Fin"   autocomplete="off">
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
<script type="text/javascript" src="scripts/horario.js"></script>
<?php 
}
ob_end_flush();
?>