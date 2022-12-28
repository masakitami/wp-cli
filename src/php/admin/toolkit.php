<?php 

/*======================================
  抜粋文を調整
======================================*/
/*
  文字数の変更
----------------------------------- */
function dummy_excerpt_length( $length ) {
  return 16;
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
  ブログタイトルで20文字を超えたら...にする
======================================*/
function adjust_title($post){
  if(mb_strlen($post->post_title)>28) {
    $title= mb_substr($post->post_title,0,28) ;
      echo $title . '...';
  } else {
      echo $post->post_title;
  }
}


/*======================================
  View数カウント
======================================*/
function watchViews(){

  /*
  view数の表示
  ----------------------------------- */
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

  update_post_views();

}

?>