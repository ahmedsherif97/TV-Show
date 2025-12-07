(function () {
  "use strict";

  // ======= Main Website Navbar
  const topbar = document.querySelector(".topbar-wrapper");
  const navbar = document.querySelector(".navbar");
  const countdownWrapper = document.querySelector(".countdown-wrapper");
  const navbarOverlay = document.querySelector(".navbar-overlay");
  if (navbar) {
    // ======= Sticky
    function stickyCheck() {
      const sticky = navbar.offsetTop;
      if (window.scrollY > sticky) {
        navbar.classList.add("sticky-nav");
        topbar.style.top = "-50px";
        countdownWrapper.style.marginTop = "-65px";
      } else {
        navbar.classList.remove("sticky-nav");
        if (!navbarOverlay.classList.contains("visible")) {
          //navbar.classList.remove("bg-white")
        }
        topbar.style.top = "0px";
        countdownWrapper.style.marginTop = "0px";
      }
    }
    window.onload = function() {
      stickyCheck()
    }
    window.addEventListener('scroll', function () {
      stickyCheck()

      // show or hide the back-top-top button
      const backToTop = document.querySelector(".back-to-top");
      if (
        document.body.scrollTop > 50 ||
        document.documentElement.scrollTop > 50
      ) {
        backToTop.style.display = "flex";
      } else {
        backToTop.style.display = "none";
      }
    });

    // ===== responsive navbar
    let navbarToggler = document.querySelector("#navbarToggler");
    const navbarCollapse = document.querySelector("#navbarCollapse");
    
    function toggleNavbar() {
      navbarToggler.classList.toggle("navbarTogglerActive");
      navbarOverlay.classList.toggle("visible")
      if (navbarToggler.classList.contains("navbarTogglerActive")) {
        //topbar.classList.add("bg-white", 'text-primary')
      } else {
        //topbar.classList.remove("bg-white", 'text-primary')
      }
      navbarCollapse.classList.toggle("navbar-hidden");
    }

    navbarToggler.addEventListener("click", () => {
      toggleNavbar()
    });

    navbarOverlay.addEventListener("click", () => {
      toggleNavbar()
    });

    //===== close navbar-collapse when a  clicked
    document
      .querySelectorAll("#navbarCollapse ul li:not(.submenu-item) a")
      .forEach((e) =>
        e.addEventListener("click", () => {
          navbarToggler.classList.remove("navbarTogglerActive");
          navbarCollapse.classList.add("navbar-hidden");
        })
      );
    
    
    // ===== wow js
    new WOW().init();

    // ====== scroll top js
    function scrollTo(element, to = 0, duration = 500) {
      const start = element.scrollTop;
      const change = to - start;
      const increment = 20;
      let currentTime = 0;

      const animateScroll = () => {
        currentTime += increment;

        const val = Math.easeInOutQuad(currentTime, start, change, duration);

        element.scrollTop = val;

        if (currentTime < duration) {
          setTimeout(animateScroll, increment);
        }
      };

      animateScroll();
    }

    Math.easeInOutQuad = function (t, b, c, d) {
      t /= d / 2;
      if (t < 1) return (c / 2) * t * t + b;
      t--;
      return (-c / 2) * (t * (t - 2) - 1) + b;
    };

    document.querySelector(".back-to-top").addEventListener('click', () => {
      scrollTo(document.documentElement);
    });
  }

  // ====== Tabs Component
  document.querySelectorAll(".tabs-nav").forEach(tabsNav => {
    let tabTogglers = tabsNav.querySelectorAll(".tab-link");

    tabTogglers.forEach((toggler, index) => {
      let tabName = toggler.getAttribute("href");
      let tabContents = 'hey';
      if (tabsNav.nextElementSibling.id.includes("tab-contents") || tabsNav.nextElementSibling.classList.contains("tab-contents")) {
        tabContents = tabsNav.nextElementSibling
      } else {
        tabContents = tabsNav.nextElementSibling.querySelector('#tab-contents')
      }

      // Change active tab if href same as url hash
      if (tabName == window.location.hash && index > 0) {
        toggler.classList.add('active-tab')
        tabTogglers[0].classList.remove('active-tab')

        tabContents.children[0].classList.add('hidden')
        tabContents.children[index].classList.remove('hidden')
      }

      toggler.addEventListener("click", e => {
        e.preventDefault();
        //console.log(tabTogglers)
        for (let i = 0; i < tabContents.children.length; i++) {

          tabTogglers[i].classList.remove("active-tab");
          tabContents.children[i].classList.remove("hidden");

          if ("#" + tabContents.children[i].id === tabName) {
            continue;
          }
          tabContents.children[i].classList.add("hidden");
          
        }
        e.target.closest('.tab-link').classList.add("active-tab");
        
      });
    });
  })

})();

