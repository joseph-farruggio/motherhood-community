window.addEventListener("DOMContentLoaded", function () {
  // Navigation toggle
  let main_navigation = document.querySelector("#primary-menu");
  if (main_navigation) {
    document
      .querySelector("#primary-menu-toggle")
      .addEventListener("click", function (e) {
        e.preventDefault();
        main_navigation.classList.toggle("hidden");
      });

  }

  //
  let transContent = document.querySelector("#fullTrans");
  if (typeof transContent != "undefined" && transContent != null) {
    let transBtn = document.querySelector("#transBtn");
    transBtn.addEventListener("click", function (e) {
      e.preventDefault();

      if (transContent.classList.contains("hidden")) {
        transContent.classList.remove("hidden");
        transBtn.innerHTML = "Back to summary";
      } else {
        transContent.classList.add("hidden");
        transBtn.innerHTML = "Read full transcript";
      }
    });
  }

  // 
  let alphabet_sticky = document.querySelector('.alphabet-sticky');
  if (typeof alphabet_sticky != "undefined" && alphabet_sticky != null) {
    document.querySelector(".alphabet-sticky-toggle > a").addEventListener("click", function (e) {
      e.preventDefault();
      alphabet_sticky.classList.toggle("open-sidemenu");
    });
  }

  //
  let tocHeading = document.querySelector("#ez-toc-container");
  if (typeof tocHeading != "undefined" && tocHeading != null) {
    if (!tocHeading.classList.contains("menu")) {
      tocHeading.classList.add("menu");
    }
  }

  //
  let widgetblock = document.querySelectorAll(".sidebar .widget_block");
  if (typeof widgetblock != "undefined" && widgetblock != null) {
    widgetblock.forEach((element) => {
      let widgettitle = element.querySelector(".widgettitle");
      widgettitle.addEventListener("click", function (e) {
        e.preventDefault();
        widgettitle.parentElement.classList.toggle("active");
      });
    });
  }

  //
  let pAccordion = document.querySelectorAll(".accordion .accordion-item");
  if (typeof pAccordion != "undefined" && pAccordion != null) {
    pAccordion.forEach((element) => {
      let accordTitle = element.querySelector(".accordion-button");
      accordTitle.addEventListener("click", function (e) {
        e.preventDefault();
        let divColp = this.getAttribute('data-bs-target');
        document.querySelector(divColp).classList.toggle("hidden");
      });
    });
  }

  // Header - Content Margin
  let header = document.getElementById("site-header");
  if (typeof header != "undefined" && header != null) {
    let headerHeight = header.height;
    document.getElementById("content").style.margin = headerHeight + " 0 0 0";

    let searchIcon = document.querySelectorAll(".search-form-icon");
    let xIcon = document.querySelectorAll(".x-icon");

    searchIcon.forEach((element) => {
      element.addEventListener("click", function (e) {
        e.preventDefault();
        searchIcon.forEach((a) => {
          a.classList.add("hidden");
        });
        xIcon.forEach((a) => {
          a.classList.remove("hidden");
        });
        header.classList.remove("hide-form");
      });
    });

    xIcon.forEach((element) => {
      element.addEventListener("click", function (e) {
        e.preventDefault();
        xIcon.forEach((a) => {
          a.classList.add("hidden");
        });
        searchIcon.forEach((a) => {
          a.classList.remove("hidden");
        });
        header.classList.add("hide-form");
      });
    });
  }

  // Splide slider init
  let partnersLogo = document.querySelector("#partners-logo");
  if (typeof partnersLogo != "undefined" && partnersLogo != null) {
    new Splide("#partners-logo", {
      type: "loop",
      perPage: 5,
      perMove: 1,
      autoplay: true,
      arrows: false,
      gap: "2em",
      pagination: false,
      breakpoints: {
        640: {
          perPage: 2,
        },
      },
    }).mount();
  }

  let grid3Posts = document.querySelector("#grid3-posts");
  if (typeof grid3Posts != "undefined" && grid3Posts != null) {
    new Splide("#grid3-posts", {
      type: "slide",
      perPage: 3,
      perMove: 1,
      arrows: false,
      drag: true,
      gap: "2rem",
      breakpoints: {
        1023: {
          perPage: 2,
          arrows: true,
        },
        639: {
          perPage: 1,
          arrows: true,
        },
      },
    }).mount();
  }

  let featuredPosts = document.querySelector("#sidebar-featured-post");
  if (typeof featuredPosts != "undefined" && featuredPosts != null) {
    new Splide("#sidebar-featured-post", {
      type: "slide",
      perPage: 1,
      perMove: 1,
      autoplay: true,
      arrows: false,
      drag: true,
    }).mount();
  }

  // 
  var filter_tags = document.getElementsByClassName('filter_tags');
  if (typeof filter_tags != "undefined" && filter_tags != null) {

    for (i = 0; i < filter_tags.length; i++) {
      filter_tags[i].addEventListener("click", show_hide_filter_posts);
    }

  }

  // 
  var alphabetSticky = document.getElementsByClassName('alphabet-sticky');
  if (typeof alphabetSticky != "undefined" && alphabetSticky != null) {
    for (i = 0; i < alphabetSticky.length; i++) {
      alphabetSticky[i].style.top = document.getElementById('site-header').clientHeight + 'px';
    }
  }

  // Smooth Scroll when clicking "#" links
  document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
      e.preventDefault();

      const el = document.getElementById(this.getAttribute('href').replace('#', ''));

      // additional_scroll = 100
      additional_scroll = document.getElementById('site-header').clientHeight;

      // Mind the auto hiding sticky header
      if (el.offsetTop < window.scrollY) {
        additional_scroll += 100;
      }

      // Mind the admin bar
      if (document.getElementsByTagName('body')[0].classList.contains('admin-bar')) {
        additional_scroll += 32;
      }

      window.scrollTo({ top: el.offsetTop - additional_scroll, behavior: 'smooth' });

    });
  });
});


