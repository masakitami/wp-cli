import gsap from "gsap";

export default class Test {
  constructor() {
    const str = "Thanks you for watching";
    let text = "";
    str.split("").forEach((v) => {
      text += `<span class="letter">${v}</span>`;
    });

    // is-drawerActiveになったDropDownElemのDOMを毎度ホバー時に格納
    document.querySelector(".-text").innerHTML = text;
    gsap.set(".letter", {
      opacity: 0,
      y: 50,
    });

    this.obj = document.querySelector("#loader");
    this.canvas = document.createElement("canvas");
    this.ctx = this.canvas.getContext("2d");
    console.log("ctxは", this.ctx);

    this.canvasSize = {
      width: window.innerWidth,
      height: window.innerHeight,
    };

    this.canvas.width = this.canvasSize.width * Math.min(2, window.devicePixelRatio);
    this.canvas.height = this.canvasSize.height * Math.min(2, window.devicePixelRatio);

    this.canvas.style.width = `${this.canvas.width}px`;
    this.canvas.style.height = `${this.canvas.height}px`;
    this.obj.appendChild(this.canvas);

    this.ctx.scale(0.5, 0.5);

    this.point = {
      currentY: this.canvas.height,
      curveY: this.canvas.height,
    };

    this._init();
  }

  _init() {
    gsap.registerEffect({
      name: "curve",
      defaults: {
        flag: true,
      },
      ease: "power4.out",

      effect: (target, config) => {
        return gsap
          .timeline({
            onUpdate: () => {
              this.curveUpdate(config.flag);
            },
          })
          .to(target, {
            duration: 2,
            curveY: 0,
            ease: "power4.out",
          })
          .to(
            target,
            {
              currentY: 0,
              duration: 4,
            },
            "<"
          );
      },
    });

    gsap.timeline({ delay: 1 }).add(gsap.effects.curve(this.point));
  }

  curveUpdate(flag) {
    console.log("なしday", flag);
    // if (flag) {
    //   this.ctx.fillRect(0, 0, this.canvas.width, this.canvas.height);
    //   this.ctx.fillStyle = "red";
    // }

    // this.ctx.clearRect(0, 0, this.canvas.width, this.canvas.height);
    this.ctx.clearRect(0, 0, this.canvas.width, this.canvas.height);
    this.ctx.beginPath();
    this.ctx.moveTo(0, 0);
    this.ctx.lineTo(0, this.point.currentY);
    this.ctx.quadraticCurveTo(this.canvas.width / 2, this.point.curveY, this.canvas.width, this.point.currentY);
    this.ctx.lineTo(this.canvas.width, 0);
    this.ctx.closePath();
    this.ctx.fill();
    this.ctx.fillStyle = "blue";
  }
}

// addEventListener("load", () => {
//   new Test();
// });
