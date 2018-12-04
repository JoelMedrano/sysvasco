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
if ($_SESSION['udp']==1)
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
                          <h1 class="box-title">CONFECCION <button class="btn btn-success" id="btnagregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Agregar</button></h1>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive" id="listadoregistros">
                        <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                            <thead>
                                <th>ID FT</th>
                                <th>Modelo</th>
                                <th>Nombre</th>
                                <th>Operacion</th>
                                <th>Maquina</th>
                                <th>Codigo Puntada</th>
                                <th>Ancho de Costura</th>
                                <th>Puntadas x Pulgada</th>
                                <th>Opciones</th>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfoot>
                                <th>ID FT</th>
                                <th>Modelo</th>
                                <th>Nombre</th>
                                <th>Operacion</th>
                                <th>Maquina</th>
                                <th>Codigo Puntada</th>
                                <th>Ancho de Costura</th>
                                <th>Puntadas x Pulgada</th>
                                <th>Opciones</th>
                            </tfoot>
                        </table>
                    </div>
                    <div class="panel-body" id="formularioregistros">
                        <form name="formulario" id="formulario" method="POST">
                            
                            
                            <div class="form-group col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                <label>Ficha Tecnica(*):</label>
                                <input type="hidden" name="idconfeccion" id="idconfeccion">
                                <select id="idmft" name="idmft" class="form-control selectpicker" data-live-search="true" required></select>
                            </div>

                            <div class="form-group col-lg-2 col-md-6 col-sm-6 col-xs-12">
                                <label>Operacion(*):</label>
                                <select id="id_operacion" name="id_operacion" class="form-control selectpicker" data-live-search="true" required></select>
                            </div>

                            <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label>Descripción:</label>
                                <textarea type="text" class="form-control" name="descripcion" id="descripcion" maxlength="256" placeholder="Descripción"></textarea>
                            </div>

                            <div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
                                <label>Tipo Maquina(*):</label>
                                <select id="idtipo_maquina" name="idtipo_maquina" class="form-control selectpicker" data-live-search="true" required></select>
                            </div>
                            <div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
                                <label>Codigo Puntada:</label>
                                <select id="idcodigo_puntada" name="idcodigo_puntada" class="form-control selectpicker" data-live-search="true" ></select>
                            </div>

                            <div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
                                <label>Ancho Costura:</label>
                                <input type="text" class="form-control" name="ancho_costura" id="ancho_costura" maxlength="256"
                                    placeholder="Descripción">
                            </div>


                            <div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
                                <label>Puntadas por Pulgadas:</label>
                                <input type="text" class="form-control" name="puntadas_pulgadas" id="puntadas_pulgadas" maxlength="256" placeholder="Descripción">
                            </div>



                            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i> Guardar</button>

                                <button class="btn btn-danger" onclick="cancelarform()" type="button"><i class="fa fa-arrow-circle-left"></i>
                                    Cancelar</button>
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

<script type="text/javascript" src="scripts/confeccion.js"></script>
<?php 
}
ob_end_flush();
?>