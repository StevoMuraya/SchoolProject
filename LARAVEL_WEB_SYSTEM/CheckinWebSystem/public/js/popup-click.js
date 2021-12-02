let trigger = document.getElementById("trigger");
let register_popup = document.getElementById("register_popup");
let close_reg_pop = document.getElementById("close_reg_pop");

trigger.addEventListener("click", function () {
  register_popup.classList.add("show");
});
close_reg_pop.addEventListener("click", function () {
  register_popup.classList.remove("show");
});
