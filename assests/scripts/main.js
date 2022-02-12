var homeBtn = document.querySelector("#home");
var homeIcon = document.querySelector("#home-logo");
var toggleMenuButton = document.querySelector("#toggle-menu");
var scrollToBtn = document.querySelector(".scroll-top");
var navbar = document.querySelector(".nav");
var reducedMotionQuery = false;
var scrollBehavior = "smooth";

// If IE, just scroll - I really give up with vanilla js, really tired
if (!document.documentMode) {
  if (typeof window.matchMedia === "function") {
    reducedMotionQuery = window.matchMedia("(prefers-reduced-motion: reduce)");
  }

  // Check if the media query matches or is not available.
  if (!reducedMotionQuery || reducedMotionQuery.matches) {
    scrollBehavior = "auto";
  }
}

function scrollToTop(e) {
  e.preventDefault();
  window.scrollTo({ top: 0, behavior: scrollBehavior });
}

function scrollFunction() {
  if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
    scrollToBtn.style.display = "block";
  } else {
    scrollToBtn.style.display = "none";
  }
}

function toggleMenu(e) {
  var styleTmp = navbar.style.display;

  if (styleTmp === "none" || !styleTmp) {
    navbar.style.display = "flex";
  } else {
    navbar.style.display = "none";
  }
}

window.onscroll = function () {
  scrollFunction();
};

window.onresize = function () {
  // 739 is breakpoint for mobile
  if (window.innerWidth > 739) {
    navbar.style.display = "flex";
  } else {
    navbar.style.display = "none";
  }
};

//Make nav active when clicked and scrolls down to section
document.addEventListener("click", function (event) {
  event.preventDefault();
  var activeNavbar = document.querySelector(".menu-link.active");

  if (activeNavbar) activeNavbar.classList.remove("active");
  const classListTmp = event.target.classList;
  if (classListTmp[0] && classListTmp[0].indexOf("menu-link") !== -1) {
    event.target.classList.add("active");

    var sectionToScroll = document.querySelector(event.target.hash);

    if (window.scrollY !== undefined) {
      sectionToScroll.scrollIntoView({
        behavior: scrollBehavior,
        block: "start",
        inline: "start",
      });
    } else {
      window.location.href = event.target.href;
    }
    if (window.innerWidth < 740) {
      navbar.style.display = "none";
    }
  }
});

homeBtn.addEventListener("click", scrollToTop);
homeIcon.addEventListener("click", scrollToTop);
scrollToBtn.addEventListener("click", scrollToTop);
toggleMenuButton.addEventListener("click", toggleMenu);
