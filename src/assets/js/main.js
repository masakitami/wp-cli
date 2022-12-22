// Polyfill
import "intersection-observer";
import objectFitImages from "object-fit-images";
import closetPolyfill from "./lib/closet.polyfill";
objectFitImages();
closetPolyfill();

// Libraly
import Loading from "./lib/Loading";
// import $ from "jquery";
// import Swiper from 'swiper';
// import SmoothScroll from "smooth-scroll";
// import ScrollObserver from './lib/ScrollObserver';
// import Toggle from "./lib/Toggle";
// import Close from "./lib/Close";
// import Slider from "./lib/Slider";
// import { dropdown } from './lib/dropdown';
// import { inview } from './lib/inview';

new Loading();
// new SmoothScroll('a[href*="#"]');
// new Toggle(".js-drawer");

// WordPressの既存のjquery採用
jQuery(function ($) {
  /* ==============================
    Drawer
  ============================== */
  $(".js-drawer").click(function () {
    $("body").toggleClass("is-drawerActive");
    console.log("押された");

    if ($(this).attr("aria-expanded") == "false") {
      $(this).attr("aria-expanded", true);
    } else {
      $(this).attr("aria-expanded", false);
    }
  });
});
