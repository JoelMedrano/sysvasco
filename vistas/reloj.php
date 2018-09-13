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
if ($_SESSION['reloj']==1)
{



$dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
 
$fecha=$dias[gmdate('w')]." ".gmdate('d')." de ".$meses[gmdate('n')-1]. " del ".gmdate('Y') ;







?>



                       <script language="JavaScript" type="text/javascript">
                           function show5(){
                                    if (!document.layers&&!document.all&&!document.getElementById)
                                    return

                                     var Digital=new Date()
                                     var hours=Digital.getHours()
                                     var minutes=Digital.getMinutes()
                                     var seconds=Digital.getSeconds()

                                    var dn="PM"
                                    if (hours<12)
                                    dn="AM"
                                    if (hours>12)
                                    hours=hours-12
                                    if (hours==0)
                                    hours=12

                                     if (minutes<=9)
                                     minutes="0"+minutes
                                     if (seconds<=9)
                                     seconds="0"+seconds
                                    //change font size here to your desire
                                    myclock=hours+":"+minutes+":"
                                     +seconds+" "+dn;
                                    if (document.layers){
                                    document.layers.liveclock.document.write(myclock)
                                    document.layers.liveclock.document.close()
                                    }
                                    else if (document.all)
                                    liveclock.innerHTML=myclock
                                    else if (document.getElementById)
                                    document.getElementById("liveclock").innerHTML=myclock
                                    setTimeout("show5()",1000)
                                 }


                                    window.onload=show5
                                     //-->
                          </script>









<!--Contenido-->
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">        
        <!-- Main content -->
        <section class="content">
            <div class="row">
              <div class="col-md-12">
                  <div class="box">
                    <div class="box-header with-border">
                          <h1 class="box-title">Marcador </h1>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <!-- centro -->
                   


                    <div class="panel-body" id="formularioregistros">
                        <form name="formulario" id="formulario" method="POST"   >
                         
                         
                        


                            <div class="panel-body">

                                  <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                                  </div>

                                  <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                           <div class="small-box bg-aqua">
                                               <div class="inner">
                                                  <h1 style="font-size:50px;  font:oblique bold 200% cursive; text-align:center; ">
                                                    <strong>Fecha Actual: <?php echo $fecha; ?></strong>
                                                  </h1>
                                               </div>
                                               <div class="icon">
                                                  <i class="ion"></i>
                                               </div>
                                               <a class="small-box-footer"></a>
                                           </div>
                                  </div>
                                    

                                  <div class="panel-body">
                                  </div>

                                  <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                                  </div>

                                  <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                       <div class="small-box bg-green">
                                          <div class="inner">
                                            <h1 style="font-size:50px;  font:oblique bold 200% cursive; text-align:center; ">
                                              <strong>  <span id="liveclock"></span></script></strong>
                                            </h1>
                                          </div>
                                          <div class="icon">
                                            <i class="ion"></i>
                                          </div>
                                          <a  class="small-box-footer"> </a>
                                        </div>
                                  </div>

                           </div>

                        

                            <div class="form-group  col-xs-12">

                                  <label class="col-col-lg-3 col-md-3 col-sm-3 control-label"></label>
                                  <div class="col-lg-2">
                                  </div>


                                  <div class="form-group col-lg-2 col-md-2 col-sm-2 col-xs-2"  align="pull-right"  style="background: url('../public/img/marcacion.jpg')">
                                   <br>
                                   <br>
                                   <br>
                                   <br>
                                   <br>
                                   <br>
                                   <br>
                                   <br>
                                 </div>

                               
                            </div>


                     


                           <div class="form-group  col-xs-12">


                                <div class="col-lg-4">
                                </div>

                                <label  class="col-col-lg-1 col-md-1 col-sm-1 control-label"  align="right"  >Codigo:</label>
                                <div class="col-lg-2">
                                   <input type="text" class="form-control" name="id_trab" id="id_trab"  required>
                                </div>


                              
                                <div class="col-lg-2">
                                  <button  type="text" align="center" id="btnGuardar"><i class="fa fa-save"></i> Guardar</button>
                                </div>

                               
                             
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
<script type="text/javascript" src="scripts/reloj.js"></script>
<?php 
}
ob_end_flush();
?>