<?php
include 'build/class/c_session.php';

$ses = new Session();

$current = 'Inicio';
$tree = '';
$title = 'Bienvenido';

unset($ses->available);
unset($ses->selected);
?>

<?php require($tree.'header.php'); //<body><div> ?>

  <?php require($tree.'sidebar.php'); ?>

  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $title; ?>
      </h1>
    </section>
    
    <section class="content container-fluid">
    
      <div class="row">
        
        <div class="col-md-6">
          <div class="box box-primary box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Bienvenido</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="box-body">
              Bienvenido al Generador de Horarios 2.0 de GSINT-UNI. Para comenzar, haca click en 'Generador' en el panel izquierdo y elija su facultad.<br><br><center>
              <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2FGSINT.UNI&tabs&width=340&height=130&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=false&appId" width="340" height="130" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe>
            </center></div>
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
<script src="<?php echo $tree; ?>dist/js/adminlte.js"></script>

</body>
</html>