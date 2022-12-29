<?php get_template_part("header"); ?>
<main class="l-main -single">
  <header class="p-hero">
    <h1 class="p-hero__title"><?php post_type_archive_title(); ?></h1>
  </header>
  <section class="l-contents">
    <div class="l-container">

      <?php if ( have_posts() ) :?>
      <div class="c-grid -gutter">
        <?php while( have_posts() ) : the_post(); ?>
        <article class="c-grid__item -tab4Of12 -lap3Of12">
          <a href="<?php the_permalink(); ?>" class="c-card p-project">
            <div class="c-card__body">
              <h2 class="p-project__title"><?php the_title(); ?></h2>
              <p class="p-project__text">
                <?php the_excerpt(); ?>
              </p>
              <!-- /.p-project__text -->
            </div>
            <!-- /.c-card__body -->
            <figure class="c-card__thumbnail">
              <?php if ( has_post_thumbnail() ) : ?>
              <?php the_post_thumbnail() ?>
              <?php else : ?>
              <img src="<?php echo esc_url(get_theme_file_uri()); ?>/assets/images/no-picture_single.png"
                srcset="<?php echo esc_url(get_theme_file_uri()); ?>/assets/images/no-picture_single.png, <?php echo esc_url(get_theme_file_uri()); ?>/assets/images/no-picture_single@2x.png 2x"
                alt="アイキャッチ画像はありません">
              <?php endif; ?>
            </figure>
            <!-- /.c-card__thumbnail -->
          </a>
        </article>
        <?php endwhile; ?>
      </div>
      <!-- /.c-grid -->

      <?php
        // ページネーション
        $args = [
      'prev_text' => '<span class="screen-reader-text">前へ</span>',
      'next_text' => '<span class="screen-reader-text">次へ</span>'
    ];
    the_posts_pagination( $args );
  ?>

      <?php else : ?>

      <p>投稿がありません。</p>

      <?php endif; ?>


    </div>
    <!-- /.l-container -->
  </section>
  <!-- /.l-contents -->
</main>

<?php get_template_part("footer"); ?>