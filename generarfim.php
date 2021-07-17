<?php
  function countSetBits($n) 
  {
    $count = 0;
    while ($n)
    {
      $n &= ($n - 1);
      $count++;
    }
    return $count;
  }
  function llenar0(&$matriz){
    for ($i=0;$i<15;$i++){
      for ($j=0;$j<7;$j++){
        $matriz[$i][$j]=0;
      }
    }
  }
  function aumentar(&$matriz,$nuevo){
    for ($i=0;$i<15;$i++){
      for ($j=0;$j<7;$j++){
          $matriz[$i][$j]=$matriz[$i][$j] + $nuevo[$i][$j];
          if($matriz[$i][$j]>1)
            return false;
      }
    }
    return true;
  }

  function imprime_color($color){

    switch ($color) {
      case 0:
        $bg = "#FF0000";
        break;
      case 1:
        $bg = "#6495ED";
        break;
      case 2:
        $bg = "#3CB371";
        break;
      case 3:
        $bg = "#F4A460";
        break;
      case 4:
        $bg = "#6B8E23";
        break;
      case 5:
        $bg = "#FF69B4";
        break;
      case 6:
        $bg = "#EEEECD";
        break;
      case 7:
        $bg = "#40E0D0";
        break;
      case 8:
        $bg = "#C0C0C0";
        break;
      case 9:
        $bg = "#DA70D6";
        break;
      case 10:
        $bg = "#00FFFF";
        break;
      case 11:
        $bg = "#DAA520";
        break;
      case 12:
        $bg = "#BC8F8F";
        break;
      case 13:
        $bg = "#FFA500";
        break;
      case 14:
        $bg = "#8A2BE2";
        break;
      default:
          $bg = "#FF0000";
    }

    echo "<td bgcolor='".$bg."'>";
  }

  function imprimir($secciones,$cursos,$nombre,$curso_secciones,$matriz_aulas,$_cruces)
  {
    llenar0($matriz);
    $horas_cruce = 0;
    $color = 0;
    $domingo = 0;
    for ($sel=0;$sel < count($secciones);$sel++){
      $nuevo = $cursos[$sel][$secciones[$sel]];
      for ($i=0;$i<15;$i++){
        for ($j=0;$j<7;$j++){
          if($nuevo[$i][$j]>0){
            if ($j == 6)
              $domingo = 1;
            //$matriz[$i][$j]=$matriz[$i][$j]+$sel+1;
            if ($matriz[$i][$j] != 0)
            {
              $n_curso = explode(".", $matriz[$i][$j]);
              
              $matriz[$i][$j] = "1.".$n_curso[1]."<br>".$nombre[$sel].' - '.$curso_secciones[$sel][$secciones[$sel]].'<br>'.$matriz_aulas[$sel][$secciones[$sel]][$i][$j];
              
              $horas_cruce++;
            }
            else
            {
              $matriz[$i][$j]=($sel+2).".".$nombre[$sel].' - '.$curso_secciones[$sel][$secciones[$sel]].'<br>'.$matriz_aulas[$sel][$secciones[$sel]][$i][$j];
            }
          } else {
            if ($sel==0)
              $matriz[$i][$j]=0;
          }
        }
      }
    }
    
    echo "<div class=\"row\"><div class=\"col-md-12\"><div class=\"box box-primary box-solid\"><div class=\"box-header with-border\">
    <h3 class=\"box-title\"><button class=\"btn btn-success\" onclick=\"printContent(".($GLOBALS['contador']+1).")\"><i class=\"fa fa-print\"></i></button> Opción ".($GLOBALS['contador']+1)." (";
    
    if ($horas_cruce)
    {
      echo $_cruces." cruce".($_cruces > 1 ? "s" : "").", ".$horas_cruce." hora".($horas_cruce > 1 ? "s" : "").")";
    }
    else
    {
      echo "Sin cruces)";
    }
    
    echo "</h3></div><div class=\"box-body\" id=\"".($GLOBALS['contador']+1)."\"><ul>";
    
    for ($i=0; $i < count($secciones);$i++)
    {
      echo "<li>".$nombre[$i]." - Sección ".$curso_secciones[$i][$secciones[$i]]."</li>";
    }
    //echo "1: ".$secciones[0]." 2: ".$secciones[1]." 3: ".$secciones[2]."<br>";//imprimir tablas
    
    if ($domingo) {
    ?></ul><table class="paleBlueRows" style="width:100%; font-size: 12px; text-align: center" border="1"><tr>
          <th bgcolor="#D1CCF4" style="width:4%" height="50">Horas</th>
          <th bgcolor="#D1CCF4" style="width:14%">Lunes</th>
          <th bgcolor="#D1CCF4" style="width:14%">Martes</th>
          <th bgcolor="#D1CCF4" style="width:14%">Miercoles</th>
          <th bgcolor="#D1CCF4" style="width:14%">Jueves</th>
          <th bgcolor="#D1CCF4" style="width:14%">Viernes</th>
          <th bgcolor="#D1CCF4" style="width:13%">Sábado</th>
          <th bgcolor="#D1CCF4" style="width:13%">Domingo</th>
    <?php
    } else {
    ?></ul><table class="paleBlueRows" style="width:100%; font-size: 12px; text-align: center" border="1"><tr>
          <th bgcolor="#D1CCF4" style="width:4%" height="50">Horas</th>
          <th bgcolor="#D1CCF4" style="width:16%">Lunes</th>
          <th bgcolor="#D1CCF4" style="width:16%">Martes</th>
          <th bgcolor="#D1CCF4" style="width:16%">Miercoles</th>
          <th bgcolor="#D1CCF4" style="width:16%">Jueves</th>
          <th bgcolor="#D1CCF4" style="width:16%">Viernes</th>
          <th bgcolor="#D1CCF4" style="width:16%">Sábado</th>
    <?php
    }
    
    for ($i=0;$i<15;$i++){
      echo "<tr height='35px'><th>".str_pad($i+7, 2, '0', STR_PAD_LEFT)."-".str_pad($i+8, 2, '0', STR_PAD_LEFT)."</th>";
      for ($j=0;$j<(6+$domingo);$j++){
          if ($matriz[$i][$j]!=0)
          {
            $n_curso = explode(".", $matriz[$i][$j]);
            
            imprime_color($n_curso[0] - 1);
            
            echo $n_curso[1]."</td>";
          }
          else
            echo "<td>";

      }
      echo "</tr>";
    }
    echo "</table></div></div></div></div>";
  }

    function correcto($seccion, $cursos, &$_cruces){
        llenar0($horario);
        $_cruces = 0;
        $setbits = 0;
        $makecruce = 0;
        /*if ($k==0){
          return true;
        }
		
        if($seccion[$k]>=count($cursos[$k]))
          return false;*/
	      
        for ($l=0; $l < $GLOBALS['num_cursos']; $l++) {
          for ($j=0;$j<7;$j++) {
            $makecruce = 0;
            for ($i=0;$i<15;$i++) {
              
              if ($cursos[$l][$seccion[$l]][$i][$j] == 0) {
                $makecruce = 0;
                continue;
              }
              
              if ($horario[$i][$j] == 0) /* no se hace cruce aqui */ {
                if ($cursos[$l][$seccion[$l]][$i][$j] == 2) /*es practica*/ {
                  $horario[$i][$j] = (1<<$l)|(1<<31); // marcado como practica
                }
                else {
                  $horario[$i][$j] = (1<<$l);
                }
                
                $makecruce = 0;
                continue;
              }
              
              // se genera un cruce...
              
              if ($GLOBALS['cruces'] == 1) /* cruces no permitidos */ {
                return false;
              }
              
              if ($cursos[$l][$seccion[$l]][$i][$j] == 2) /*es practica*/ {
                if ($horario[$i][$j] & (1<<31) /*ya habia uno con practica a esta hora*/) {
                  return false;
                }
                
                $horario[$i][$j] = $horario[$i][$j]|(1<<31); // marcado como practica
              }
              
              $horario[$i][$j] = $horario[$i][$j]|(1<<$l); // marcar esta hora
              
              if ($makecruce == 1 && ($horario[$i][$j] & $horario[$i-1][$j]) & ~(1<<$l)) /* ya se habia iniciado el mismo cruce en la hora anterior */ {
                $makecruce = 0;
              }
              else { /* inicia un cruce */
                $makecruce = 1;              
                $_cruces = $_cruces + 1;
                
                if ($_cruces == $GLOBALS['cruces']) /* se llego al limite de cruces */ {
                  return false;
                }
              }
            }
          }
        }
        
        return true;
    }

  // primera funcion
  function resultados(){
    $num_cursos = count($GLOBALS['nombres']);
    for ($i = 0; $i < $num_cursos; $i++)
    {
      //$GLOBALS['num_sec'][$i] = count($cursos[$i]);
      $secciones[$i] = -1;
    }

    $GLOBALS['contador'] = 0;

    probar($num_cursos - 1, $secciones);

    if ($GLOBALS['contador'] == 0) {//if($contador_posibilidades==0){
        echo "<h1><center>No hay horarios posibles :(</center></h1>";
        echo "<center><img src='http://i.pinimg.com/originals/06/c7/16/06c716a7eaf691cd57a476c240dc1f61.gif'></center></div>";
    }
  }
  
  function probar($curso_probar, $secciones)
  {
    $_cruces = 0;
	  if ($curso_probar == 0)
	  {
		  for ($i = 0; $i < $GLOBALS['num_sec'][0]; $i++)
		  {
			  $secciones[0] = $i;
			  if (correcto($secciones, $GLOBALS['cursos_horas'], $_cruces))
			  {
          imprimir($secciones, $GLOBALS['cursos_horas'], $GLOBALS['nombres'], $GLOBALS['cursos_secciones'], $GLOBALS['cursos_aulas'], $_cruces);
          $GLOBALS['contador']++;
			  }
		  }
	  }
	  else
	  {
		  for ($i = 0; $i < $GLOBALS['num_sec'][$curso_probar]; $i++)
		  {
			  $secciones[$curso_probar] = $i;
			  probar($curso_probar - 1, $secciones);
		  }
	  }
  }

  function llenar_matriz(&$matriz,$dia, $inicio, $fin, $teo){
    for($i=$inicio;$i<$fin;$i++)
        $matriz[$i-7][$dia]=$teo;
  }

  function leer($cadena, $aulas, $profes, &$matriz_horas, &$matriz_aulas/*, &$matriz_profes*/){
    //$cadena = "LU 10-12 MI 10-12 VI 08-10 (P) VI 13-15 (L)";
    //echo "<h2>Cadena que se esta leyendo: \"".$cadena."\"</h2><br><br>";
    $i=0;
    llenar0($matriz_horas);
    $len = strlen($cadena);
    
    $count = 0;
    $aulas = explode(" ", $aulas);
    $profes = explode(" ", $profes);
        
    while ($i<$len){
        if ($cadena[$i]=="L"&&$cadena[$i+1]=="U"){
            $dia = 0;
        }elseif ($cadena[$i]=="M"&&$cadena[$i+1]=="A") {
            $dia = 1;
        }elseif ($cadena[$i]=="M"&&$cadena[$i+1]=="I") {
            $dia = 2;
        }elseif ($cadena[$i]=="J"&&$cadena[$i+1]=="U") {
            $dia = 3;
        }elseif ($cadena[$i]=="V"&&$cadena[$i+1]=="I") {
            $dia = 4;
        }elseif ($cadena[$i]=="S"&&$cadena[$i+1]=="A") {
            $dia = 5;
        }elseif ($cadena[$i]=="D"&&$cadena[$i+1]=="O") {
            $dia = 6;
        }elseif ($cadena[$i]=="("&&$cadena[$i+2]==")") {
            $dia = -1;
            $i+=1;
        }elseif ($cadena[$i]=="("&&$cadena[$i+3]==")") {
            $dia = -1;
            $i+=2;
        }

        if($dia!=-1) {
          echo "<li>".$cadena[$i].$cadena[$i+1];
          $i+=3; //se adelanta a la hora inicial
          $inicio = $cadena[$i].$cadena[$i+1];
          $i+=3; //se adelanta a la hora final
          $fin = $cadena[$i].$cadena[$i+1];
          echo " ".$inicio."-".$fin;
          
          if (isset($cadena[$i+3]) && $cadena[$i+3]=="(" && ($cadena[$i+4]=="P" || $cadena[$i+4]=="L"))
          {
            echo " (".$cadena[$i+4].") - ".$profes[$count]."</li>";
            
            llenar_matriz($matriz_horas,$dia, $inicio, $fin, 2);
          }
          else
          {
            echo " - ".$profes[$count]."</li>";
            
            llenar_matriz($matriz_horas,$dia, $inicio, $fin, 1);
          }
          
          llenar_matriz($matriz_aulas,$dia, $inicio, $fin, $aulas[$count].' - '.$profes[$count]);
                      
          $count++;
        }
        $i+=3;
    }
  }
    
  function limpiar($elegidos) {
        $r=0;
        foreach ($elegidos as $e) {
            if(!(strpos($e,"'")===false))$r = 1;
            if(!(strpos($e,"<")===false))$r = 1;
            if(!(strpos($e,">")===false))$r = 1;
            if(!(strpos($e,"/")===false))$r = 1;
            if(!(strpos($e,"=")===false))$r = 1;
            if(!(strpos($e,"%")===false))$r = 1;
            if(!(strpos($e,"UNION")===false))$r = 1;
            if(!(strpos($e,"DROP")===false))$r = 1;
            if(!(strpos($e,"-")===false))$r = 1;
            if(!(strpos($e,"+")===false))$r = 1;
            if(!(strpos($e,"\"")===false))$r = 1;
            if(!(strpos($e,";")===false))$r = 1;
            if($e=="")$r=1;
            if($r == 1)break;
        }
        if($r == 1){
            header("Location: perro.html");
            return "";
        } else {
            return $elegidos;
        }
  }

  $current = 'Facultad de Mecánica';
  $current_tree = array('Generador');
  $tree = '';
  $title = 'Facultad de Mecánica';
