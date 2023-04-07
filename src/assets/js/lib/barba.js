import barba from "@barba/core";
import Toc from "./Toc";
import Test from "./Test";
import Loading2 from "./Loading2";
import WpGlobalNav from "./wp/WpGlobalNav";
import WpSetHeight from "./wp/WpSetHeight";

export default class barbaAnimation {
  constructor() {
    this.loading = new Loading2();
    this.preventSetting = (e) => {
      console.log("eを=======", e);
      // アンカーリンクであり同一ページでなければbarbaを有効に。基本はpreventがtrueでアンカーポイント遷移先のページにスクロールしない(つまりpreventがデフォルトでtrueだからfalseにする)
      let url = location.protocol + "//" + location.host + location.pathname;
      let extract_hash = e.href.replace(/#.*$/, "");
      if (e.href.startsWith(location.protocol + "//" + location.host)) {
        if (e.href.indexOf("#") > -1 && extract_hash != url) {
          return false;
        }
      }

      console.log("eのイベント=======", e.event);
      this.test = e.el;
      // 拡張子が該当する場合はtarget="_blank"に
      if (/\.(xlsx?|docx?|pptx?|pdf|jpe?g|png|gif|svg)/.test(e.href.toLowerCase())) {
        e.el.setAttribute("target", "_blank");
        return true;
      }

      // barbaのリンクとして実行させたくない場合の処理
      // wpadminbarの管理画面にちゃんと行くためのボタン
      if (e.el.classList.contains("ab-item")) {
        // e.el.setAttribute("target", "_blank");
        return true;
      }
    };

    this._init();
  }

  _addTargetBlankToExternalLink() {
    // 一応、外部ドメインはtarget = "_blank"の設定をする
    //ページのドメインを取得
    const domain = location.hostname;
    //取得したドメインを検証対象に指定
    const regexp = new RegExp(domain);

    //特定の要素内に存在するa要素が対象
    const elements = document.getElementsByTagName("a");

    for (let element of elements) {
      //a要素のhref（リンク）を取得
      let href = element.getAttribute("href");

      //a要素のhref（リンク）にドメインが含まれていなければ
      if (!regexp.test(href)) {
        //a要素にtarget="_blank"を追加する
        element.setAttribute("target", "_blank");
        //a要素にrel="noopener noreferrer"を追加する
        element.setAttribute("rel", "noopener noreferrer");
      }
    }
  }

  _anchorScroll() {
    if (location.hash) {
      const targetElement = document.querySelector(location.hash);
      if (targetElement) {
        const targetOffsetTop = window.pageYOffset + targetElement.getBoundingClientRect().top;

        window.scrollTo({
          top: targetOffsetTop,
          behavior: "smooth",
        });
      } else {
        window.scrollTo({
          top: 0,
          behavior: "instant",
        });
      }
    } else {
      window.scrollTo({
        top: 0,
        behavior: "instant",
      });
    }
  }

  _googleTag() {
    if (typeof ga === "function") {
      ga("set", "page", window.location.pathname);
      ga("send", "pageview");
    }

    if (typeof gtag === "function") {
      gtag("config", window.GA_MEASUREMENT_ID, {
        page_path: window.location.pathname,
      });
    }
  }

  _init() {
    barba.hooks.once(new Test());
    // 最初のオープニングはbeforeEnterから始まる。beforeEnterの状態から準備する。beforeはA→BのAのこと。最初のオープニングはAがないからbeforeEnterになる
    barba.hooks.beforeLeave(() => {
      Array.from(document.querySelectorAll(".blue")).forEach((el) => el.classList.remove("blue"));
    });
    barba.hooks.beforeEnter(this._addTargetBlankToExternalLink.bind(this));
    barba.hooks.enter(this._anchorScroll.bind(this));
    barba.hooks.after(this._googleTag());
    barba.hooks.enter(() => {
      let url = location.href;
      const trimmedUrl = url.replace(/^(http:|https:)/i, "");
      Array.from(document.querySelectorAll(`a[href="${trimmedUrl}"]`)).forEach((el) => {
        el.classList.add("blue");
      });
    });

    barba.init({
      preventRunning: true,
      prevent: this.preventSetting,
      sync: true,
      transitions: [
        {
          async leave(e) {
            const done = this.async();
            const openingAnimation = new Loading2();
            openingAnimation._leaveAnimation();
            openingAnimation._pageTransition();
            await openingAnimation._delay(1000);
            await document.querySelectorAll(".blue").forEach((dom) => dom.classList.remove("blue"));
            done();
          },
          async enter(e) {
            const done = this.async();
            const openingAnimation = new Loading2();
            await e.trigger.classList.add("blue");
            await openingAnimation._delay(600);
            openingAnimation._enterAnimation();
            done();
          },
        },
      ],
      views: [
        {
          namespace: "home",
          beforeEnter() {
            new Toc();
          },
        },
      ],
    });
  }
}
