<?php
// $link = 0
// $link_with_icon = 1;
// $tree_start = 2;
// $tree_start_with_icon = 3;
// $tree_end = 3+n;
// $n = numero de trees a cerrar

// 0024612 exp

$items = array(
  array(1, "Inicio", "index.php", "fa-circle-o"),
  array(3, "Generador", "#", "fa-book"),
  array(0, "Facultad de Mecánica", "generadorfim.php"),
  array(4, "Facultad de Ciencias", "generadorfc.php")
);

?>

  <aside class="main-sidebar">
    <section class="sidebar">
      <ul class="sidebar-menu" data-widget="tree">
      
        <?php
        
        $tree_level = 0;
        $inside_tree = false;
        $checktree = (isset($current_tree));
        
        
        foreach ($items as $item)
        {
          $istreestart = ($item[0] == 2 || $item[0] == 3);
          $icon = ($item[0] == 1 || $item[0] == 3) ? $item[1] : "";
          $islink = (strpos($item[2], 'http') !== false);
          
          if ($checktree)
          {
            $active = false;
            
            if ($inside_tree > 0)
            {
              if ($item[1] == $current && $tree_level == $inside_tree) {
                $active = true;
                $checktree = false;
              }
            }
            else {
              for ($i = 0; $i <= $tree_level; $i++)
              {
                if ($tree_level < sizeof($current_tree) && $item[1] == $current_tree[$tree_level])
                {
                  $active = true;
                  if ($tree_level + 1 == sizeof($current_tree))
                  {
                    $inside_tree = $tree_level + 1;
                  }
                }
              }
            }
          }
          else
          {
            $active = ($item[1] == $current);
          }
        ?>
        
        <li class="<?php if ($active) { echo 'active '; } if ($istreestart) { echo 'treeview'; }?>">
          <a href="<?php if ($istreestart) { echo '#'; } else if ($active) { echo '#top'; } else { if (!$islink) { echo $tree; } echo $item[2]; }
          ?>"<?php if ($islink) { echo ' target="_blank"'; }?>><?php if ($icon != "") { echo '<i class="fa '.$item[3].'"></i> '; }?><span><?php echo $item[1];?></span><?php
          if ($istreestart) { $tree_level += 1;
          ?><span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span></a><ul class="treeview-menu"> <?php } else {?></a></li> <?php }
          
        for ($i = $item[0] - 3; $i > 0; $i--) { echo '</ul></li>'; $tree_level -= 1; } }?>
          
      </ul>
    </section>
  </aside>