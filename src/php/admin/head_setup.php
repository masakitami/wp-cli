<?php 

/* ======================================
  カスタムメニューの設定
======================================*/

function customMenu_setup() {
  /*
    カスタムメニュー
  ----------------------------------- */
  $locations = [
    'global' => 'pc用グローバルナビ',
    'global-drawer' => "スマホ用グローバルナビ",
    'footer-menu' => 'フッターメニュー',
  ];
  register_nav_menus($locations);

  /*
    カスタムメニューのidを削除
  ----------------------------------- */
  function remove_menu_id( $id ){
    return $id = array();
  }
  add_filter('nav_menu_item_id', 'remove_menu_id', 10);

  // /*
  //   カスタムメニューの入れ子のsub-menuクラスを変更
  // ----------------------------------- */
  // function new_submenu_class($menu) {    
  //   $menu = preg_replace('/ class="sub-menu"/','/ class="p-globalNav" data-nav-type = sub /',$menu);        
  //   return $menu;
  // }
  
  // add_filter('wp_nav_menu','new_submenu_class'); 

  /*
    カスタムメニューのliタグにクラスをつける。
    またメニューからcssを追加したら反映される。
  ----------------------------------- */
  function add_additional_class_on_li($classes, $item, $args){
     //$classes を空にする前にカスタムクラスを変数へ入れておく        
    if( !empty( $classes[0] ) ){
        $custom_class = esc_attr( $classes[0] );
    }
    
    $classes = [];
    
    if (isset($args->add_li_class)) {
    $classes['class']=$args->add_li_class;
    }

    // 先に変数に入れておいたカスタムクラス名を配列へ入れる
    if( !empty( $custom_class ) ){
        $classes[]=$custom_class;
    }
    
    return $classes;
  }
  
  add_filter('nav_menu_css_class', 'add_additional_class_on_li', 1, 3);

  /*
  カスタムメニューの入れ子のsub-menuクラスを変更と
  サブメニューの中にdivタグを入れる(cssで調整しやすいように)
  ----------------------------------- */
  class custom_walker_nav_menu extends Walker_Nav_Menu {
    function start_lvl(&$output, $depth = 1, $args = array()) {
      $output .= '<div class="c-dropDown__elem"><ul class="p-globalNav" data-nav-type="sub">';
    }
    function end_lvl(&$output, $depth = 0, $args = array()) {
      $output .= '</ul></div>';
    }
  }
  
  /*
  aタグにクラスをつけられるようにする
  ----------------------------------- */
function add_additional_class_on_a($classes, $item, $args){
  if (isset($args->add_li_class)) {
    $classes['class'] = $args->add_a_class;
  }
  return $classes;
  }
  add_filter('nav_menu_link_attributes', 'add_additional_class_on_a', 1, 3);
}

add_action('after_setup_theme', "customMenu_setup");


/*======================================
wp_headへの追加(adobeフォントなど)
======================================*/
function displayWebFont(){
  /*
  adobeFontの追加
  ----------------------------------- */
function adobeFont () { ?>
<script>
(function(d) {
  var config = {
      kitId: 'iac3ave',
      scriptTimeout: 3000,
      async: true
    },
    h = d.documentElement,
    t = setTimeout(function() {
      h.className = h.className.replace(/\bwf-loading\b/g, "") + " wf-inactive";
    }, config.scriptTimeout),
    tk = d.createElement("script"),
    f = false,
    s = d.getElementsByTagName("script")[0],
    a;
  h.className += " wf-loading";
  tk.src = 'https://use.typekit.net/' + config.kitId + '.js';
  tk.async = true;
  tk.onload = tk.onreadystatechange = function() {
    a = this.readyState;
    if (f || a && a != "complete" && a != "loaded") return;
    f = true;
    clearTimeout(t);
    try {
      Typekit.load(config)
    } catch (e) {}
  };
  s.parentNode.insertBefore(tk, s)
})(document);
</script>
<?php 
  };
adobeFont();

}

add_action('wp_head', 'displayWebFont');

/*======================================
  CSSスタイルの追加(Jqueryを先に読み込ませてmain.bundle.jsを読み込む)
======================================*/
function dummy_scripts() {
  /* css */
  wp_enqueue_style( 'dummy-common', get_theme_file_uri() .'/assets/css/common.css',array(), date('YmdGis', filemtime(get_template_directory().'/assets/css/common.css')));
  // wp_enqueue_style( 'google-font', 'https://fonts.googleapis.com/css?family=Noto+Sans+JP:400,700|Quicksand:400,700&display=swap&subset=japanese' );
  /* js */
  wp_enqueue_script( 'dummy-app', get_theme_file_uri() .'/assets/js/main.bundle.js', ['jquery'], '1.0.0', false );
}

add_action( 'wp_enqueue_scripts', 'dummy_scripts' );

/*======================================
  JSの追加
======================================*/
function scriptLoader($script, $handle, $src) {
if (is_admin()) {
return $script;
}
$script = sprintf('<script src="%s" type="text/javascript" defer=""></script>' . "\n", $src);
return $script;
}
add_filter('script_loader_tag', 'scriptLoader', 10, 5);

/*======================================
  ログインした時はheaderの高さを32pxとる(黒のメニューバー分の高さ)。
======================================*/

// javascriptで対応した。

// function setHeaderHeight () {
//   if ( is_admin_bar_showing() ) {
//     echo '<style type="text/css">header {margin-top: 32px;}</style>';
//   }
// }

// add_action('wp_head', 'setHeaderHeight');
?>