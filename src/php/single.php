<?php get_template_part("template-parts/header"); ?>

<?php while (have_posts()):  the_post(); ?>
<div class="l-contents">
  <div class="l-container">
    <main class="l-main">
      <div class="p-article">
        <header class="p-article__header">
          <h1 class="p-article__title -detail"><?php the_title(); ?></h1>
          <p class="p-article__text">閲覧数:<?php echo esc_html(get_post_meta($post->ID, '_post_views', true)); ?></p>


          <?php if (has_post_thumbnail()): ?>
          <figure class="p-article__eyecatch">
            <!-- <img src="assets/images/no-picture_single.png"
              srcset="assets/images/no-picture_single.png, assets/images/no-picture_single@2x.png 2x" alt=""> -->
            <?php the_post_thumbnail(); ?>
          </figure>
          <?php endif; ?>

          <p class="p-article__text"><time datetime="<?php the_time(DATE_W3C); ?>"
              class="p-article__time"><?php the_time(get_option('date_format')); ?></time></p>
          <?php the_category(); ?>
        </header>

        <section class="p-article__body">
          <?php the_content(); ?>
        </section>

        <footer class="p-article__footer">
          <p class="p-article__text"><?php the_tags(); ?></p>
          <section class="p-author">
            <h2 class="p-author__title">この記事を書いた人</h2>
            <p class="p-author__name"><?php the_author_posts_link(); ?></p>
          </section>
        </footer>

        <!-- ナビゲーション -->
        <?php
          $args=[
            'prev_text' => '前の記事<br>%title',
            'next_text' => '次の記事<br>%title',
          ];
    the_post_navigation($args);
    ?>

      </div>

      <p>テスト</p>

      <?php
    // カテゴリーIDを取得
    $categories =get_the_category();
    $cate_ids = [];

    foreach ($categories as $category) {
        $cate_ids[] = $category->term_id;
    }

    // このページの投稿IDを取得
    $current_page_id = get_the_id();

    $args = [
      'post__not_in' => [$current_page_id],
      'category__in' => $cate_ids,
      'post_per_page' => 4,
    ];

    $the_query = new WP_Query($args);

    ?>

      <?php if ($the_query->have_posts()): ?>
      <div class="c-grid -gutter p-articles">
        <?php while ($the_query->have_posts()): $the_query->the_post(); ?>
        <div class="c-grid__item -tab6Of12">
          <?php get_template_part('template-parts/content') ?>
        </div>
        <?php endwhile; ?>
        <!-- /.c-grid__item  -->
      </div>
      <?php else: ?>
      <p>関連する記事がありませんでした。</p>
      <!-- /.c-grid  -->
      <?php endif; ?>

      <?php
      if (comments_open() || get_comments_number()):
          comments_template();
      endif;
    ?>
    </main>
    <?php get_sidebar(); ?>
  </div>
  <!-- /.l-container -->
</div>
<!-- /.l-contents -->
<?php endwhile; ?>
<?php get_template_part("template-parts/footer"); ?>