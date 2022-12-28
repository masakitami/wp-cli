<?php 

/*======================================
  ウィジェットの有効化
======================================*/
function dummy_widgets_init() {
  /*
    サイドバー
  ----------------------------------- */
  $args = [
    'name'          => 'Sidebar',
    'id'            => 'sidebar',
    'before_widget' => '<aside id="%1$s" class="p-widget -light %2$s">',
    'after_widget'  => '</aside>',
    'before_title'  => '<h2 class="p-widget__title">',
  ];

  $footer = [
    'name'          => 'Footer',
    'id'            => 'footer',
    'before_widget' => '<div class="c-grid__item -tab4Of12"><aside id="%1$s" class="p-widget -dark %2$s">',
    'after_widget'  => '</aside></div>',
    'before_title'  => '<h2 class="p-widget__title">',
  ];

  
  register_sidebar($args);
  register_sidebar($footer);
}
add_action( 'widgets_init', 'dummy_widgets_init' );



?>