?>
<?php
  include 'build/class/c_session.php';

  $ses = new Session();
  
  if (isset($_POST['reset']))
  {
    //unset($ses->selected);
    header("Location: index.php");
    die();
  }
  
  include 'db_connection.php';
  include 'c_connection.php';
  
  if(!isset($ses->selected))
  {
      header("Location: index.php");
      die();
  }
  
  $elegidos = $ses->selected;
  
  $elegidos = limpiar($elegidos);
  if($elegidos == "") {
      return 0;
  }
?>
<?php require($tree.'header.php'); //<body><div> ?>

  <div class="content-wrapper">
    
    <section class="content container-fluid">
    
    <div class="row">
        
        <div class="col-md-12">
          <div class="box box-success box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Cursos y secciones</h3>
            </div>
            <div class="box-body">
<?php
  $conn = new Connection($dbHost, $dbName, $dbUser, $dbPass);
  $conn::open();
  
  $cont_curso=0;
  $GLOBALS['num_cursos'] = count($elegidos);
  $GLOBALS['cruces'] = $ses->cruces;
  $creds = 0;
    
  for ($i=0; $i<$GLOBALS['num_cursos']; $i++){
    //cursos
    $sql = "SELECT seccion, cursos.nombre, horario, aulas, profes, creds FROM cursosfim LEFT JOIN cursos ON cursosfim.codigo = cursos.codigo where cursosfim.codigo = \"".$elegidos[$i]."\"";
    //echo $sql."<br>";
    $conn->query($sql);

    //secciones
    $sec=0;
    while ($row = $conn->fetch()) {
      
      if ($sec == 0) {
        echo $elegidos[$i]." - ".$row["nombre"]." (".$row["creds"]." crédito".($row["creds"] + 0 > 1 ? "s" : "").")<br><ul>";
        $creds += $row["creds"] + 0;
      }
      
      $nombres[$i] = $row["nombre"];
      $curso_secciones[$cont_curso][$sec] = $row["seccion"];
      echo "<li> Sección ".$row["seccion"].":<br><ul>";
      leer($row["horario"], $row["aulas"], $row["profes"], $curso_horas_temp[$sec], $curso_aulas_temp[$sec]/*, $curso_profes_temp[$sec]*/);
      echo "</ul></li>";
      $sec++;
    }
    
    if ($sec == 0) {
      continue;
    }
    
    echo '</ul>';

    $GLOBALS['num_sec'][$i] = $sec;
    
    $cursos_horas[$cont_curso]=$curso_horas_temp;
    $cursos_aulas[$cont_curso]=$curso_aulas_temp;
    //$cursos_profes[$cont_curso++]=$curso_profes_temp;
    
    $cont_curso++;
  }
  
	$GLOBALS['nombres'] = $nombres;
	$GLOBALS['cursos_horas'] = $cursos_horas;
	$GLOBALS['cursos_aulas'] = $cursos_aulas;
	//$GLOBALS['cursos_profes'] = $cursos_profes;
	$GLOBALS['cursos_secciones'] = $curso_secciones;
  
  echo 'Total de créditos elegidos: '.$creds.'.<br>';
  
  if ($GLOBALS['cruces'] > 1)
  {
    echo '<br>Nota: Las horas en rojo en los horarios indican cruces.<br>';
  }
  
  echo '<br>Para elegir otros cursos, presione: <form class="form-horizontal" method="post"><div class="form-group">
                  <label class="col-md-4 control-label" for="singlebutton"></label>
                  <div class="col-md-4">
                    <button type="submit" class="btn btn-warning" name="reset">Regresar</button>
                  </div>
                </div></form></div></div></div></div>';

  resultados();

