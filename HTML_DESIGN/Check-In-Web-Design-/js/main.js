let data_dropdown = document.getElementById("data_dropdown");
let data_droppeddown = document.getElementById("data_droppeddown");
let hamburger = document.getElementById("hamburger");
let side_nav = document.getElementById("side_nav");
let top_nav = document.getElementById("top_nav");
let nav_overlay = document.getElementById("nav_overlay");
let dash_content = document.getElementById("dash_content");

data_dropdown.addEventListener("click", function () {
  data_droppeddown.classList.toggle("show");
  data_dropdown.classList.toggle("actives");
});

hamburger.addEventListener("click", function () {
  side_nav.classList.toggle("show");
  nav_overlay.classList.toggle("show");
  // dash_content.classList.toggle("move-left");
  top_nav.classList.toggle("move-left");
  hamburger.classList.toggle("active");
});

nav_overlay.addEventListener("click", function () {
  side_nav.classList.toggle("show");
  nav_overlay.classList.toggle("show");
  // dash_content.classList.toggle("move-left");
  top_nav.classList.toggle("move-left");
  hamburger.classList.toggle("active");
});
