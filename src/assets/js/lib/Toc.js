export default class Toc {
  constructor() {
    this.DOM = {
      svg: document.querySelectorAll(".p-toc-index__svg"),
      border: document.querySelectorAll(".js-circle_border"),
      contents: document.querySelectorAll(".js-toc--content"),
    };

    this.test = null;

    // is-drawerActiveになったDropDownElemのDOMを毎度ホバー時に格納
    this.previousSubMenu = null;

    console.log("取得", this.DOM.svg);
    console.log("取得", this.DOM.border);

    this._init();
  }

  _intersect(entries) {
    console.log("entriesは", entries);
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        console.log("交差した", entry.target.getAttribute("data-toggle"));
        let activeCircle = document.getElementById(entry.target.getAttribute("data-toggle"));
        activeCircle.style.setProperty("--stroke-dashoffset", 0);
      } else {
        console.log("交差から外れた", entry.target.getAttribute("data-toggle"));
        let inactiveCircle = document.getElementById(entry.target.getAttribute("data-toggle"));
        inactiveCircle.style.setProperty("--stroke-dashoffset", inactiveCircle.getTotalLength());
      }
    });
  }

  _watch() {
    // 範囲の設定
    const options = {
      root: null,
      rootMargin: "-50% 0px",
      threshold: 0,
    };

    const observer = new IntersectionObserver(this._intersect, options);

    Array.from(this.DOM.contents).forEach((el) => {
      observer.observe(el);
    });
  }

  _init() {
    console.log("init実行");
    Array.from(this.DOM.svg).forEach((el, index) => {
      console.log("elは", el);
      el.setAttribute("id", "js-index-" + index);
    });

    Array.from(this.DOM.border).forEach((el, index) => {
      console.log("elは", el);
      el.setAttribute("data-toggle", "js-content-index-" + index);
      el.setAttribute("id", "js-border-index-" + index);
      let circlePath = el.getTotalLength();
      el.style.setProperty("--stroke-dasharray", circlePath);
      el.style.setProperty("--stroke-dashoffset", circlePath);
    });

    Array.from(this.DOM.contents).forEach((el, index) => {
      el.setAttribute("data-toggle", "js-border-index-" + index);
    });

    this._watch();
  }
}
