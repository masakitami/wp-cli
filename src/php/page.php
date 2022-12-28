<?php get_header(); ?>


<?php while(have_posts()): the_post();?>
<main class="l-main -single">
  <header class="p-hero">
    <h1 class="p-hero__title"><?php the_title(); ?></h1>
    <?php if ( has_post_thumbnail()) : ?>
    <figure class="p-hero__eyecatch">
      <?php the_post_thumbnail( 'dummy-full' ); ?>
    </figure>
    <?php endif; ?>
  </header>
  <div class="l-contents -themeWhite">
    <div class="p-article">
      <div class="l-container -slim">
        <section class="p-article__body">
          <?php the_content(); ?>
        </section>
      </div>
      <!-- /.l-container -->
    </div>
    <!-- /.l-article -->
  </div>
  <!-- /.l-contents -->
</main>
<?php endwhile; ?>

<?php get_footer(); ?>