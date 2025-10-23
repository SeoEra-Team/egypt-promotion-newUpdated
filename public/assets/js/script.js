/* ================== Start Header Fixed ================== */

document.addEventListener("DOMContentLoaded", function () {
  const navBarOne = document.querySelector(".nav-one"); 
  const navBarMenu = document.querySelector(".nav-menu-bar");
  const menu = document.querySelector(".sticky-header");

  window.addEventListener("scroll", function () {
    if (window.scrollY > 70) {
      if (navBarOne) navBarOne.style.display = "none";
      if (navBarMenu) navBarMenu.style.position = "fixed";
      if (menu) menu.classList.add("is-fixed");
    } else {
      if (navBarOne) navBarOne.style.display = "block";
      if (navBarMenu) navBarMenu.style.position = "relative";
      if (menu) menu.classList.remove("is-fixed");
    }
  });
});

/* ================== End Header Fixed ================== */


/* ================== Side Menu ================== */

const btnOpenSideMenu = document.querySelector(".navbar-toggler"),
  sideMenuItem = document.querySelector(".side-menu"),
  closeSidebarOverLay = document.querySelector(".close-menu-sidebar"),
  btnCloseSideMenu = document.querySelector(".close-side-menu"),
  body = document.body;

function toggleMenu(open) {
  if (sideMenuItem) sideMenuItem.classList.toggle("open", open);
  if (closeSidebarOverLay) closeSidebarOverLay.classList.toggle("open", open);
  body.style.overflow = open ? "hidden" : "auto";
}

if (btnOpenSideMenu) {
  btnOpenSideMenu.addEventListener("click", function (e) {
    e.preventDefault();
    toggleMenu(!sideMenuItem.classList.contains("open"));
  });
}

if (closeSidebarOverLay) {
  closeSidebarOverLay.addEventListener("click", function (e) {
    e.preventDefault();
    toggleMenu(false);
  });
}

if (btnCloseSideMenu) {
  btnCloseSideMenu.addEventListener("click", function (e) {
    e.preventDefault();
    toggleMenu(false);
  });
}

/* ================== Side Menu ================== */
/* ================== City Tailor Active ================== */
document.addEventListener("DOMContentLoaded", function () {
  document.querySelectorAll(".city-tailor").forEach(item => {
    item.addEventListener("click", function () {
      this.classList.toggle("active");
    });
  });
});

/* ================== Mobile Dropdown ================== */
document.addEventListener("DOMContentLoaded", function () {
  document.querySelectorAll(".nav-item.mobile.has-dropdown .icon-down")
    .forEach(icon => {
      icon.addEventListener("click", function (e) {
        e.preventDefault();

        const parentItem = this.closest(".nav-item.mobile.has-dropdown");
        const submenu = parentItem.querySelector(".mobile.sub-menu");

        document.querySelectorAll(".nav-item.mobile.has-dropdown .mobile.sub-menu")
          .forEach(sm => {
            if (sm !== submenu) sm.classList.remove("sub-menu-collapsed");
          });

        submenu.classList.toggle("sub-menu-collapsed");

        this.classList.toggle("active");

        document.querySelectorAll(".nav-item.mobile.has-dropdown .icon-down")
          .forEach(ic => {
            if (ic !== this) ic.classList.remove("active");
          });
      });
    });
});

/* ================== End Script ================== */



/* ============================ Start Partner One Carousel ================== */

var swiper = new Swiper(".partners .mySwiper", {
  slidesPerView: 1,
  spaceBetween: 10,
  loop: true,
  pagination: {
    el: ".swiper-pagination",
    clickable: true,
  },
  breakpoints: {
    0: {
      slidesPerView: 2, // موبايل
      spaceBetween: 15,
    },
    640: {
      slidesPerView: 2,
      spaceBetween: 20,
    },
    768: {
      slidesPerView: 6,
      spaceBetween: 40,
    },
    1024: {
      slidesPerView: 6,
      spaceBetween: 10,
    },
  },
});

/* ============================ Start Partner One Carousel ================== */

/* =============================== Start FAQ  =============================== */


