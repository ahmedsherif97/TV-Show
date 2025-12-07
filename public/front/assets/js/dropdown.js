// ====== Dropdown
function toggleDropdown(button) {
  // Close any other open dropdowns
  document.querySelectorAll(".dropdown-menu").forEach((dropdown) => {
    if (dropdown.previousElementSibling !== button) {
      dropdown.classList.add("hidden");

      if (dropdown.previousElementSibling.classList.contains("activable")) {
        dropdown.previousElementSibling.classList.remove(
          "bg-white",
          "text-primary"
        );
      }
    }
  });

  // Toggle the clicked dropdown
  button.nextElementSibling.classList.toggle("hidden");
  button.classList.toggle('rotate-arrow')

  if (button.classList.contains("activable")) {
    button.classList.toggle("bg-white");
    button.classList.toggle("text-primary");
  }

  // dynamic position of menu based on available space
  let dropdownMenu = button.nextElementSibling,
      clientTop = dropdownMenu.getBoundingClientRect().top,
      clientBottom = dropdownMenu.getBoundingClientRect().bottom;
  if (window.innerHeight - clientTop < dropdownMenu.clientHeight) {
    //scrollTo(dropdownMenu, window.scrollY + button.closest('.w-full').offsetTop, 500)
    dropdownMenu.classList.add('bottom-full', 'mb-1')
  } else {
    dropdownMenu.classList.remove('bottom-full', 'mb-1')
  }
}

function selectDropdown(option, value, doSubmit) {
  let selectedOption = option.innerHTML;
  // Remove active class from all options
  option
    .closest(".dropdown-menu")
    .querySelectorAll("li")
    .forEach((optionEl) => {
      optionEl.querySelector("a").classList.remove("active");
    });
  // Change value of the input related to dropdown
  if (value) {
    option.closest(".dropdown-wrapper").previousElementSibling.value = value;
  }

  option.classList.add("active");
  option.closest(".dropdown-menu").previousElementSibling.classList.toggle('rotate-arrow')
  // Change outer dropdown content to the selected option
  option
    .closest(".dropdown-menu")
    .previousElementSibling.querySelector(".dropdown-text").innerHTML = selectedOption;
  option.closest(".dropdown-menu").classList.add("hidden");

  // Submit form
  let form = option.closest('form')
  if (form && doSubmit) form.submit()
}

// Change the placeholder to the cuurently active option on page load
document.querySelectorAll('.dropdown-menu').forEach(menu => {
  let activeDropdownItem = menu.querySelector('.active')
  if (activeDropdownItem) {
    menu.previousElementSibling.querySelector('.dropdown-text').innerHTML = activeDropdownItem.innerHTML
  }
})

// Hide dropdowns when clicking outside
document.addEventListener("click", function (event) {
  let isClickInside = false;

  document.querySelectorAll(".dropdown-menu").forEach((dropdown) => {
    if (
      dropdown.contains(event.target) ||
      dropdown.previousElementSibling.contains(event.target)
    ) {
      isClickInside = true;
    }
  });

  if (!isClickInside) {
    document.querySelectorAll(".dropdown-menu").forEach((dropdown) => {
      dropdown.classList.add("hidden");

      if (dropdown.previousElementSibling.classList.contains("activable")) {
        dropdown.previousElementSibling.classList.remove(
          "bg-white",
          "text-primary"
        );
      }
    });
  }
});