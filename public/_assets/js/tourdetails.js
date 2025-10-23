document.addEventListener("DOMContentLoaded", function () {
  const gallery = document.querySelector("#lightgallery");
  const items = gallery.querySelectorAll(".tour-img");
  const maxVisible = 3;

  if (items.length > maxVisible) {
    gallery.classList.add("has-layout");

    for (let i = maxVisible; i < items.length; i++) {
      items[i].classList.add("hidden");
    }

    const extraCount = items.length - maxVisible;
    const overlayBtn = document.createElement("button");
    overlayBtn.className = "more-img-overlay";
    overlayBtn.innerHTML = `<span>+${extraCount} <i class="fa-solid fa-image"></i></span>`;

    items[maxVisible - 1].appendChild(overlayBtn);

    overlayBtn.addEventListener("click", function () {
      lightGallery(gallery, {
        dynamic: true,
        dynamicEl: Array.from(items).map((item) => ({
          src: item.getAttribute("href"),
          thumb: item.querySelector("img")?.getAttribute("src"),
        })),
      });
    });
  } else {
  }

  lightGallery(gallery, {
    selector: ".tour-img",
    plugins: [lgZoom, lgThumbnail],
    thumbnail: true,
  });
});

const expandBtn = document.getElementById("expandAllBtn");
expandBtn.addEventListener("click", () => {
  const items = document.querySelectorAll(".accordion-collapse");
  const anyCollapsed = Array.from(items).some(
    (i) => !i.classList.contains("show")
  );
  items.forEach((item) => {
    const bsCollapse = new bootstrap.Collapse(item, { toggle: false });
    anyCollapsed ? bsCollapse.show() : bsCollapse.hide();
  });
});

document.addEventListener("DOMContentLoaded", function () {
  const buttons = document.querySelectorAll(
    "#itineraryAccordion .accordion-button"
  );

  buttons.forEach((btn) => {
    btn.addEventListener("click", function (e) {
      e.preventDefault();
      const targetId = this.getAttribute("data-bs-target");
      const panel = document.querySelector(targetId);
      const parentItem = this.closest(".accordion-item");

      if (!panel) return;

      const isOpen = panel.classList.contains("show");

      if (isOpen) {
        panel.classList.remove("show");
        parentItem.classList.remove("active");
        this.classList.add("collapsed");
        this.setAttribute("aria-expanded", "false");
      } else {
        panel.classList.add("show");
        parentItem.classList.add("active");
        this.classList.remove("collapsed");
        this.setAttribute("aria-expanded", "true");
      }
    });
  });
});

document.addEventListener("DOMContentLoaded", function () {
  const tourBtn = document.querySelectorAll(".tour-details-section h3");
  tourBtn.forEach((btn) => {
    btn.addEventListener("click", (e) => {
      e.preventDefault();
      btn.parentElement.classList.toggle("show");
    });
  });
});

// ---------------
// ---------------

document.addEventListener("DOMContentLoaded", function () {
  const tourDetailsNav = document.querySelector(".tour-details-nav");
  const navWrapper = document.querySelector(".nav-wrapper");

  function toggleNavVisibility() {
    const scrollTop = window.scrollY || document.documentElement.scrollTop;
    const wrapperTop = navWrapper.offsetTop - 200;

    if (scrollTop >= wrapperTop) {
      tourDetailsNav.classList.add("show");
    } else {
      tourDetailsNav.classList.remove("show");
    }
  }

  window.addEventListener("scroll", toggleNavVisibility);
  toggleNavVisibility();
});

document.addEventListener("DOMContentLoaded", function () {
  const navItems = document.querySelectorAll(".tour-details-nav h3");

  navItems.forEach(item => {
    item.addEventListener("click", function () {
      navItems.forEach(h3 => h3.classList.remove("active"));
      this.classList.add("active");
    });
  });

  window.addEventListener("scroll", function () {
    const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
    navItems.forEach(item => {
      const anchor = item.querySelector("a");
      if (!anchor) return;

      const targetId = anchor.getAttribute("href");
      const targetEl = document.querySelector(targetId);
      if (targetEl) {
        const targetTop = targetEl.offsetTop - 200;
        const targetBottom = targetTop + targetEl.offsetHeight;

        if (scrollTop >= targetTop && scrollTop < targetBottom) {
          navItems.forEach(h3 => h3.classList.remove("active"));
          item.classList.add("active");
          item.scrollIntoView({
            behavior: "smooth",
            inline: "center",
            block: "nearest"
          });
        }
      }
    });
  });
});


document.addEventListener("DOMContentLoaded", function () {
  const navBarOne = document.querySelector(".upper-navbar");
  const navBarMenu = document.querySelector(".main-navbar");
  const navBarth = document.querySelector(".bg-gray");
  const logo = document.querySelector(".main-navbar .navbar-brand");
  const tourDetailsNav = document.querySelector(".tour-details-nav");
  const navItems = document.querySelectorAll(".tour-details-nav h3");
  function handleScroll() {
    const currentScroll = window.scrollY || document.documentElement.scrollTop;
    const isMobile = window.innerWidth < 768;
    if (currentScroll > 70) {
      if (isMobile) {
        navBarOne?.classList.add("d-none");
      } else {
        navBarOne?.classList.remove("d-none");
        navBarMenu?.classList.add("is-fixed");
        navBarOne?.classList.add("is-fixed");
        logo?.classList.add("hide-logo");
        navBarOne?.classList.remove("hidden-on-load");
      }
    } else {
      if (isMobile) {
        navBarOne?.classList.add("d-none");
        navBarth?.classList.add("d-none");
        navBarMenu?.classList.add("is-fixed");
      } else {
        navBarMenu?.classList.remove("is-fixed");
        navBarOne?.classList.remove("is-fixed");
        logo?.classList.remove("hide-logo");
        navBarOne?.classList.add("hidden-on-load");
      }
    }

    const triggerPoint = 300;
    const tourDetailsWrapper = document.querySelector(".tour-details-wrappers");

    if (currentScroll > triggerPoint) {
      const wrapperBottom = tourDetailsWrapper.offsetTop + tourDetailsWrapper.offsetHeight;

      if (currentScroll + tourDetailsNav.offsetHeight < wrapperBottom) {
        tourDetailsNav?.classList.add("sticky");
        tourDetailsNav?.classList.remove("stop-sticky");
      } else {
        tourDetailsNav?.classList.remove("sticky");
        tourDetailsNav?.classList.add("stop-sticky");
      }
    } else {
      tourDetailsNav?.classList.remove("sticky", "stop-sticky");
    }
  }

  navItems.forEach(item => {
    item.addEventListener("click", function () {
      navItems.forEach(h3 => h3.classList.remove("active"));
      this.classList.add("active");
    });
  });

  window.addEventListener("scroll", handleScroll);
  handleScroll();
});
