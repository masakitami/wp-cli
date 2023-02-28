// Polyfill
import "intersection-observer";
import objectFitImages from "object-fit-images";
import closetPolyfill from "./lib/closet.polyfill";
objectFitImages();
closetPolyfill();

// wp用
import WpSetHeight from "./lib/wp/WpSetHeight";
new WpSetHeight();

import WpGlobalNav from "./lib/wp/WpGlobalNav";
new WpGlobalNav();

import Toc from "./lib/Toc";
new Toc();

import Test from "./lib/test";
new Test();

// Libraly
// import Loading from "./lib/Loading";
// import DropDown from "./lib/test";
// import $ from "jquery";
// import Swiper from 'swiper';
// import SmoothScroll from "smooth-scroll";
// import ScrollObserver from './lib/ScrollObserver';
// import Toggle from "./lib/Toggle";
// import Close from "./lib/Close";
// import Slider from "./lib/Slider";
// import { dropdown } from './lib/dropdown';
// import { inview } from './lib/inview';
// import MomentumScroll from "./lib/MomentumScroll";
// new MomentumScroll();
// new DropDown();

// new Loading();

// import {wpSetHeight} from './lib/wp/wpSetHeight';
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
