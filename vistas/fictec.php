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
      
      Administrar Fichas Técnicas
    
    </h1>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">

	  	<a href="crearfictec.php">
	        <button class="btn btn-primary">       
	          Agregar Ficha Técnica
	        </button>
		</a>
      </div>

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablas">
         
        <thead>
         
         <tr>
           
           <th style="width:10px">#</th>
           <th>Modelo</th>
           <th>Nombre</th>
           <th>Marca</th>
           <th>Costo MP</th>
           <th>Costo OP</th>
           <th>Usuario</th> 
           <th>Fecha</th>
           <th>Estado</th>
           <th>Acciones</th>

         </tr> 

        </thead>

        <tbody>
          
          <tr>

            <td>1</td>

            <td>10010</td>

            <td>TRUZA SPORT</td>

            <td>JACKYFORM</td>

            <td>1.733079</td>

            <td>0.23</td>

            <td>jmedrano</td>

            <td>2018-07-20</td>

            <td>ACTIVO</td>

            
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