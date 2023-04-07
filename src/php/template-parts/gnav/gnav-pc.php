<nav class="p-header__nav">
  <h2 class="screen-reader-text">サイト内メニュー</h2>
  <button class="js-drawer c-button hamburger" type="button" aria-controls="globalNav" aria-expanded="false">
    <span class="p-hamburger__line">
      <span class="screen-reader-text">メニューを開閉</span>
    </span>
  </button>
  <?php
    $args = [
      'theme_location' => 'global',
      'menu_class'     => 'p-globalNav',
      'menu_id'        => 'globalNav',
      'container'      => false,
      'add_li_class' => 'p-globalNav__list',
      'add_a_class' => 'p-globalNav__anchor' ,
      'walker'  => new custom_walker_nav_menu() // サブメニューの中にdivタグを入れる(head_setup.phpに記述)
    ];
  wp_nav_menu($args);
  ?>
</nav>
<!-- p-header__nav -->
</div>
<!-- p-header__inner -->
<div class="c-dropDown" data-type="subMenu" id="js-subMenu"></div>