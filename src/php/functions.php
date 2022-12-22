<?php 

/*======================================
  コンテンツ幅
======================================*/
if ( !isset( $content_width ) ) {
  $content_width = 776;
}

/* ======================================
  初期設定
======================================*/
function dummy_setup() {
  /*
    Titleタグ
  ----------------------------------- */
  add_theme_support( 'title-tag' );
  /*
  HTML5をサポート
　----------------------------------- */
  $args = [
  'search-form',
  'comment-form',
  'comment-list',
  'gallery',
  'caption'
  ];
  
  add_theme_support( 'html5', $args);
  /*
    アイキャッチ画像を追加
  ----------------------------------- */
  add_theme_support('post-thumbnails');
  // 画像サイズを追加
  set_post_thumbnail_size(776, 549, true); // 投稿ページ用
  add_image_size('dummy-thumbnail', 248, 175, true); // 投稿一覧用
  add_image_size('dummy-full', 1200, 400, true); // 固定ページ用

  /*
    カスタムメニュー
  ----------------------------------- */
  $locations = [
    'global' => 'Global Navigation'
  ];
  register_nav_menus($locations);
}

add_action('after_setup_theme', "dummy_setup");


/*======================================
  CSSスタイルの追加
======================================*/
function dummy_scripts() {
  /* css */
  wp_enqueue_style( 'dummy-common', get_theme_file_uri() .'/assets/css/common.css' );
  wp_enqueue_style( 'google-font', 'https://fonts.googleapis.com/css?family=Noto+Sans+JP:400,700|Quicksand:400,700&display=swap&subset=japanese' );
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

/*======================================
  カスタム投稿タイプ
======================================*/
function dummy_post_type_init(){
  /*
  制作実績のカスタム投稿タイプ
----------------------------------- */
  $labels=[
    'name'      => '制作実績',
    'all_items' => '制作実績一覧',
    'add_new'   => '新規追加よ💟',
    'name_admin_bar' => '新規追加よ〜〜',
  ];

  $args = [
    'labels' => $labels,
    'description' => '制作実績の一覧',
    'public' => true,
    'menu_position' => 5,
    'menu_icon' => 'dashicons-desktop',
    'supports'=> [
      'title',
      'editor',
      'thumbnail',
      'custom-fields',
    ],
    'has_archive' => true,
    'show_in_rest' => true,
    'taxonomies' => ['work_type'], 
  ];

  register_post_type('works', $args);

  /*
  カスタムタクソノミー
----------------------------------- */
  $labels = [
    'name' => '作品のタイプよん💟',
    'add_new_item' => '新しい作品のタイプを追加',
  ];
  
  $args = [
    'labels' => $labels,
    'description' => '作品の種類を分類するためのタクソノミー',
    'show_admin_column' => true,
    'hierarchical' => true,
    'show_in_rest' => true,
  ];

  register_taxonomy('work_type', 'works', $args);
  
  /*
    カスタムタクソノミー（作業）
  ----------------------------------- */
  $labels = [
    'name'         => '作業内容',
    'add_new_item' => '新しい作業内容を追加',
  ];

  $args = [
    'labels'            => $labels,
    'discription'       => '作業内容を分類するタクソノミー',
    'show_admin_column' => true,
    'hierarchical' => true,
    'show_in_rest'      => true
  ];
  register_taxonomy('work_contents', 'works', $args);
}

add_action('init', 'dummy_post_type_init');

/*======================================
  抜粋文を調整
======================================*/
/*
  文字数の変更
----------------------------------- */
function dummy_excerpt_length( $length ) {
  return 32;
}
add_filter( 'excerpt_length', 'dummy_excerpt_length', 999 );

/*
  省略時の文字変更
----------------------------------- */
function dummy_excerpt_more($more) {
  return '...';
}
add_filter('excerpt_more', 'dummy_excerpt_more');




/*======================================
  目次
======================================*/

function test (){
  $term = ['a'];
}

function add_index( $content ) {
if ( is_single() ) {
$pattern = '/<h[1-6]>(.+?)<\/h[1-6]>/s';
preg_match_all( $pattern, $content, $elements, PREG_SET_ORDER );

if ( count( $elements ) >= 1 ) {
$toc          = '';
$i            = 0;
$currentlevel = 0;
$id           = 'chapter-';

foreach ( $elements as $element ) {
$id           .= $i + 1;
$regex         = '/' . preg_quote( $element[0], '/' ) . '/su';
$replace_title = preg_replace( '/<(h[1-6])>(.+?)<\/(h[1-6])>/s', '<$1 id="' . $id . '">$2</$3>', $element[0], 1 );
$content       = preg_replace( $regex, $replace_title, $content, 1 );

if ( strpos( $element[0], '<h2' ) !== false ) {
$level = 1;
} elseif ( strpos( $element[0], '<h3' ) !== false ) {
$level = 2;
} elseif ( strpos( $element[0], '<h4' ) !== false ) {
$level = 3;
} elseif ( strpos( $element[0], '<h5' ) !== false ) {
$level = 4;
} elseif ( strpos( $element[0], '<h6' ) !== false ) {
$level = 5;
}

while ( $currentlevel < $level ) {
if ( 0 === $currentlevel ) {
$toc .= '<ol class="index__list">';
} else {
$toc .= '<ol class="index__list_child">';
}
$currentlevel++;
}

while ( $currentlevel > $level ) {
$toc .= '</li></ol>';
$currentlevel--;
}

// 目次の項目で使用する要素を指定
$toc .= '<li class="index__item"><a href="#' . $id . '" class="index__link">' . $element[1] . '</a>';
$i++;
$id = 'chapter-';
} // foreach

// 目次の最後の項目をどの要素から作成したかによりタグの閉じ方を変更
while ( $currentlevel > 0 ) {
$toc .= '</li></ol>';
$currentlevel--;
}

$index = '<div class="single__index index" id="toc"><div class="index__title">目次<button class="index__button">閉じる</button></div>' . $toc . '</div>';
$h2    = '/<h2.*?>/i';

if ( preg_match( $h2, $content, $h2s ) ) {
$content = preg_replace( $h2, $index . $h2s[0], $content, 1 );
}
}
}
return $content;
}
add_filter( 'the_content', 'add_index' );


/*======================================
閲覧数のカウント
======================================*/
function update_post_views() {
global $post; // $post にアクセスできるようにする

// 公開されている記事でかつ、個別投稿ページの場合
if ('publish' === get_post_status($post) && is_single()) {
// 現在の閲覧数を整数値で取得
$views = intval(get_post_meta($post->ID, '_post_views', true));

// 現在の閲覧数に「1」を加えた値で更新
update_post_meta($post->ID, '_post_views', ($views + 1));
}
}
add_action('wp_head', 'update_post_views');