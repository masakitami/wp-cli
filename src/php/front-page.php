<?php get_template_part("header"); ?>

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

    https://goo.gl/maps/6zJz46eNU5MkGS43A
  </section>
  <!-- /.l-contents -->
</main>

<iframe
  src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3228.119324958911!2d139.3964919152079!3d35.99295092042052!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6018d5c9a95aa961%3A0xecd0d6f889aa7d7!2z44CSMzU1LTAwNjQg5Z-8546J55yM5p2x5p2-5bGx5biC5q-b5aGa77yX77yV77yQ4oiS77yS77yZ!5e0!3m2!1sja!2sjp!4v1672215396152!5m2!1sja!2sjp"
  width="1200" height="450" style="border:0;" allowfullscreen="" loading="lazy"
  referrerpolicy="no-referrer-when-downgrade"></iframe>
<?php get_template_part("footer"); ?>