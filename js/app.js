(() => {
  // resources/js/app.js
  window.addEventListener("DOMContentLoaded", function() {
    let transContent = document.querySelector("#fullTrans");
    if (typeof transContent != "undefined" && transContent != null) {
      let transBtn = document.querySelector("#transBtn");
      transBtn.addEventListener("click", function(e) {
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
    let alphabet_sticky = document.querySelector(".alphabet-sticky");
    if (typeof alphabet_sticky != "undefined" && alphabet_sticky != null) {
      document.querySelector(".alphabet-sticky-toggle > a").addEventListener("click", function(e) {
        e.preventDefault();
        alphabet_sticky.classList.toggle("open-sidemenu");
      });
    }
    let tocHeading = document.querySelector("#ez-toc-container");
    if (typeof tocHeading != "undefined" && tocHeading != null) {
      if (!tocHeading.classList.contains("menu")) {
        tocHeading.classList.add("menu");
      }
    }
    let widgetblock = document.querySelectorAll(".sidebar .widget_block");
    if (typeof widgetblock != "undefined" && widgetblock != null) {
      widgetblock.forEach((element) => {
        let widgettitle = element.querySelector(".widgettitle");
        widgettitle.addEventListener("click", function(e) {
          e.preventDefault();
          widgettitle.parentElement.classList.toggle("active");
        });
      });
    }
    let pAccordion = document.querySelectorAll(".accordion .accordion-item");
    if (typeof pAccordion != "undefined" && pAccordion != null) {
      pAccordion.forEach((element) => {
        let accordTitle = element.querySelector(".accordion-button");
        accordTitle.addEventListener("click", function(e) {
          e.preventDefault();
          let divColp = this.getAttribute("data-bs-target");
          document.querySelector(divColp).classList.toggle("hidden");
        });
      });
    }
    var filter_tags = document.getElementsByClassName("filter_tags");
    if (typeof filter_tags != "undefined" && filter_tags != null) {
      for (i = 0; i < filter_tags.length; i++) {
        filter_tags[i].addEventListener("click", show_hide_filter_posts);
      }
    }
    var alphabetSticky = document.getElementsByClassName("alphabet-sticky");
    if (typeof alphabetSticky != "undefined" && alphabetSticky != null) {
      for (i = 0; i < alphabetSticky.length; i++) {
        alphabetSticky[i].style.top = document.getElementById("site-header").clientHeight + "px";
      }
    }
  });
  function show_hide_filter_posts() {
    document.querySelectorAll(".filter_tags").forEach(function(el) {
      el.classList.remove("active");
    });
    this.classList.add("active");
    if (this.dataset.tag_name != "") {
      tagname = this.dataset.tag_name;
      document.querySelectorAll(".tags_posts").forEach(function(el) {
        el.classList.add("hidden-anm");
      });
      setTimeout(function() {
        console.log(tagname);
        document.querySelectorAll(".tags_posts").forEach(function(el) {
          el.classList.add("hidden");
        });
        document.querySelectorAll("." + tagname).forEach(function(el) {
          el.classList.remove("hidden");
        });
      }, 500);
      setTimeout(function() {
        document.querySelectorAll("." + tagname).forEach(function(el) {
          el.classList.remove("hidden-anm");
        });
      }, 600);
    } else {
      document.querySelectorAll(".tags_posts").forEach(function(el) {
        el.classList.remove("hidden-anm");
        el.classList.remove("hidden");
      });
    }
  }
})();
