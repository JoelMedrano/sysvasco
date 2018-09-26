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
if ($_SESSION['acceso']==1)
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
                          <h1 class="box-title">FICHAS TECNICAS - Especificaciones Técnicas <button class="btn btn-success" id="btnagregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Agregar</button></h1>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive" id="listadoregistros">
                        <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                          <thead>
                            <th>Id</th>
                            <th>Marca</th>
                            <th>Modelo</th>
                            <th>Nombre</th>
                            <th>Diseñado Por</th>
                            <th>Elaborado Por</th>
                            <th>F. Creación</th>
                            <th>Visto Bueno</th>
                            <th>Estado</th>
                            <th>Opciones</th>
                          </thead>
                          <tbody>
                          </tbody>
                          <tfoot>
                            <th>Id</th>
                            <th>Marca</th>
                            <th>Modelo</th>
                            <th>Nombre</th>
                            <th>Diseñado Por</th>
                            <th>Elaborado Por</th>
                            <th>F. Creación</th>
                            <th>Visto Bueno</th>
                            <th>Estado</th>
                            <th>Opciones</th>
                          </tfoot>
                        </table>
                    </div>
                    <div class="panel-body" id="formularioregistros">
                        <form name="formulario" id="formulario" method="POST">

                          <div class="form-group col-lg-9 col-md-8 col-sm-8 col-xs-12">

                            <div class="form-group col-lg-3 col-md-4 col-sm-4 col-xs-12">
                              <label>Empresa(*):</label>
                              <input type="hidden" name="idmft" id="idmft">
                              <select id="empresa" name="empresa" class="form-control selectpicker" data-live-search="true" required>
                                <option value="1">Corporacion Vasco SAC</option>
                                <option value="2">Industrias Vasquez SAC</option>
                                <option value="3">Jose Vasquez Cortez</option>
                              </select>
                            </div>

                            <div class="form-group col-lg-4 col-md-8 col-sm-8 col-xs-12">
                              <label>Modelo(*):</label>
                              <select id="cod_mod" name="cod_mod" class="form-control selectpicker" data-live-search="true" required>
                              </select>
                            </div>

                            <div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
                              <label>Color:</label>
                              <input type="text" class="form-control" name="color_mod" id="color_mod" placeholder="Color">
                            </div>

                            <div class="form-group col-lg-2 col-md-6 col-sm-6 col-xs-12">
                              <label>Tallas:</label>
                              <input type="text" class="form-control" name="tallas_mod" id="tallas_mod" placeholder="Tallas">
                            </div>

                            <div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
                              <label>Diseñado Por(*):</label>
                              <select id="id_trab" name="id_trab" class="form-control selectpicker" data-live-search="true" required>
                              </select>
                            </div>

                            <div class="form-group col-lg-4 col-md-6 col-sm-6 col-xs-12">
                              <label>División:</label>
                              <input type="text" class="form-control" name="div_mod" id="div_mod">
                            </div>

                            <div class="form-group col-lg-3 col-md-6 col-sm-6 col-xs-12">
                              <label>Temporada:</label>
                              <input type="text" class="form-control" name="temp_mod" id="temp_mod">
                            </div>

                            <div class="form-group col-lg-2 col-md-6 col-sm-6 col-xs-12">
                              <label>Destino:</label>
                              <input type="text" class="form-control" name="dest_mod" id="dest_mod">
                            </div>

                            <div class="form-group col-lg-4 col-md-12 col-sm-12 col-xs-12">
                              <label>1era Tela Principal:</label>
                            <select id="tela1_mod" name="tela1_mod" class="form-control selectpicker" data-live-search="true" required></select>
                            </div>

                            <div class="form-group col-lg-4 col-md-12 col-sm-12 col-xs-12">
                              <label>2da Tela Principal:</label>
                            <select id="tela2_mod" name="tela2_mod" class="form-control selectpicker" data-live-search="true" required></select>
                            </div>

                            <div class="form-group col-lg-4 col-md-12 col-sm-12 col-xs-12">
                              <label>Tela Complemento:</label>
                            <select id="tela3_mod" name="tela3_mod" class="form-control selectpicker" data-live-search="true" required></select>
                            </div>

                            <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                              <label>Bordado(*):</label>
                              <select name="bord_mod" id="bord_mod" class="form-control selectpicker" required="">
                                 <option value="0">NO</option>
                                 <option value="1">SI</option>
                              </select>
                            </div>

                            <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                              <label>Estampado(*):</label>
                              <select name="esta_mod" id="esta_mod" class="form-control selectpicker" required="">
                                 <option value="0">NO</option>
                                 <option value="1">SI</option>
                              </select>
                            </div>

                            <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                              <label>Manualidades(*):</label>
                              <select name="manu_mod" id="manu_mod" class="form-control selectpicker" required="">
                                 <option value="0">NO</option>
                                 <option value="1">SI</option>
                              </select>
                            </div>


                            <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                              <label>Hijo1:</label>
                              <input type="file" class="form-control" name="imagen" id="imagen">
                              <input type="hidden" name="imagenactual_imagen" id="imagenactual_imagen">
                              <img src="" width="150px" height="120px" id="imagen_muestra">
                            </div>


                           <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                             <label>Hij2:</label>
                             <input type="file" class="form-control" name="imagen2" id="imagen2">
                             <input type="hidden" name="imagenactual_imagen2" id="imagenactual_imagen2">
                             <img src="" width="150px" height="120px" id="imagen2_muestra">
                           </div>

                            <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-12">
                              <label>Fecha(*):</label>
                              <input type="date" class="form-control" name="fecha_hora" id="fecha_hora" >
                            </div>

                        </div>


                        <div class="form-group col-lg-3 col-md-4 col-sm-4 col-xs-12">
                          <label>Tabla de colores:</label>
                          <ul style="list-style: none; overflow: scroll; height: 500px;" id="colores">

                          </ul>
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

<script type="text/javascript" src="scripts/ft_hoja1.js"></script>
<?php
}
ob_end_flush();
?>
