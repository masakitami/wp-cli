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
</head>
<body <?php body_class(); ?>>
  <header class="l-header">
    <div class="l-container">
      <div class="p-header" id="js-header">
        <div class="p-header__inner">
          <div class="p-header__logo">
            <h1><a href="<?php echo esc_url(home_url()); ?>" alt="ロゴ">ロゴ</a></h1>
          </div>
          <!-- /.p-header__logo -->
          <?php get_template_part("template-parts/gnav/gnav-pc"); ?>
        </div>
        <!-- p-header -->
      </div>
      <!-- /.l-container-->
  </header>
  <div class="p-hamburger"></div>
  <nav class="p-drawer"><?php get_template_part("template-parts/gnav/gnav-sp"); ?></nav>
  <!-- /.l-header-->