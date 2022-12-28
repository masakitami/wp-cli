<!DOCTYPE html>
<html lang="ja" <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo("charset"); ?>" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="description" content="各ページ固有の説明文を124文字程度で" />
  <meta name="twitter:card" content="summary_large_image" />
  <meta name="twitter:site" content="【twitterのアカウント名】" />
  <meta property="og:url" content="【サイトURL】" />
  <meta property="og:type" content="website" />
  <meta property="og:title" content="【サイト名】 | 〇〇〇〇" />
  <meta property="og:description" content="各ページ固有の説明文を124文字程度で" />
  <meta property="og:site_name" content="【サイト名】" />
  <meta property="og:image" content="【サイトURL】OGP画像のファイルパス" />
  <meta property="og:locale" content="ja_JP" />
  <?php wp_head(); ?>
  <link rel="canonical" href="【サイトURL】/" />
  <link rel="shortcut icon" href="/favicon.ico" />
  <link rel="apple-touch-icon" href="/apple-touch-icon.png" />
  <link rel="author" href="/humans.txt" />
  <title>【サイト名】 | 〇〇〇〇</title>
  <!-- <script src="/assets/js/main.js" defer></script> -->
  <link rel="stylesheet" href="ee" />
</head>
<body <?php body_class(); ?>>
  <header class="l-header p-header">
    <div class="l-container">
      <div class="p-header__info">
        <h1 class="p-header__title"><a href="<?php echo esc_url(home_url()); ?>" class="p-logo"><?php bloginfo(
  "name"
); ?></a></h1>
        <p class="p-header__text"><?php bloginfo("description"); ?></p>
      </div>
      <!-- /.p-header__info -->
      <nav class="p-header__nav">
        <h2 class="screen-reader-text">サイト内メニュー</h2>
        <button class="js-drawer c-button p-hamburger" aria-controls="globalNav" aria-expanded="false">
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
          'add_li_class' => 'p-globalNav__list -normal',
          'add_a_class' => '' ,//
        ];
          wp_nav_menu($args);
        ?>
      </nav>
    </div>
    <!-- /.p-header__inner -->
  </header>