import gsap from "gsap";
import Loading from "./Loading";

export default class Test {
  constructor() {
    this.DOM = {
      container: document.querySelector(".loading--container"),
      title: document.querySelector(".loading--title"),
      canvas: document.createElement("canvas"),
    };

    this.windowWidth = window.innerWidth;

    this.windowHeight = window.innerHeight;

    this.ctx = this.DOM.canvas.getContext("2d");

    this.scale = Math.min(2, window.devicePixelRatio);

    if (this.scale >= 2) this.ctx.scale(0.5, 0.5);

    this.DOM.canvas.width = this.windowWidth;
    this.DOM.canvas.height = this.windowHeight;

    this.DOM.canvas.style.width = `${this.DOM.canvas.width}px`;
    this.DOM.canvas.style.height = `${this.DOM.canvas.height}px`;

    this.point = {
      curveY: this.windowHeight * this.scale,
      currentY: this.windowHeight * this.scale,
    };

    this.newText = "";

    this._init();
  }

  _setContainer() {
    console.log("heightです");
    this.DOM.container.style.height = `${this.windowHeight}px`;
    console.log("heightは", this.windowHeight);
  }

  _setTitle() {
    this.DOM.title.innerText.split("").forEach((letter) => {
      this.newText += `<span class="loading--text js-loading--text">${letter}</span>`;
    });

    this.DOM.title.innerHTML = this.newText;

    // const tl = gsap.timeline();

    // tl.to(".js-loading--text", {
    //   opacity: 0,
    //   y: 40,
    // }).add(this.DOM.title.classList.add("is-loaded"));
  }

  _setCanvas() {
    console.log("canvasとは", this.ctx);

    this.DOM.canvas.setAttribute("id", "js-loading--canvas");

    // this.ctx.clearRect(0, 0, this.windowWidth, this.windowHeight);
    // this.ctx.fillStyle = "red";

    this.DOM.container.appendChild(this.DOM.canvas);
  }

  _confirm() {
    if (!this.DOM.container) {
      return;
    } else {
      this._setContainer();
    }

    if (!this.DOM.title) {
      return;
    } else {
      this._setTitle();
    }

    if (!this.DOM.canvas) {
      return;
    } else {
      this._setCanvas();
    }
  }

  _createCurve(flag) {
    this.ctx.clearRect(0, 0, this.windowWidth, this.windowHeight);
    this.ctx.fillStyle = "#141414";

    if (flag) {
      this.ctx.fillRect(0, 0, this.windowWidth, this.windowHeight);
      this.ctx.fillStyle = "yellow";
    }

    this.ctx.beginPath();
    this.ctx.moveTo(0, 0);
    this.ctx.lineTo(0, this.point.currentY);
    this.ctx.quadraticCurveTo(this.windowWidth / 2, this.point.curveY, this.windowWidth, this.point.currentY);
    this.ctx.lineTo(this.windowWidth, 0);
    // this.ctx.fillStyle = "red";
    this.ctx.fill();
  }

  _createTextAnimation() {
    if (!this.newText) {
      return;
    }

    gsap.set(".js-loading--text", {
      y: 40,
      opacity: 0,
    });

    const tl = gsap.timeline();

    tl.to(".js-loading--text", {
      y: 0,
      stagger: { each: 0.05 },
      opacity: 1,
      ease: "elastic(1.2, 0.5)",
      // ease: "back.out(3)",
      // delay: 1,
      duration: 2,
      repeat: 0,
    }).to(".js-loading--text", {
      y: -600,
      opacity: 0,
      stagger: { each: 0.01, ease: "power2" },
      ease: "power2.inOut",
      duration: 1.85,
      repeat: 0,
    });
  }

  _curveTimeLine(target) {
    return gsap
      .timeline({
        onUpdate: () => {
          this._createCurve();
        },
      })

      .to(
        target,
        {
          curveY: 0,
          ease: "power4.out",
          duration: 1.2,
        },
        "+=3"
      )

      .to(
        target,
        {
          currentY: 0,
          duration: 1,
        },
        "<"
      );
  }

  _gsapRegisterEffect() {
    gsap.registerEffect({
      name: "curve",

      defaults: {
        flag: true,
      },

      ease: "power4.out",
      effect: (target, config) => {
        return this._timeLine(target, config.flag);
      },
    });
  }

  _init() {
    this._confirm();
    this._gsapRegisterEffect();
    const tl = gsap.timeline();
    tl.add(this._createTextAnimation())
      .add(this._curveTimeLine(this.point))

      .add(() => {
        document.querySelector("html").classList.add("is-loaded");
      }, "-=.4")
      .add(() => {
        if (this.DOM.container) {
          this.DOM.container.style.display = "none";
        }
      });
  }
}

addEventListener("DOMContentLoaded", () => {
  new Test();
  const tl = gsap.timeline();

  tl.add(() => new Test()).add(() => new Loading());
});
