<?php get_template_part("header"); ?>
<main class="l-main">
  <?php get_template_part("template-parts/breadcrumb"); ?>
  <div class="l-container">
    <section class="p-articles">

      <h2 class="c-heading -primary" style="margin-top:100vh;">Blog &amp; News</h2>
      <?php
            if (have_posts()):
                while (have_posts()): the_post();
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
  </div>
</main>
<?php get_sidebar(); ?>


<?php get_template_part("footer"); ?>