<?php
include 'build/class/c_session.php';

$ses = new Session();

$current = 'Facultad de Ciencias';
$current_tree = array('Generador');
$tree = '';
$title = 'Facultad de Ciencias';
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
          <div class="box box-warning box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Aviso</h3>
              
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="box-body">
              El generador para FC se encuentra en mantenimiento hasta nuevo aviso.
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