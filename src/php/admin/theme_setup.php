<?php 

function base_setup(){
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
  add_image_size('base-thumbnail', 776, 549, true); // 投稿一覧用
  add_image_size('dummy-full', 1200, 400, true); // 固定ページ用

}

add_action('after_setup_theme', "base_setup");

/*======================================
  URLにauthor?1を入れたらIDがわかるのでリダイレクトする
======================================*/
function author_archive_redirect() {
  if( is_author() ) {
    wp_redirect( home_url());
    exit;
  }
}

add_action( 'template_redirect', 'author_archive_redirect' );

/*======================================
  X-Robots-Tagを利用して feed に noindexを付与する(サーチコンソールが無駄にfeedを読み込んでしまうため)
======================================*/
add_action('template_redirect', function(){
    if ( is_feed() && headers_sent() === false ) {
        header( 'X-Robots-Tag: noindex, follow', true );
    }
});

/*======================================
  「カテゴリー：」や「タグ：」のコロンを消すコード
======================================*/
function custom_archive_title($title){
    $titleParts=explode(': ',$title);
    if($titleParts[1]){
        return $titleParts[1];
    }
    return $title;
}
add_filter('get_the_archive_title','custom_archive_title');

/*======================================
  投稿アーカイブページの作成
======================================*/
function post_has_archive($args, $post_type ) {

	if ( 'post' == $post_type ) {
		$args['rewrite'] = true;
		$args['has_archive'] = 'blogs'; //任意のスラッグ名
	}
	return $args;
}
add_filter('register_post_type_args','post_has_archive',10,2);

/*======================================
  コンテンツ幅
======================================*/
if ( !isset( $content_width ) ) {
  $content_width = 776;
}

/*======================================
  スマホとタブレットとPCを分ける
======================================*/
function is_mobile() {
    $useragents = array(
        'iPhone',          // iPhone
        'iPod',            // iPod touch
        '^(?=.*Android)(?=.*Mobile)', // 1.5+ Android
        'dream',           // Pre 1.5 Android
        'CUPCAKE',         // 1.5+ Android
        'blackberry9500',  // Storm
        'blackberry9530',  // Storm
        'blackberry9520',  // Storm v2
        'blackberry9550',  // Storm v2
        'blackberry9800',  // Torch
        'webOS',           // Palm Pre Experimental
        'incognito',       // Other iPhone browser
        'webmate'          // Other iPhone browser
    );
    $pattern = '/'.implode('|', $useragents).'/i';
    return preg_match($pattern, $_SERVER['HTTP_USER_AGENT']);
}

add_action('wp_head', 'watchViews');

?>