/**
 * Show/Hide Tags Filtering on Category Archive
 * 
 */
function show_hide_filter_posts() {

  document.querySelectorAll('.filter_tags').forEach(function (el) {
    el.classList.remove('active');
  });

  this.classList.add('active');

  if (this.dataset.tag_name != '') {

    tagname = this.dataset.tag_name;

    document.querySelectorAll('.tags_posts').forEach(function (el) {
      el.classList.add('hidden-anm');
    });


    setTimeout(function () {

      console.log(tagname);

      document.querySelectorAll('.tags_posts').forEach(function (el) {
        el.classList.add('hidden');
      });

      document.querySelectorAll('.' + tagname).forEach(function (el) {
        el.classList.remove('hidden');
      });

    }, 500);


    setTimeout(function () {
      document.querySelectorAll('.' + tagname).forEach(function (el) {
        el.classList.remove('hidden-anm');
      });
    }, 600);

  } else {

    document.querySelectorAll('.tags_posts').forEach(function (el) {
      el.classList.remove('hidden-anm');
      el.classList.remove('hidden');
    });

  }

};

// Sticky Header
// let lastScroll = 0;
// window.addEventListener("scroll", () => {
//   const currentScroll = window.pageYOffset;
//   if (currentScroll <= 100) {
//     document.querySelector("body").classList.remove("scroll-up");
//     return;
//   }

//   if (
//     currentScroll > lastScroll &&
//     !document.querySelector("body").classList.contains("scroll-down")
//   ) {
//     // down
//     document.querySelector("body").classList.remove("scroll-up");
//     document.querySelector("body").classList.add("scroll-down");
//   } else if (
//     currentScroll < lastScroll &&
//     document.querySelector("body").classList.contains("scroll-down")
//   ) {
//     // up
//     document.querySelector("body").classList.remove("scroll-down");
//     document.querySelector("body").classList.add("scroll-up");
//   }
//   lastScroll = currentScroll;
// });