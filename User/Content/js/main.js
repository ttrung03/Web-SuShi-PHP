/* ========= Show Menu ========= */
const navMenu = document.getElementById("nav-menu");
const navToggle = document.getElementById("nav-toggle");
const navClose = document.getElementById("nav-close");

/* ========= Menu Show ========= */
if (navToggle) {
  navToggle.addEventListener("click", () => {
    navMenu.classList.add("show-menu");
  });
}

/* ========= Menu Hidden ========= */
if (navClose) {
  navClose.addEventListener("click", () => {
    navMenu.classList.remove("show-menu");
  });
}

/* ========= Remove Menu Mobile ========= */
const navLink = document.querySelectorAll(".nav__link");

const linkAction = () => {
  navMenu.classList.remove("show-menu");
};
navLink.forEach((link) => link.addEventListener("click", linkAction));

/* ========= Show Menu ========= */
const cartBox = document.getElementById("cart-container");
const openShoping = document.getElementById("cart-button");
const closeShoping = document.getElementById("cart-close");





/*=============== CHANGE BACKGROUND HEADER ===============*/
const scrollHeader = () => {
  const header = document.getElementById("header");
  this.scrollY >= 50
    ? header.classList.add("bg-header")
    : header.classList.remove("bg-header");
};
window.addEventListener("scroll", scrollHeader);

/*=============== SHOW SCROLL UP ===============*/
const scrollUp = () => {
  const scrollUp = document.getElementById("scroll-up");
  this.scrollY <= 350
    ? scrollUp.classList.add("show-scroll")
    : scrollUp.classList.remove("show-scroll");
};
window.addEventListener("scroll", scrollUp);

// /*=============== SCROLL SECTIONS ACTIVE LINK ===============*/
// const sections = document.querySelectorAll("section[id]");

// const scrollActive = () => {
//   const scrollY = window.pageYOffset;

//   sections.forEach((current) => {
//     const sectionHeight = current.offsetHeight;
//     const sectionTop = current.offsetTop - 58;

//     const sectionId = current.getAttribute("id");
//     const sectionsClass = document.querySelector(
//       `.nav__menu a[href*=${sectionId}]`
//     );

//     if (scrollY > sectionTop && scrollY <= sectionTop + sectionHeight) {
//       sectionsClass.classList.add("active-link");
//     } else {
//       sectionsClass.classList.remove("active-link");
//     }
//   });
// };
// window.addEventListener("scroll", scrollActive);

/*=============== DARK LIGHT THEME ===============*/

/*=============== SCROLL REVEAL ANIMATION ===============*/
const sr = ScrollReveal({
  origin: "top",
  distance: "60px",
  duration: 2500,
  deley: 400,
  // reset: true , // Animation repeat
});

sr.reveal(`.home__img, .newsletter__container, .footer__logo,
 .footer__description, .footer__content, .footer__info, .btn-popular`);
sr.reveal(`.home__data,`, { origin: "bottom" });
sr.reveal(`.about__data , .recently__data,`, { origin: "bottom" });
sr.reveal(`.about__img, .recently__img`, { origin: "right" });
sr.reveal(`.popular__card`, { interval: 100 });
