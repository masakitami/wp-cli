<?php
    $args = [
      'theme_location' => 'global-drawer',
      'menu_class'     => 'p-drawer__list',
      'menu_id'        => 'globalNav',
      'container'      => false,
      'add_li_class' => 'p-drawer__item',
      'add_a_class' => 'p-drawer__anchor' ,
      'walker'  => new custom_walker_nav_menu // サブメニューの中にdivタグを入れる(head_setup.phpに記述)
    ];
    wp_nav_menu($args);
  ?>