?>
 </section>
</div>
  
<?php require($tree.'footer.php'); //</div>?>

<script type="text/javascript">
function printContent(id){
str=document.getElementById(id).innerHTML
newwin=window.open('','printwin','left=100,top=100,width=800,height=600')
newwin.document.write('<HTML>\n<HEAD>\n')
newwin.document.write('<style type="text\/css" media="print">@page { size: landscape; }<\/style>')
newwin.document.write('<link rel="stylesheet" href="<?php echo $tree; ?>bower_components\/font-awesome\/css\/font-awesome.min.css">\n')
newwin.document.write('<link rel="stylesheet" href="<?php echo $tree; ?>dist\/css\/AdminLTE.css">\n')
newwin.document.write('<link rel="stylesheet" href="https:\/\/fonts.googleapis.com\/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">\n')
newwin.document.write('<TITLE>Generador de Horarios GSINT-UNI - Opción ')
newwin.document.write(id)
newwin.document.write('</TITLE>\n<script>\n')
newwin.document.write('function print_win(){\n')
newwin.document.write('window.print();\n')
newwin.document.write('}\n')
newwin.document.write('<\/script>\n')
newwin.document.write('</HEAD>\n')
newwin.document.write('<BODY onload="print_win()">\n')
newwin.document.write(str)
newwin.document.write('<script src="<?php echo $tree; ?>bower_components\/bootstrap\/dist\/js\/bootstrap.min.js"><\/script>\n')
newwin.document.write('<script src="<?php echo $tree; ?>dist\/js\/adminlte.js"><\/script>\n')
newwin.document.write('</BODY>\n')
newwin.document.write('</HTML>\n')
newwin.document.close()
}
</script>
<!-- jQuery 3 -->
<script src="<?php echo $tree; ?>bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo $tree; ?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo $tree; ?>dist/js/adminlte.js"></script>

</body>
</html>
