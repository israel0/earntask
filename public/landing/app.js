const toggleButton = document.getElementById("checkbox");
const menu = document.getElementById("mobile_menu");

function toggleMenu() {
  if (menu.classList.contains("flex")) {
  } else {
  }
  menu.classList.toggle("hidden");
}
toggleButton.addEventListener("click", toggleMenu);


