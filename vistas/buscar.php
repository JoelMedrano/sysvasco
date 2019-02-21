<?php
  
      $buscar = $_POST['b'];
        
      if(!empty($buscar)) {
            buscar($buscar);
      }
        
      function buscar($b) {
            $con = mysql_connect('192.168.1.29','admin', 'vasco123');
            mysql_select_db('db_corpvasco', $con);
        
            $sql = mysql_query("SELECT c.cliente AS cod_cli,c.nombre_cliente AS nom_cli FROM clientesjf c WHERE c.cliente LIKE '%".$b."%' LIMIT 5" ,$con);
              
            $contar = @mysql_num_rows($sql);
              
            if($contar == 0){
                  echo "No se han encontrado resultados para '<b>".$b."</b>'.";
            }else{
              while($row=mysql_fetch_array($sql)){
                $cod_cli = $row['cod_cli'];
                $nom_cli = $row['nom_cli'];
                
                echo $cod_cli." - "."<b>".$nom_cli."</b>"."<br />";
            }
        }
  }
        
?>