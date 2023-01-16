export default class WpSetHeight {
  constructor() {
    this.DOM = {
      html: document.querySelector("html"),
      header: document.querySelector("header"),
      wpAdminBar: document.querySelector("#wpadminbar"),
    };

    this.device = null;

    this.breakPoints = 991;

    this._init();
  }

  _device() {
    if (window.matchMedia("(max-width:991px)").matches) {
      return (this.device = "sp");
    } else {
      return (this.device = "pc");
    }
  }

  _confirm() {
    if (!this.DOM.html) {
      return;
    }

    if (!this.DOM.wpAdminBar) {
      return;
    }

    if (!this.DOM.header) {
      return;
    }
  }

  _addHeight() {
    this.DOM.header.style.marginTop = this.DOM.wpAdminBar.clientHeight + "px";
  }

  _removeHeight() {
    this.DOM.header.style.marginTop = 0 + "px";
  }

  _watchWidth() {
    const observer = new MutationObserver((mutations) => {
      window.addEventListener("resize", () => {
        let htmlWidth = mutations[0].target.clientWidth;

        // pcの時だけ
        if (htmlWidth > this.breakPoints) {
          this._addHeight();
        } else {
          // スマホサイズになったら外す
          this._removeHeight();
        }
        observer.disconnect();
      });
    });

    observer.observe(this.DOM.html, {
      // characterData: true,
      attributes: true,
    });
  }

  _promise(func) {
    new Promise((resolve) => {
      resolve();
      func();
    });
  }

  async _init() {
    // 管理画面の時だけ実行
    if (this.DOM.wpAdminBar) {
      // 最初にデバイス判定の実行
      await this._promise(this._device.bind(this));

      switch (this.device) {
        case (this.device = "sp"):
          this._watchWidth();
          break;

        case (this.device = "pc"):
          await this._promise(this._confirm.bind(this));
          await this._promise(this._addHeight.bind(this));
          this._watchWidth();
          break;
      }
    }
  }
}
