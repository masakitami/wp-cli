<?php get_header(); ?>

<main class="l-main -single">
  <div class="p-hero -home">
    <figure class="p-hero__eyecatch">
      <img src="<?php echo esc_url(get_theme_file_uri());?>/assets/img/hero-image.jpg" alt="">
    </figure>
    <p class="p-hero__title">Hello. I'm Web Designer</p>
  </div>
  <section class="l-contents -themeWhite">
    <h2 class="c-heading -primary">Blog &amp; News</h2>
    <?php 
            if (have_posts()):
              while(have_posts()): the_post();
                get_template_part('template-parts/content');
              endwhile;
              //ページネーション
              $args = [
                'prev_text' => '<span class="screen-reader-text">前へ</span>',
                'next_text' => '<span class="screen-reader-text">次へ</span>',
              ];
              the_posts_pagination($args);
            else: 
        ?>
    <p>投稿がありません</p>
    <?php endif; ?>
  </section>
  <!-- /.l-contents -->
</main>


<?php get_footer(); ?>