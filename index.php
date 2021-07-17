<?php
include 'build/class/c_session.php';

$ses = new Session();

$current = 'Facultad de Mecánica';
$current_tree = array('Generador');
$tree = '';
$title = 'Geneador de horarios FIM - UNI';

if (isset($_POST['cursos']))
{
  $ses->selected = $_POST['cursos'];
  $ses->secciones = $_POST['secciones'];
}

if (isset($_POST['setcursos']) && isset($ses->selected))
{
  header('Location: generarfim.php');
  die();
}
?>

<?php require($tree.'header.php'); //<body><div> ?>

  <div class="content-wrapper">
    <section class="content-header" style="text-align:center;">
      <h1>
        <?php echo $title; ?>
      </h1>
    </section>
    
    <section class="content container-fluid">
      
      <?php
	  
      if (isset($_POST['setcursos']))
      {
        echo '<div class="row">
        <div class="box box-danger box-solid">
          <div class="box-header with-border">
            <h3 class="box-title">Error</h3>
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
              </button>
            </div>
          </div>
          <div class="box-body">
            ¡No ha escogido sus cursos!
          </div>
        </div></div>';
      }
      else
      {
        $select_cursos = '';
      }
      
      if (isset($_POST['datos']) || isset($ses->selected))
      {
        if (!empty($_POST['esp'])) // hizo click en continuar
        {
          $esp = $_POST['esp'] + 0;
          
          if (!isset($ses->esp) || $ses->esp != $esp) // esto significa que ya habia hecho click antes pero ha cambiado algo, puede haber elegido cursos pero estos han cambiado!
          {
            $ses->esp = $esp;
            unset($ses->selected);
            unset($ses->secciones);
          }
        }
        else // regresa del generador
        {
          $esp = $ses->esp;
        }
        
        /*
        // Removido: Ahora todos estan en la malla 2020
        if (!empty($_POST['plan']))
        {
          $plan = $_POST['plan'] + 0;
          
          if (!isset($ses->plan) || $ses->plan != $plan)
          {
            $ses->plan = $plan;
            unset($ses->selected);
            unset($ses->secciones);
          }
        }
        else
        {
          $plan = $ses->plan;
        } */
        
        if (!empty($_POST['cruces']))
        {
          $cruces = $_POST['cruces'] + 0;
          
          // en este caso no necesitamos de-setear los cursos elegidos porque no han cambiado
          $ses->cruces = $cruces;
        }
        else
        {
          $cruces = $ses->cruces;
        }
        
        if (!is_int($esp) || $esp > 6 || $esp < 3 || $cruces < 1 || $cruces > 3)
        {
          require($tree.'perro.html');
          die();
        }
        
        include 'db_connection.php';
        include 'c_connection.php';

        $malla = 'ciclo'.strval($esp);
        /*if ($plan == 3) {
          $malla[0] = 'ciclo'.strval($esp)."1='";
          $malla[1] = "' OR ciclo".strval($esp)."2='";
        }
        else {
          $malla[0] = 'ciclo'.strval($esp).strval($plan)."='";
          $malla[1] = "";
        }*/
        
        $stmt = new Connection($dbHost, $dbName, $dbUser, $dbPass);
        $stmt::open();
        
        $select_cursos = '<div class="row">
            <div class="box box-primary box-solid">
              <div class="box-header with-border">
                <h3 class="box-title">Selección de cursos</h3>
              </div>
              <div class="box-body">A continuación, seleccione sus cursos:<br><form class="form-horizontal" method="post"><fieldset>';
        
        for ($i = 1; $i <= 10; $i++)
        {
          $select_cursos .= '<label><h1><small>Ciclo '.strval($i).'</small></h1></label><br>';
          //$stmt->query("SELECT codigo,nombre,creds FROM cursosfim WHERE ".$malla[0].strval($i).$malla[1].($malla[1] == "" ? "" : strval($i))."' GROUP BY codigo,nombre,creds ORDER BY codigo ASC");
          $stmt->query("SELECT cursos.codigo,cursos.nombre,creds FROM cursos INNER JOIN cursosfim ON cursos.codigo = cursosfim.codigo WHERE ".$malla."='".$i."' GROUP BY codigo,nombre,creds ORDER BY codigo ASC");
          while($row = $stmt->fetch())
          {
            $select_cursos .= "<label class=\"col-md-2 control-label\" for=\"cursos\"></label><label><input type=\"checkbox\" name=\"cursos[]\" value=\"".$row["codigo"]."\"".((isset($ses->selected) && in_array($row["codigo"], $ses->selected)) ? "checked=1" : "")."/> ".$row["codigo"].' - '.$row["nombre"]." (".$row["creds"]." crédito".($row["creds"] + 0 > 1 ? "s" : "").")</label><br>";
          }
        }
        
        $select_cursos .= '<h1><small>Electivos</small></h1>';
        //$stmt->query("SELECT codigo,nombre,creds FROM cursosfim WHERE ".$malla[0].strval($i).$malla[1].($malla[1] == "" ? "" : strval($i))."' GROUP BY codigo,nombre,creds ORDER BY codigo ASC");
        $stmt->query("SELECT cursos.codigo,cursos.nombre,creds FROM cursos INNER JOIN cursosfim ON cursos.codigo = cursosfim.codigo WHERE ".$malla."='11' GROUP BY codigo,nombre,creds ORDER BY codigo ASC");
        while($row = $stmt->fetch())
        {
          $select_cursos .= "<label class=\"col-md-2 control-label\" for=\"cursos\"></label><label><input type=\"checkbox\" name=\"cursos[]\" value=\"".$row["codigo"]."\"".((isset($ses->selected) && in_array($row["codigo"], $ses->selected)) ? "checked=1" : "")."/> ".$row["codigo"].' - '.$row["nombre"]." (".$row["creds"]." crédito".($row["creds"] + 0 > 1 ? "s" : "").")</label><br>";
        }
        
        $select_cursos .= '</fieldset><br>
                <label class="col-md-4 control-label" for="singlebutton"></label>
                <div class="col-md-4">
                  <button type="submit" class="btn btn-success" name="setcursos" value=1>¡Generar horarios!</button>
                </div>
              </div></div></div>';
        
        $ses->available = $select_cursos;
        
        unset($_POST['datos']);
      }
      else if (isset($ses->available))
      {
        $select_cursos = $ses->available;
      }
      ?>
    
      <div class="col-12 col-xl-8 col-lg-10 col-lg-offset-1 col-xl-offset-2">
        <div class="row">
          <div class="box box-primary box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Instrucciones</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="box-body">
              Para generar sus horarios, primero necesitamos algo de información. Por favor, elija las opciones que le correspondan y haga click en el botón <button type="button" class="btn btn-disabled">Continuar</button> en la parte inferior.
            </div>
          </div>
        </div>
              
        <div class="row">
          <div class="box box-primary box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Ingreso de datos</h3>
            </div>
            <div class="box-body">
              <form class="form-horizontal" method="post">
                <fieldset>
                
                <div class="form-group">
                  <label class="col-md-4 control-label" for="esp">¿Cuál es su especialidad?</label>
                  <div class="col-md-4">
                    <div class="radio">
                      <label for="3">
                        <input type="radio" name="esp" id="3" value="3"<?php if (!isset($ses->esp) || $ses->esp == 3){ echo ' checked="checkedh"'; }?>>
                        Mecánica
                      </label>
                    </div>
                    <div class="radio">
                      <label for="4">
                        <input type="radio" name="esp" id="4" value="4"<?php if ($ses->esp == 4){ echo ' checked="checkedh"'; }?>>
                        Mecánica-Eléctrica
                      </label>
                    </div>
                    <div class="radio">
                      <label for="5">
                        <input type="radio" name="esp" id="5" value="5"<?php if ($ses->esp == 5){ echo ' checked="checkedh"'; }?>>
                        Naval
                      </label>
                    </div>
                    <div class="radio">
                      <label for="6">
                        <input type="radio" name="esp" id="6" value="6"<?php if ($ses->esp == 6){ echo ' checked="checkedh"'; }?>>
                        Mecatrónica
                      </label>
                    </div>
                  </div>
                </div>
                
                <!-- Ahora todos estan con la misma malla. Yay! -->
                <?php /*
                <div class="form-group">
                  <label class="col-md-4 control-label" for="plan">¿A qué plan de estudios pertenece?</label>
                  <div class="col-md-4">
                    <div class="radio">
                      <label for="1">
                        <input type="radio" name="plan" id="1" value="1"<?php if (!isset($ses->plan) || $ses->plan == 1){ echo ' checked="checkedh"'; }?>>
                        2009 (Antigua malla)
                      </label>
                    </div>
                    <div class="radio">
                      <label for="2">
                        <input type="radio" name="plan" id="2" value="2"<?php if ($ses->plan == 2){ echo ' checked="checkedh"'; }?>>
                        2018 (Nueva malla)
                      </label>
                    </div>
                    <div class="radio">
                      <label for="0">
                        <input type="radio" name="plan" id="0" value="3"<?php if ($ses->plan == 3){ echo ' checked="checkedh"'; }?>>
                        Ambos (Caso especial)
                      </label>
                    </div>
                  </div>
                </div>
                */ ?>
                
                <div class="form-group">
                  <label class="col-md-4 control-label" for="cruces">¿Desear generar horarios con cruces?</label>
                  <div class="col-md-4">
                    <div class="radio">
                      <label for="7">
                        <input type="radio" name="cruces" id="7" value="1"<?php if (!isset($ses->cruces) || $ses->cruces == 1){ echo ' checked="checkedh"'; }?>>
                        Sin cruces
                      </label>
                    </div>
                    <div class="radio">
                      <label for="8">
                        <input type="radio" name="cruces" id="8" value="2"<?php if ($ses->cruces == 2){ echo ' checked="checkedh"'; }?>>
                        Máximo 1 cruce
                      </label>
                    </div>
                    <div class="radio">
                      <label for="9">
                        <input type="radio" name="cruces" id="9" value="3"<?php if ($ses->cruces == 3){ echo ' checked="checkedh"'; }?>>
                        Máximo 2 cruces o 1 triple cruce
                      </label>
                    </div>
                    <div class="radio"><b>
                      Nota: No se generarán horarios que incumplan el reglamento de matrícula.<br>
                    </b></div>
                  </div>
                </div>

                <div class="form-group">
                  <label class="col-md-4 control-label" for="singlebutton"></label>
                  <div class="col-md-4">
                    <button type="submit" class="btn btn-success" name="datos">Continuar</button>
                  </div>
                </div>

                </fieldset>
              </form>
            </div>
          </div>
        </div>
        <?php echo $select_cursos; ?>
        <div class="row">
          <div class="box box-primary box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Actualización</h3>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="box-body">
              La malla curricular está actualizada al 2020. Última actualización de los horarios: 23 de octubre de 2020 1:16 PM
            </div>
          </div>
        </div>
      </div>
      
    </section>
  </div>
  
<?php require($tree.'footer.php'); //</div>?>

<!-- jQuery 3 -->
<script src="<?php echo $tree; ?>bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo $tree; ?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo $tree; ?>dist/js/adminlte.min.js"></script>

</body>
</html>