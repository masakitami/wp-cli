<?php get_template_part("template-parts/header"); ?>
<?php while (have_posts()): the_post();?>
<main class="l-main -single" style="padding-top:100px">
  <?php get_template_part("template-parts/breadcrumb");?>
  <header class="p-hero">
    <h1 class="p-hero__title"><?php the_title(); ?></h1>
    <?php if (has_post_thumbnail()) : ?>
    <figure class="p-hero__eyecatch">
      <?php the_post_thumbnail('dummy-full'); ?>
    </figure>
    <?php endif; ?>
  </header>
  <div class="l-contents -themeWhite" style="margin-bottom:100vh;">
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
  <div class="l-contents -themeWhite" style="margin-bottom:100vh;">
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
  <section id="section01">
    <h3>ここからsection01です.page.phpです</h3>
    <a href="<?php echo home_url()?>#test01">アンカーリンクです</a>
  </section>
</main>
<?php endwhile; ?>

<?php get_template_part("footer"); ?>