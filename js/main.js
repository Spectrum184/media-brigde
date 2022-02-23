// Lets be professional, shall we?
"use strict";

$(document).ready(function () {
  //preload
  $(window).on("load", function () {
    $(".preloader").fadeOut("slow");
  });

  // Scroll and show navbar shrink
  $(window).on("scroll", function () {
    if ($(this).scrollTop() > 80) {
      $(".navbar").addClass("navbar-shrink");
    } else {
      $(".navbar").removeClass("navbar-shrink");
    }
  });

  // Scroll and show button back home
  $(window).on("scroll", function () {
    if ($(this).scrollTop() > 360) {
      $("#btn-back-home").removeClass("hide-icon");
      $("#btn-back-home").addClass("show-icon");
    } else {
      $("#btn-back-home").removeClass("show-icon");
      $("#btn-back-home").addClass("hide-icon");
    }
  });

  //navbar collapse
  $(".nav-link").on("click", function () {
    $(".navbar-collapse").collapse("hide");
  });

  $(".btn.register-btn").on("click", function () {
    window.location.href = "./registration.html";
  });

  // check input radio
  $(".plan .plan-details").on("click", function (e) {
    if (e.target.children && e.target.children.length > 0) {
      $("#" + e.target.children[0].id).prop("checked", true);
    }
  });

  // Page scrolling
  $.scrollIt({
    topOffset: 0,
  });
});
