$(function () {
  /* ==============================
    Drawer
  ============================== */
  $('.js-drawer').click(function () {
    $('body').toggleClass('is-drawerActive');
    console.log("押された");

    if ($(this).attr('aria-expanded') == 'false') {
      $(this).attr('aria-expanded', true);
    } else {
      $(this).attr('aria-expanded', false);
    }
  });
})
