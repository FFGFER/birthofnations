<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

echo "<h1>Alertas</h1>";


$alertas = sql2("SELECT * FROM alertas WHERE id_receptor='".$_SESSION['id_usuario']."' ORDER BY id_alerta DESC");

echo "<form id='borrar_alertas'><table style='text-align: center; width: 600px; margin-left: auto; margin-right: auto; padding: 5px;'><tr><th style='width: 100px'>Tipo</th><th style='width: 310px'>Alerta</th><th>Eliminar</th></tr>";

foreach ($alertas as $alerta) {
    
    switch ($alerta['tipo']) {
        case "1":
            echo "<tr><td>Amigo</td><td>";
            echo id2nick($alerta['id_emisor'])." quiere ser tu amigo. <a href='#'>Añadir a amigos</a></td>";
            echo "<td><input type='checkbox' name='alertas[]' value='".$alerta['id_alerta']."'/></td></tr>";
            
            break;
        case "2":
            echo "<tr><td>Trabajador</td><td>";
            echo id2nick($alerta['id_emisor'])." ahora trabaja en <b>".id2empresa($alerta['r1'])."</b></td>";
            echo "<td><input type='checkbox' name='alertas[]' value='".$alerta['id_alerta']."'/></td></tr>";
            
            break;           


        default:
            break;
    }
    

}


?>

</table>
</form>



<button id='eliminar'>Eliminar</button>



<script>

  $(document).ready(function() {
    $("#eliminar").button();
  });
  
  $('#eliminar').click(function() {
        
            $.post("/usuarios/delete_alerts.php", $("#borrar_alertas").serialize(),
    function(data){
                    alert(data);
                    window.location.reload();
                  } );

    });  
</script>
<?
//Ponemos todas las alertas como leidas
sql("UPDATE alertas SET leido='1' WHERE id_receptor='".$_SESSION['id_usuario']."'");
?>
