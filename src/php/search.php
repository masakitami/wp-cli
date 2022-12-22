<?php get_header(); ?>

<div class="l-contents">
  <div class="l-container">
    <main class="l-main">
      <div class="p-articles">

        <h1 class="c-heading -primary"><?php the_search_query(); ?> の検索結果</h1>

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
        <p>見つかりませんでした。</p>
        <?php endif; ?>

      </div>
    </main>
    <?php get_sidebar(); ?>

    <!-- /.l-sub -->
  </div>
  <!-- /.l-container -->
</div>
<!-- /.l-contents -->

<?php get_footer(); ?>