// ===== Sidebar nav
let sidebarNav = document.querySelector('.sidebar-nav'),
    sidebarLinks = document.querySelector('.sidebar-nav .sidebar-links'),
    toggleSidebarBtn = document.getElementById('toggleSidebarBtn');

if (sidebarNav) {
  function toggleSidebar() {
    sidebarNav.classList.toggle('collapsed')
    sidebarNav.classList.contains('collapsed') ? localStorage.setItem('sidebarState', 'collapsed') : localStorage.setItem('sidebarState', 'expanded')
  }

  if (window.innerWidth > 960 && localStorage.getItem('sidebarState') == 'collapsed') {
    sidebarNav.classList.add('collapsed')
  } else {
    sidebarNav.classList.remove('collapsed')
  }

  let activePage = sidebarLinks.querySelector('.active')
  if (activePage) {
    sidebarLinks.scrollTop = sidebarLinks.querySelector('.active').offsetTop - 200
  }
}

// ===== Modal
// This function is called when a button is clicked
function showModal(id) {
  document.querySelectorAll('.modal').forEach(item => {
    item.classList.add('hidden')
  })
  const modal = document.getElementById(id);
  modal.classList.remove('hidden');
}

// This function is called when the close button is clicked
function closeModal(id) {
  const modal = document.getElementById(id);
  modal.classList.add('hidden');
}

// ======= Countdown Date
// Set target date (YYYY-MM-DDTHH:MM:SS)
const targetDate = new Date("2025-05-30T00:00:00").getTime();

const updateCountdown = () => {
  const now = new Date().getTime();
  const distance = targetDate - now;

  if (distance < 0) {
    clearInterval(updateCountdown);
    return;
  }

  const days = Math.floor(distance / (1000 * 60 * 60 * 24));
  const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  const seconds = Math.floor((distance % (1000 * 60)) / 1000);

  document.getElementById("days").textContent = String(days).padStart(2, '0');
  document.getElementById("hours").textContent = String(hours).padStart(2, '0');
  document.getElementById("minutes").textContent = String(minutes).padStart(2, '0');
  document.getElementById("seconds").textContent = String(seconds).padStart(2, '0');
};

if (document.querySelector(".countdown")) {
  updateCountdown();
  setInterval(updateCountdown, 1000);
}

// ====== Auto Resize Textarea
document.querySelectorAll('.auto-resize-textarea').forEach(item => {
  item.addEventListener('input', e => {
    if (e.target.scrollHeight <= 200) {
      e.target.style.overflow = 'hidden'
      e.target.style.height = 'auto'
      e.target.style.height = e.target.scrollHeight + 'px'
    } else {
      e.target.style.overflow = 'auto'
    }
  })
})

// ====== Hide Alert
let alertEl = document.querySelector('.alert')
if (alertEl) {
  alertEl.classList.remove('alert-hidden')
  setTimeout(() => {
    alertEl.classList.add('alert-hidden')
  }, 2500);
}
