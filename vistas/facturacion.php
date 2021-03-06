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
                                <h1 class="box-title">Facturacion</h1>
                                <div class="box-tools pull-right">
                                </div>
                            </div>
                            <!-- /.box-header -->

                            <div class="panel-body">
                                <div class="form-group col-lg-4 col-md-12 col-sm-12 col-xs-12">
                                    <!-- centro -->
                                    <div class="panel-body" id="formularioregistros">
                                        <form name="formulario" id="formulario" method="POST">
                                            

                                            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">

                                                <div class="form-group col-lg-3 col-md-12 col-sm-12 col-xs-12">
                                                    <label>Pedido:</label>
                                                    <input type="hidden" name="idmov" id="idmov">
                                                    <input type="text" class="form-control" name="num_mov" id="num_mov" maxlength="50" placeholder="Documento">
                                                </div>

                                                <div class="form-group col-lg-3 col-md-12 col-sm-12 col-xs-12">
                                                    <label>Cliente:</label>
                                                    <input type="text" class="form-control" name="cod_cli" id="cod_cli" placeholder="Cliente" required>
                                                </div>

                                                <div class="form-group col-lg-6 col-md-12 col-sm-12 col-xs-12">
                                                    <label>Fecha(*):</label>
                                                    <input type="date" class="form-control" name="fecha_hora" id="fecha_hora" value="<?php echo date("Y-m-d"); ?>">
                                                </div>

                                                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                    <label>Nombre del Cliente:</label>
                                                    <div id="resultado"></div>
                                                </div>

                                                <div class="form-group col-lg-6 col-md-12 col-sm-12 col-xs-12">
                                                    <label>Vendedor:</label>
                                                    <select id="cod_ven" name="cod_ven" class="form-control selectpicker" data-live-search="true" required></select>
                                                </div>

                                                <div class="form-group col-lg-6 col-md-12 col-sm-12 col-xs-12">
                                                    <label>Almacen Origén:</label>
                                                    <select id="cod_alm" name="cod_alm" class="form-control selectpicker" data-live-search="true" required></select>
                                                </div>

                                            </div>

                                            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <div class="form-group col-lg-12 col-md-12 col-sm-6 col-xs-12">
                                                    <label>Articulo:</label>
                                                    <input type="text" class="form-control" name="articulo" id="articulo" maxlength="8"
                                                        placeholder="Articulo">
                                                </div>
                                            </div>

                                            <div>

                                            </div>

                                            <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <button class="btn btn-primary" type="submit" id="btnGuardar" onclick="listar()"><i class="fa fa-save"></i>
                                                    Guardar</button>

                                                <button class="btn btn-success" onclick="cancelarform()" type="button"><i class="fa fa-arrow-circle-left"></i>
                                                    Nuevo</button>

                                                <button class="btn btn-info" onclick="limpiarMR()" type="button"><i class="fa fa-refresh"></i>
                                                    Limpiar</button>
                                            </div>
                                        </form>
                                    </div>
                                    <!--Fin centro -->
                                </div>



                                <div class="form-group col-lg-8 col-md-12 col-sm-12 col-xs-12">
                                    <div class="panel-body table-responsive" id="listadoregistros">
                                        <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                                            <thead>
                                                <tr>
                                                    <th width="5%"></th>
                                                    <th width="5%"></th>
                                                    <th width="5%"></th>
                                                    <th width="15%"></th>
                                                    <th>S</th>
                                                    <th>M</th>
                                                    <th>L</th>
                                                    <th>XL</th>
                                                    <th>XXL</th>
                                                    <th>XS</th>
                                                    <th></th>
                                                    <th></th>
                                                    <th width="5%"></th>
                                                </tr>

                                                <tr>
                                                    <th width="5%"></th>
                                                    <th width="5%"></th>
                                                    <th width="5%"></th>
                                                    <th width="15%"></th>
                                                    <th>28</th>
                                                    <th>30</th>
                                                    <th>32</th>
                                                    <th>34</th>
                                                    <th>36</th>
                                                    <th>38</th>
                                                    <th>40</th>
                                                    <th>42</th>
                                                    <th width="5%"></th>
                                                </tr>

                                                <tr>
                                                    <th width="5%">Movimiento</th>
                                                    <th width="5%">Ven</th>
                                                    <th width="5%">Modelo</th>
                                                    <th width="15%">Color</th>
                                                    <th>3</th>
                                                    <th>4</th>
                                                    <th>6</th>
                                                    <th>8</th>
                                                    <th>5</th>
                                                    <th>12</th>
                                                    <th>14</th>
                                                    <th>16</th>
                                                    <th width="5%">SUBTOTAL</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                            </tbody>
                                            <tfoot>
                                                <th width="5%">Movimiento</th>
                                                <th width="5%">Ven</th>
                                                <th width="5%">Modelo</th>
                                                <th width="15%">Color</th>
                                                <th colspan="8">TALLAS</th>
                                                <th width="5%">TOTAL</th>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            
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

<script>
    $(document).ready(function(){
        var consulta;
        //hacemos focus al campo de búsqueda

                                                                                                     
        //comprobamos si se pulsa una tecla
        $("#cod_cli").keyup(function(e){
                                      
              //obtenemos el texto introducido en el campo de búsqueda
              consulta = $("#cod_cli").val();
              //hace la búsqueda                                                                                  
              $.ajax({
                    type: "POST",
                    url: "buscar.php",
                    data: "b="+consulta,
                    dataType: "html",
                    beforeSend: function(){
                    //imagen de carga
                    $("#resultado").html("<p align='center'><img src='../files/otros/ajax-loader.gif' /></p>");
                    },
                    error: function(){
                    alert("error petición ajax");
                    },
                    success: function(data){                                                    
                    $("#resultado").empty();
                    $("#resultado").append(data);                                                             
                    }
              });                                                                         
        });                                                     
});  
</script>

<script type="text/javascript" src="scripts/facturacion.js"></script>
<?php 
}
ob_end_flush();
?>


