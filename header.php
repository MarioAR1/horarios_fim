<!DOCTYPE html>

<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Horarios GSINT-UNI | <?php echo $current; ?></title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=5, user-scalable=yes" name="viewport">
  
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
  <link rel="stylesheet" href="<?php echo $tree; ?>bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo $tree; ?>bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?php echo $tree; ?>bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="<?php echo $tree; ?>dist/css/AdminLTE.css">
  <link rel="stylesheet" href="<?php echo $tree; ?>dist/css/skins/skin-green-light.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition skin-green-light sidebar-collapse" style="min-width:1000px; _width: expression( document.body.clientWidth > 700 ? 700px : auto ); overflow-x:scroll;">