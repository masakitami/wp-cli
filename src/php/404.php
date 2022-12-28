<?php get_template_part("header"); ?>

<main class="l-main -single">
  <header class="p-hero">
    <h1 class="p-hero__title">404 Not Found</h1>
  </header>
  <div class="l-contents -themeWhite">
    <div class="p-article">
      <div class="l-container -slim">
        <section class="p-article__body">
          <h2>お探しのページは、見つかりませんでした。</h2>
          <p>検索で見つかるかもしれません。</p>
          <?php get_search_form(); ?>
        </section>
      </div>
      <!-- /.l-container -->
    </div>
    <!-- /.l-article -->
  </div>
  <!-- /.l-contents -->
</main>

<?php get_template_part("footer"); ?>