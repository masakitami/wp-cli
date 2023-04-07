  <?php if(!is_front_page()): ?>
  <div class="breadcrumb">
    <?php
    if(function_exists( 'yoast_breadcrumb' )){
      yoast_breadcrumb( '<p style="padding-top:200px;" id="breadcrumbs">', '</p>');
    }
    ?>
  </div>
  <?php endif; ?>