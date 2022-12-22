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