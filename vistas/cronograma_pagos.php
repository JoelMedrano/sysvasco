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
                          <h1 class="box-title">Cronograma Pagos <button class="btn btn-success" id="btnagregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Agregar</button> <a href="../reportes/rptarticulos.php" target="_blank"><button class="btn btn-info">Reporte</button></a></h1>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                    <div class="panel-body table-responsive" id="listadoregistros">
                        <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                          <thead>
                            <th>-</th>
                            <th>Codigo</th>
                            <th>Año</th>
                            <th>Estado</th>
                            <th>Opciones</th>
                          </thead>
                          <tbody>                            
                          </tbody>
                          <tfoot>
                            <th>-</th>
                            <th>Codigo</th>
                            <th>Año</th>
                            <th>Estado</th>
                            <th>Opciones</th>
                          </tfoot>
                        </table>
                    </div>
                    <div class="panel-body" id="formularioregistros">
                        <form name="formulario" id="formulario" method="POST">
                          
                            <input type="hidden" name="id_ano" id="id_ano">
                            


                            <div class="form-group  col-xs-12">

                              <div class="form-group col-lg-1 col-md-1 col-sm-1 col-xs-12">
                              </div>

                              <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                <label>Enero - 1era Quincena :</label>
                                <input type="date" class="form-control" name="ene_quin1" id="ene_quin1" >
                              </div>
                              <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                <label>Enero - 2da Quincena :</label>
                                <input type="date" class="form-control" name="ene_quin2" id="ene_quin2" >
                              </div>



                              <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                              </div>


                              <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                <label>Julio - 1era Quincena :</label>
                                <input type="date" class="form-control" name="jul_quin1" id="jul_quin1" >
                              </div>
                              <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                <label>Julio - 2da Quincena :</label>
                                <input type="date" class="form-control" name="jul_quin2" id="jul_quin2" >
                              </div>



                              

                         </div>


                        <div class="form-group  col-xs-12">

                              <div class="form-group col-lg-1 col-md-1 col-sm-1 col-xs-12">
                              </div>

                              <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                <label>Febrero - 1era Quincena :</label>
                                <input type="date" class="form-control" name="feb_quin1" id="feb_quin1" >
                              </div>
                              <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                <label>Febrero - 2da Quincena :</label>
                                <input type="date" class="form-control" name="feb_quin2" id="feb_quin2" >
                              </div>

                              <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                              </div>


                              <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                <label>Agosto - 1era Quincena :</label>
                                <input type="date" class="form-control" name="ago_quin1" id="ago_quin1" >
                              </div>
                              <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                <label>Agosto - 2da Quincena :</label>
                                <input type="date" class="form-control" name="ago_quin2" id="ago_quin2" >
                              </div>

                              


                        </div>


                        <div class="form-group  col-xs-12">

                              <div class="form-group col-lg-1 col-md-1 col-sm-1 col-xs-12">
                              </div>


                              <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                <label>Marzo - 1era Quincena :</label>
                                <input type="date" class="form-control" name="mar_quin1" id="mar_quin1" >
                              </div>
                              <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                <label>Marzo - 2da Quincena :</label>
                                <input type="date" class="form-control" name="mar_quin2" id="mar_quin2" >
                              </div>

                              <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                              </div>


                              <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                <label>Setiembre - 1era Quincena :</label>
                                <input type="date" class="form-control" name="set_quin1" id="set_quin1" >
                              </div>
                              <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                <label>Setiembre - 2da Quincena :</label>
                                <input type="date" class="form-control" name="set_quin2" id="set_quin2" >
                              </div>

                             


                        </div>


                        <div class="form-group  col-xs-12">

                              <div class="form-group col-lg-1 col-md-1 col-sm-1 col-xs-12">
                              </div>

                              <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                <label>Abril - 1era Quincena :</label>
                                <input type="date" class="form-control" name="abr_quin1" id="abr_quin1" >
                              </div>
                              <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                <label>Abril - 2da Quincena :</label>
                                <input type="date" class="form-control" name="abr_quin2" id="abr_quin2" >
                              </div>


                              <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                              </div>


                               <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                <label>Octubre - 1era Quincena :</label>
                                <input type="date" class="form-control" name="oct_quin1" id="oct_quin1" >
                              </div>
                              <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                <label>Octubre - 2da Quincena :</label>
                                <input type="date" class="form-control" name="oct_quin2" id="oct_quin2" >
                              </div>


                             


                        </div>


                        <div class="form-group  col-xs-12">

                              <div class="form-group col-lg-1 col-md-1 col-sm-1 col-xs-12">
                              </div>

                              <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                <label>Mayo - 1era Quincena :</label>
                                <input type="date" class="form-control" name="may_quin1" id="may_quin1" >
                              </div>
                              <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                <label>Mayo - 2da Quincena :</label>
                                <input type="date" class="form-control" name="may_quin2" id="may_quin2" >
                              </div>


                              <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                              </div>


                               <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                <label>Noviembre - 1era Quincena :</label>
                                <input type="date" class="form-control" name="nov_quin1" id="nov_quin1" >
                              </div>
                              <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                <label>Noviembre - 2da Quincena :</label>
                                <input type="date" class="form-control" name="nov_quin2" id="nov_quin2" >
                              </div>



                        </div>


                        <div class="form-group  col-xs-12">

                              <div class="form-group col-lg-1 col-md-1 col-sm-1 col-xs-12">
                              </div>

                              <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                <label>Junio - 1era Quincena :</label>
                                <input type="date" class="form-control" name="jun_quin1" id="jun_quin1" >
                              </div>
                              <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                <label>Junio - 2da Quincena :</label>
                                <input type="date" class="form-control" name="jun_quin2" id="jun_quin2" >
                              </div>


                              <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                              </div>


                              <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                <label>Diciembre - 1era Quincena :</label>
                                <input type="date" class="form-control" name="dic_quin1" id="dic_quin1" >
                              </div>
                              <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                <label>Diciembre - 2da Quincena :</label>
                                <input type="date" class="form-control" name="dic_quin2" id="dic_quin2" >
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
<script type="text/javascript" src="scripts/cronograma_pagos.js"></script>
<?php 
}
ob_end_flush();
?>