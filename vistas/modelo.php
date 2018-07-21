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
<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Administrar Modelos
    
    </h1>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarModelo">
          
          Agregar Modelo

        </button>

      </div>

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablas">
         
        <thead>
         
         <tr>
           
           	<th style="width:10px">#</th>
           	<th>Marca</th>
           	<th>Modelo</th>
			<th>Nombre</th>
			<th>Estado</th>
			<th>Tipo</th>
			<th>Linea</th>
			<th>Imagen</th>
			<th>Creacion</th>
			<th>Opciones</th>

         </tr> 

        </thead>

        <tbody>
          
          <tr>

            <td>1</td>

            <td>JACKYFORM</td>
            <td>10010</td>
            <td>TRUZA SPORT</td>
            <td><button class="btn btn-success btn-xs">Activo</button></td>
            <td>Truza</td>
            <td>020</td>
            <td><img src="../files/modelos/default/anonymous.png" class="img-thumbnail" width="40px"></td>
			<td>2018-07-20</td>
            <td>

              <div class="btn-group">
                  
                <button class="btn btn-warning"><i class="fa fa-pencil"></i></button>

                <button class="btn btn-danger"><i class="fa fa-times"></i></button>

              </div>  

            </td>

          </tr>

          <tr>

            <td>1</td>

            <td>JACKYFORM</td>
            <td>10010</td>
            <td>TRUZA SPORT</td>
            <td><button class="btn btn-danger btn-xs">Inactivo</button></td>
            <td>Truza</td>
            <td>020</td>
            <td><img src="../files/modelos/default/anonymous.png" class="img-thumbnail" width="40px"></td>
			<td>2018-07-20</td>
            <td>

              <div class="btn-group">
                  
                <button class="btn btn-warning"><i class="fa fa-pencil"></i></button>

                <button class="btn btn-danger"><i class="fa fa-times"></i></button>

              </div>  

            </td>

          </tr>

          <tr>

            <td>1</td>

            <td>JACKYFORM</td>
            <td>10010</td>
            <td>TRUZA SPORT</td>
            <td><button class="btn btn-success btn-xs">Activado</button></td>
            <td>Truza</td>
            <td>020</td>
            <td><img src="../files/modelos/default/anonymous.png" class="img-thumbnail" width="40px"></td>
			<td>2018-07-20</td>
            <td>

              <div class="btn-group">
                  
                <button class="btn btn-warning"><i class="fa fa-pencil"></i></button>

                <button class="btn btn-danger"><i class="fa fa-times"></i></button>

              </div>  

            </td>

          </tr>

          <tr>

            <td>1</td>

            <td>JACKYFORM</td>
            <td>10010</td>
            <td>TRUZA SPORT</td>
            <td><button class="btn btn-success btn-xs">Activado</button></td>
            <td>Truza</td>
            <td>020</td>
            <td><img src="../files/modelos/default/anonymous.png" class="img-thumbnail" width="40px"></td>
			<td>2018-07-20</td>
            <td>

              <div class="btn-group">
                  
                <button class="btn btn-warning"><i class="fa fa-pencil"></i></button>

                <button class="btn btn-danger"><i class="fa fa-times"></i></button>

              </div>  

            </td>

          </tr>                              


        </tbody>

       </table>

      </div>

    </div>

  </section>

</div>

<!--=====================================
MODAL AGREGAR USUARIO
======================================-->

<div id="modalAgregarModelo" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar Modelo</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL CODIGO INTERNO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-code"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoCodigo" placeholder="Ingresar código" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL CODIGO DEL MODELO -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-rocket"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoCodModelo" placeholder="Codigo del Modelo" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL NOMBRE DEL MODELO -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-lightbulb-o"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoNombre" placeholder="Ingresar Nombre" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL TIPO-->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-bullseye"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoTipo" placeholder="Ingresar Tipo" required>

              </div>

            </div>

            <!-- ENTRADA PARA LA LINEA -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-bullseye"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoLinea" placeholder="Ingresar Linea" required>

              </div>

            </div>

            <!-- ENTRADA PARA SELECCIONAR SU MARCA -->

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span> 

                <select class="form-control input-lg" name="nuevoPerfil">
                  
                  <option value="">Selecionar Marca</option>

                  <option value="JACKYFORM">JACKYFORM</option>

                  <option value="GUAPITAS">GUAPITAS</option>

                  <option value="VASCO">VASCO</option>

                  <option value="DLUBA">DLUBA</option>

                  
                </select>

              </div>

            </div>



            <!-- ENTRADA PARA LA DESCRIPCIÓN -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevaDescripcion" placeholder="Ingresar descripción" required>

              </div>

            </div>



            

            <!-- ENTRADA PARA SUBIR FOTO -->

             <div class="form-group">
              
              <div class="panel">SUBIR FOTO</div>

              <input type="file" id="nuevaFoto" name="nuevaFoto">

              <p class="help-block">Peso máximo de la foto 200 MB</p>

              <img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail" width="100px">

            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar usuario</button>

        </div>

      </form>

    </div>

  </div>

</div>

<?php
}
else
{
  require 'noacceso.php';
}
require 'footer.php';
?>
<script type="text/javascript" src="scripts/fichastecnicas.js"></script>
<?php 
}
ob_end_flush();
?>