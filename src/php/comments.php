<?php  
  if(post_password_required()){
    return;
  }
?>

<section class="p-comments">
  <div class="p-comments__innter">
    <h2 class="p-comments__title">コメントとトラックバック</h2>

    <?php if(have_comments()):  ?>
    <ul class="p-comments__list">
      <?php  
        $args = [
          'avatar_size' => 160,
        ];

        wp_list_comments($args);

      ?>

    </ul>
    <?php endif; ?>

    <?php if(comments_open()): ?>
    <section class="p-comments__form">
      <?php comment_form(); ?>
    </section>
    <?php endif; ?>
  </div>
</section>