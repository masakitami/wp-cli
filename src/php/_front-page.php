<?php get_template_part("template-parts/header"); ?>
<div class="l-container">
  <div class="-text" aria-hidden="true"></div>
  <div id="loader"></div>
</div>
<main class="l-main -single">
  <div class="p-hero" data-type="home">
    <figure class="p-hero__eyecatch">
      <img src="<?php echo esc_url(get_theme_file_uri());?>/assets/img/hero-image.jpg" alt="">
    </figure>
    <p class="l-spacer p-hero__title text-align" data-align="min:justify" data-py="min:2" data-mr="min:2">Hello. I'm
      Web Designer</p>
  </div>
  <section class="l-contents -themeWhite">
    <h2 class="c-heading -primary">Blog &amp; News</h2>
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
        echo "<p>投稿がありません</p>";
    endif; ?>
  </section>

  <?php
  if (true) {
      echo "yatta";
  } ?>

  <section class="l-contents -themeWhite">
    <h2 class="c-heading -primary">Blog &amp; News</h2>
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
        echo "<p>投稿がありません</p>";
    endif;?>
  </section>

  <section class="service">
    <div class="toc">
      <aside class="toc--index">
        <ul class="list">
          <li class="list--item">
            <svg width="40" height="40" viewBox="0 0 40 40" aria-hidden="true" class="svg js-toc--index--svg">
              <circle class="circle_border js-circle_border" />
              <circle cx="20" cy="20" r="3" fill="blue" />
            </svg>
            <p>サービス1</p>
          </li>
          <li class="list--item">
            <svg width="40" height="40" viewBox="0 0 40 40" aria-hidden="true" class="svg js-toc--index--svg">
              <circle class="circle_border js-circle_border" />
              <circle cx="20" cy="20" r="3" fill="blue" />
            </svg>
            <p>研修転移</p>
          </li>
          <li class="list--item">
            <svg width="40" height="40" viewBox="0 0 40 40" style="overflow:visible;" aria-hidden="true"
              class="svg js-toc--index--svg">
              <circle class="circle_border js-circle_border" />
              <circle cx="20" cy="20" r="3" fill="blue" />
            </svg>
            <p>研修転移</p>
          </li>
        </ul>
      </aside>

      <div class="toc--contents">
        <ul class="list">
          <li class="list--item js-toc--content">
            <p>
              <img src="<?php echo esc_url(get_theme_file_uri());?>/assets/img/hero-image.jpg" alt="">
            </p>
            <p>
              テストテストテストテストテストhuhuhuuuuuuuuuuuuuuuuuu
              テストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテスト
            </p>
          </li>

          <li class="list--item js-toc--content">
            <p>
              <img src="<?php echo esc_url(get_theme_file_uri());?>/assets/img/hero-image.jpg" alt="">
            </p>
            <p>
              テストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテスト
            </p>
          </li>

          <li class="list--item js-toc--content">
            <p>
              <img src="<?php echo esc_url(get_theme_file_uri());?>/assets/img/hero-image.jpg" alt="">
            </p>
            <p>
              テストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテストテスト
            </p>
          </li>
        </ul>
      </div>
    </div>
  </section>
  <!-- /.l-contents -->

  <section class="l-container">
    <ul class="l-grid">
      <li class="l-grid--item" data-col="lg:6" data-over="lg:left">
        <p>
          <img src="<?php echo esc_url(get_theme_file_uri());?>/assets/img/hero-image.jpg" alt="">
        </p>
      </li>
      <li class="l-grid--item" data-col="lg:6" data-row="lg:3" style="background:red;">testtesttest</li>
    </ul>
  </section>

  <div class="box">
    gsap
  </div>
</main>

<?php get_template_part("template-parts/footer"); ?>