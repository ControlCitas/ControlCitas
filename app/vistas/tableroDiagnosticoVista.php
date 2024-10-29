<?php include_once("encabezado.php"); ?>
<h1 class="text-center">
  <?php
  if (isset($datos["subtitulo"])) {
    print $datos["subtitulo"];
  }
  ?>
</h1>
<div class="card p-4 bg-light">
  <form enctype="multipart/form-data" action="<?php print RUTA; ?>tablero/modificaTratamiento/" method="POST">
    <input type="hidden" name="id" id="id" value="<?php print $datos['data']["id"];?>">

    <div class="form-group text-left">
      <h3>Paciente: <?php print $datos['data']['pacienteApellidos'].', '.$datos['data']['pacienteNombre']." (".$datos['data']["telefono"].")"; ?></h3>
    </div>
    <div class="form-group text-left">
      <h3>Doctor: <?php print $datos['data']['doctorNombre'].', '.$datos['data']['doctorApellidos'].' ('.$datos['data']['doctorPerfil'].')'; ?></h3>
    </div>

    <div class="form-group text-left">
      <h3>Fecha de la cita: 
        <?php
        print $datos['data']['fecha'].', '.$datos['data']['horario'];
        ?>
      </h3>
    </div>

    <div class="form-group text-left">
      <h3>Observación: <?php
        print $datos['data']['observacion'];
        ?></h3>
    </div>

    <div class="form-group text-left">
      <h3>Tratamiento/Diagnóstico:</h3>
      <textarea name="tratamiento" class="form-control text-left"><?php if(isset($datos['historial']['tratamiento'])){print trim($datos['historial']['tratamiento']);}else{print "";}?></textarea>
    </div>

     <div class="form-group text-left">
      <h3>Costo:</h3>
      <input type="text" name="costo" class="form-control text-left" value="<?php if(isset($datos['historial']['costo'])){print ltrim($datos['historial']['costo']);}else{print "";}?>"/>
    </div>

    <div class="form-group text-left">
      <h3>Fotos:</h3>
      <input type="file" name="archivos[]" class="form-control" multiple/>
    </div>

    <?php
    if (isset($datos["archivos"])) {
      print "<hr>";
      for ($i=0; $i < count($datos["archivos"]); $i++) {
        if ($datos['archivos'][$i]!="." && $datos['archivos'][$i]!="..") {
          print "<a href='".RUTA."tablero/foto/".$datos['data']["id"]."/".$datos['archivos'][$i]."'>";
          print "<img src='".RUTA."public/doc/".$datos['data']["id"]."/".$datos['archivos'][$i]."' ";
          print "class='img-responsive' style='height:100px;' ";
          print "alt='".$datos['archivos'][$i]."'/>";
          print "</a>";
        }
      }
      print "<hr>";
    }
    ?>

    <input type="submit" value="Modificar estado de la cita" class="btn btn-success">
    <a href="<?php print RUTA; ?>tablero" class="btn btn-info">Regresar</a>
  </form>
</div><!--card-->
<?php include_once("piepagina.php"); ?>