document.addEventListener("DOMContentLoaded", function () {
  const groups = document.querySelectorAll(".accrodion-grp");

  groups.forEach(function (group) {
    const accrodionName = group.dataset.grpName;
    const accordions = group.querySelectorAll(".accrodion");

    group.querySelectorAll(".accrodion-content").forEach(function (content) {
      content.style.display = "none";
    });

    const activeAccordion = group.querySelector(".accrodion.active .accrodion-content");
    if (activeAccordion) {
      activeAccordion.style.display = "block";
    }

    accordions.forEach(function (accordion) {
      const title = accordion.querySelector(".accrodion-title");
      const content = accordion.querySelector(".accrodion-content");

      title.addEventListener("click", function () {
        const isActive = accordion.classList.contains("active");

        if (isActive) {
          accordion.classList.remove("active");
          content.style.display = "none";
        } else {
          group.querySelectorAll(".accrodion").forEach(function (acc) {
            acc.classList.remove("active");
            acc.querySelector(".accrodion-content").style.display = "none";
          });

          accordion.classList.add("active");
          content.style.display = "block";
        }
      });
    });
  });
});




/* =============================== Start FAQ  =============================== */

/* =============================== form  increase & decrease   =============================== */

document.addEventListener('DOMContentLoaded', function () {
  const plusBtn = document.querySelectorAll(".increase-btn")
  const minusBtn = document.querySelectorAll(".decrease-btn")
  const inputQuantity = document.querySelectorAll(".quantity-input")
  const finalPrice = document.querySelector(".final-price")

  plusBtn.forEach(btn => {
    btn.addEventListener("click", e => {
      e.preventDefault();
      const parent = btn.parentElement;
      const input = parent.querySelector('input');
      let inputValue = parseInt(input.value) || 0;
      inputValue++;
      input.value = inputValue;
      updateTotalPrice();
    });
  });

  minusBtn.forEach(btn => {
    btn.addEventListener("click", e => {
      e.preventDefault();
      const parent = btn.parentElement;
      const input = parent.querySelector('input');
      const inputAttr = input.getAttribute("data-type")
      let inputValue = parseInt(input.value) || 0;
      const minValue = inputAttr === "adults" ? 1 : 0;

      if (inputValue > minValue) {
        inputValue--;
        input.value = inputValue;
        updateTotalPrice();
      }
      updateTotalPrice();
    });
  });
  inputQuantity.forEach(input =>
    input.addEventListener("change", function () {
      updateTotalPrice();
    })
  )

  function updateTotalPrice() {
    let total = 0;

    document.querySelectorAll('.quantity-input').forEach(input => {
      const quantity = parseInt(input.value) || 0;
      const unitPrice = parseFloat(input.dataset.price) || 0;
      const itemTotal = quantity * unitPrice;
      total += itemTotal;


      const priceDisplay = input.closest(".adult-pricing, .children-pricing, .infants-pricing")
        .querySelector(".price-amount");
      if (priceDisplay) {
        priceDisplay.textContent = `${quantity} * ${unitPrice} EUR`;
      }
    });


    const finalPriceElement = document.querySelector('.final-price');
    finalPriceElement.textContent = `${total} EUR`;
  }

})

/* =============================== form  increase & decrease   =============================== */

/* =============================== form flatpickr  =============================== */

flatpickr("#Departure", {
  dateFormat: "d-m-Y",
  minDate: "today",
  disableMobile: true,
  locale: {
    firstDayOfWeek: 1
  }
});

flatpickr("#Pickup", {
  dateFormat: "d-m-Y",
  minDate: "today",
  disableMobile: true,
  locale: {
    firstDayOfWeek: 1
  }
});

/* =============================== form flatpickr  =============================== */

/* =============================== showMore-Btn text =============================== */



/* =============================== showMore-Btn text  =============================== */

/* =============================== showMore-Btn text  =============================== */


var swiper = new Swiper(".hotel-section .mySwiper", {
  slidesPerView: 1,
  spaceBetween: 30,
  loop: true,
  pagination: {
    el: ".swiper-pagination",
    clickable: true,
  },
  breakpoints: {
    640: {
      slidesPerView: 2,
      spaceBetween: 20,
    },
    768: {
      slidesPerView: 3,
      spaceBetween: 30,
    },
  },
});

/* =============================== showMore-Btn text  =============================== */
