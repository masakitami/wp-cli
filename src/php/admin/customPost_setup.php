<?php


/*======================================
  カスタム投稿タイプ
======================================*/
function post_type_init()
{
    /*
    制作実績のカスタム投稿タイプ
----------------------------------- */
    $labels=[
    'name'      => 'オススメ本',
    'all_items' => 'オススメ本の一覧',
    'add_new'   => '本の新規追加',
    'name_admin_bar' => '本の新規追加',
  ];

    $args = [
    'labels' => $labels,
    'description' => '本の一覧',
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
    'taxonomies' => ['book_type'],
  ];

    register_post_type('books', $args);

    /*
    カスタムタクソノミー
----------------------------------- */
    $labels = [
    'name' => '本のカテゴリー',
    'add_new_item' => '新しい本のカテゴリーを追加',
  ];

    $args = [
    'labels' => $labels,
    'description' => '本のカテゴリーを分類するためのタクソノミー',
    'show_admin_column' => true,
    'hierarchical' => true,
    'show_in_rest' => true,
  ];

    register_taxonomy('book_type', 'books', $args);

    /*
      カスタムタクソノミー（作業）
    ----------------------------------- */
    // $labels = [
    //   'name'         => '作業内容',
    //   'add_new_item' => '新しい作業内容を追加',
    // ];

    // $args = [
    //   'labels'            => $labels,
    //   'discription'       => '作業内容を分類するタクソノミー',
    //   'show_admin_column' => true,
    //   'hierarchical' => true,
    //   'show_in_rest'      => true
    // ];
    // register_taxonomy('work_contents', 'works', $args);
}

add_action('init', 'post_type_init');
