<article class="c-media p-article">
  <div class="c-media__body">
    <?php if ( is_front_page() ) : ?>
    <h3 class="p-article__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
    <?php else : ?>
    <h2 class="p-article__title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
    <?php endif; ?>
    <!-- カテゴリ -->
    <?php the_category(); ?>
    <p class="p-article__text"><time datetime="<?php the_time(DATE_W3C);?>"
        class="p-article__time"><?php the_time(get_option('date_format')); ?></time>
    </p>
  </div>
  <figure class="c-media__thumbnail">
    <?php if(has_post_thumbnail()): ?>
    <?php the_post_thumbnail('dummy-thumbnail') ?>
    <?php else: ?>
    <img src="<?php echo esc_url(get_theme_file_uri());?>/assets/img/no-picture.png"
      srcset="<?php echo esc_url(get_theme_file_uri());?>/assets/img/no-picture.png, <?php echo esc_url(get_theme_file_uri());?>/assets/img/no-picture@2x.png 2x"
      alt="タイトル">
    <?php endif; ?>
  </figure>
  <!-- /.c-media__thumbnail -->
</article>