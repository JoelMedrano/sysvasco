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
                          <h1 class="box-title">Trabajador 
                          <button class="btn btn-success" id="btnagregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Agregar</button> 
                          <button class="btn btn-success" id="btnagregar" onclick="mostrarformDatos(true)"><i class="fa fa-plus-circle"></i> Agregar</button>
                          <a href="../reportes/rptarticulos.php" target="_blank"><button class="btn btn-info">Reporte</button></a></h1>
                        <div class="box-tools pull-right">
                        </div>
                    </div>



                    <div class="panel-body" id="formularioregistrosDatos">
                        <form name="formularioDatos" id="formularioDatos" method="POST">

                        <div class="box-header with-border">
                           <!-- fila 1 -->
                           <div class="form-group  col-xs-12">
                                <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">Nom(*):</label>
                                <div class="col-lg-2">
                                   <input name="id_trab" id="id_trab">
                                   <input type="text" class="form-control" name="nom_trab" id="nom_trab"  required>
                                </div>
                                <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">Ap.Paterno(*):</label>
                                <div class="col-lg-2">
                                   <input type="text" class="form-control" name="apepat_trab" id="apepat_trab" required>
                                </div>
                                <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">Ap.Materno(*):</label>
                                <div class="col-lg-2">
                                   <input type="text" class="form-control" name="apemat_trab" id="apemat_trab"  required>
                                </div>
                                <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">Id.trabajador(*):</label>
                                <div class="col-lg-1">
                                </div>
                             
                                <?php 

                                  require_once "../modelos/Trabajador_Datos.php";

                                  $trabajador_datos= new Trabajador_Datos();

                                  $rsptac = $trabajador_datos->listarT();
                                  $regc=$rsptac->fetch_object();
                                  $id=$regc->id_trab;

                                  if ( $id==' ') {
                                      
                                      var_dump('hhhh');
                                  }
                                   else {

                                    var_dump($id);
                                   }

                                ?>



                           </div>


                           

                       </div>


                       <div class="form-group  col-xs-12">
                       </div>
                       <div class="form-group  col-xs-12">
                       </div>





                    <div class="form-group  col-xs-12">
                    </div>
                    <div class="form-group  col-xs-12">
                    </div>
                        


                    <div class="box-header with-border">


                        <!-- fila 1 -->
                           <div class="form-group  col-xs-12">
                                <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">Empresa1:</label>
                                <div class="col-lg-2">
                                <input type="text" class="form-control" name="num_doc_trab" id="num_doc_trab"  required>
                                </div>
                                <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">Cargo:</label>
                                <div class="col-lg-2">
                                <input type="text" class="form-control" name="num_tlf_dom" id="num_tlf_dom"  required>
                                </div>
                                <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">Jefe Inm:</label>
                                <div class="col-lg-2">
                                <input type="text" class="form-control" name="num_tlf_cel" id="num_tlf_cel"  required>
                                </div>
                                <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">Desde - Hasta</label>
                                <div class="col-lg-1">
                                <input type="text" class="form-control" name="email_trab" id="email_trab"  required>
                                </div>
                                <div class="col-lg-1">
                                <input type="text" class="form-control" name="email_trab" id="email_trab"  required>
                                </div>
                            </div>



                          <!-- fila 1 -->
                            <div class="form-group  col-xs-12">
                                <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">Empresa2:</label>
                                <div class="col-lg-2">
                                <input type="text" class="form-control" name="num_doc_trab" id="num_doc_trab"  required>
                                </div>
                                <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">Cargo:</label>
                                <div class="col-lg-2">
                                <input type="text" class="form-control" name="num_tlf_dom" id="num_tlf_dom"  required>
                                </div>
                                <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">Jefe Inm:</label>
                                <div class="col-lg-2">
                                <input type="text" class="form-control" name="num_tlf_cel" id="num_tlf_cel"  required>
                                </div>
                                <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">Desde - Hasta</label>
                                <div class="col-lg-1">
                                <input type="text" class="form-control" name="email_trab" id="email_trab"  required>
                                </div>
                                <div class="col-lg-1">
                                <input type="text" class="form-control" name="email_trab" id="email_trab"  required>
                                </div>

                            </div>



                            <!-- fila 1 -->
                            <div class="form-group  col-xs-12">
                                <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">Empresa3:</label>
                                <div class="col-lg-2">
                                <input type="text" class="form-control" name="num_doc_trab" id="num_doc_trab"  required>
                                </div>
                                <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">Cargo:</label>
                                <div class="col-lg-2">
                                <input type="text" class="form-control" name="num_tlf_dom" id="num_tlf_dom"  required>
                                </div>
                                <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">Jefe Inm:</label>
                                <div class="col-lg-2">
                                <input type="text" class="form-control" name="num_tlf_cel" id="num_tlf_cel"  required>
                                </div>
                                <label class="col-col-lg-1 col-md-1 col-sm-1 control-label">Desde - Hasta</label>
                                <div class="col-lg-1">
                                <input type="text" class="form-control" name="email_trab" id="email_trab"  required>
                                </div>
                                <div class="col-lg-1">
                                <input type="text" class="form-control" name="email_trab" id="email_trab"  required>
                                </div>
                             </div>

                    </div>


                    <div class="form-group  col-xs-12">
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
<script type="text/javascript" src="scripts/trabajador_datos.js"></script>
<?php 
}
ob_end_flush();
?>