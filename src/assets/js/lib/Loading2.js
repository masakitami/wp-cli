import gsap from "gsap";

export default class Loading2 {
  constructor() {
    this.DOM = {
      transitionItem: document.querySelectorAll(".item"),
      transitionContainer: document.querySelector(".common-transition"),
    };

    console.log("ローディ=========");
  }

  _delay(n) {
    n = n || 2000;
    return new Promise((resolve) => {
      setTimeout(() => {
        resolve();
      }, n);
    });
  }

  _pageTransition() {
    console.log("pagetransitionは");
    const tl = gsap.timeline();

    tl.to(this.DOM.transitionItem, {
      duration: 1,
      scaleY: 0.5,
      transformOrigin: "bottom",
      stagger: 0.1,
      ease: "Expo.easeInOut",
    });

    // tl.to(this.DOM.transitionContainer, {
    //   duration: 1,
    //   y: "-100%",
    //   ease: "Expo.easeInOut",
    // });

    tl.to(this.DOM.transitionItem, {
      duration: 0,
      scaleY: 0,
      scaleX: 1,
    });

    // tl.to(this.DOM.transitionContainer, {
    //   duration: 0,
    //   y: 0,
    // });
  }

  _leaveAnimation() {
    console.log("leavingしてますよ");
    const tl = gsap.timeline();
    tl.to(".l-main", {
      duration: 1,
      y: -50,
      opacity: 0,
      ease: "Quart.easeOut",
    });
  }

  _enterAnimation() {
    const tl = gsap.timeline();
    tl.from(".l-main", {
      duration: 1,
      y: 50,
      opacity: 0,
      ease: "Quart.easeOut",
    });
  }
}
