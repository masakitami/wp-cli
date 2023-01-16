export default class WpGlobalNav {
  constructor() {
    this.DOM = {
      header: document.querySelector("#js-header"),
      DropDownTrigger: null,
      DropDownParent: document.querySelector("#js-subMenu"),
      DropDownElem: document.querySelectorAll(".c-dropDown__elem"),
    };

    // is-drawerActiveになったDropDownElemのDOMを毎度ホバー時に格納
    this.previousSubMenu = null;

    this._init();
  }

  // _device() {
  //   if (
  //     this.ua.indexOf("iPhone") > 0 ||
  //     this.ua.indexOf("iPod") > 0 ||
  //     (this.ua.indexOf("Android") > 0 && this.ua.indexOf("Mobile") > 0)
  //   ) {
  //     return (this.device = "mobile");
  //   } else if (this.ua.indexOf("iPad") > 0 || this.ua.indexOf("Android") > 0) {
  //     return (this.device = "tablet");
  //   } else if (window.matchMedia && window.matchMedia("(max-width:1920px)").matches) {
  //     return (this.device = "desktop");
  //   } else {
  //     return (this.device = "desktop");
  //   }
  // }

  _confirmAndSet() {
    if (this.DOM.header === null) {
      return;
    }

    if (this.DOM.DropDownParent === null) {
      return;
    }

    if (this.DOM.DropDownElem === null) {
      return;
    } else {
      this.DOM.DropDownElem.forEach((el, index) => {
        // p-globalNav__anchorに付与
        el.previousSibling.setAttribute("data-toggle", "js-dropDown-" + index);
        el.previousSibling.classList.add("js-dropDownTrigger");
        el.previousSibling.setAttribute("aria-expanded", false);
        el.previousSibling.setAttribute("role", "button");
        el.previousSibling.setAttribute("id", "js-dropDownTrigger-" + index);

        // js-dropDownTriggerクラスが付与されたp-globalNav__anchorをDOMオブジェクトに格納
        this.DOM.DropDownTrigger = document.querySelectorAll(".js-dropDownTrigger");

        // 自分自身に付与
        el.setAttribute("aria-labelledby", "js-dropDownTrigger-" + index);
        el.setAttribute("id", "js-dropDown-" + index);

        document.querySelector("#js-subMenu").appendChild(el);
      });
    }
  }

  _mouseenterCommonAction(e) {
    this.DOM.header.classList.add("is-borderBottomInactive");
    if (e) e.target.setAttribute("aria-expanded", true);
    this.DOM.DropDownParent.setAttribute("id", "js-subMenu--opened");
  }

  _mouseleaveCommonAction(e) {
    this.DOM.header.classList.remove("is-borderBottomInactive");
    if (e) e.target.setAttribute("aria-expanded", false);
    this.DOM.DropDownParent.setAttribute("id", "js-subMenu");
  }

  _hover() {
    this.DOM.DropDownTrigger.forEach((el) => {
      // js-DropDownTriggerにホバーした時
      el.addEventListener("mouseenter", (e) => {
        // mouseleaveを使わないで、mouseenterする度に前回is-drawerActiveクラスになったDOM
        // のis-drawerActiveクラスを外して初期値(null)に戻す。
        if (this.previousSubMenu) {
          this.previousSubMenu.classList.remove("is-drawerActive");
          this.previousSubMenu = null;
        }

        this.previousSubMenu = document.getElementById(e.target.getAttribute("data-toggle"));
        this.previousSubMenu.classList.add("is-drawerActive");
        this._mouseenterCommonAction(e);
      });
    });

    this.DOM.DropDownElem.forEach((el) => {
      // .c-dropDown__elemにホバーした時
      el.addEventListener("mouseenter", (e) => {
        e.target.classList.add("is-drawerActive");
        this._mouseenterCommonAction(e);
      });

      // .c-dropDown__elem自身から離れた時;
      el.addEventListener("mouseleave", (e) => {
        e.target.classList.remove("is-drawerActive");
        this._mouseleaveCommonAction(e);
      });
    });
  }

  _watchScroll() {
    // スクロールしたらメニューを閉じる;
    // window.addEventListener("scroll", () => {
    //   if (this.timeoutId) return;
    //   this.timeoutId = setTimeout(() => {
    //     this.timeoutId = false;
    //     if (this.previousSubMenu) {
    //       this.previousSubMenu.classList.remove("is-drawerActive");
    //       this._mouseleaveCommonAction();
    //     }
    //     // 処理内容
    //   }, 250);
    // });

    const observer = new MutationObserver((mutations) => {
      if (mutations[0].target.getAttribute("id") === "js-subMenu--opened") {
        window.addEventListener("scroll", () => {
          if (this.previousSubMenu) {
            this.previousSubMenu.classList.remove("is-drawerActive");
            this._mouseleaveCommonAction();
          }
          observer.disconnect();
        });
      }
    });

    observer.observe(this.DOM.DropDownParent, {
      // characterData: true,
      attributes: true,
    });
  }

  _promise(func) {
    return new Promise((resolve) => {
      resolve();
      func();
    });
  }

  _init() {
    this._promise(this._confirmAndSet.bind(this));
    this._promise(this._hover.bind(this));
    this._watchScroll();
  }
}
