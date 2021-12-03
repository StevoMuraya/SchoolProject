let unit_card = document.getElementsByClassName("unit-card");
let user_pop_close = document.getElementById("user_pop_close");
let user_pop_info = document.getElementById("user_pop_info");

let unit_code = document.getElementById("unit_code");
let unit_name = document.getElementById("unit_name");
let unit_department = document.getElementById("unit_department");

let user_pop_image = document.getElementById("user_pop_image");
let user_pop_name = document.getElementById("user_pop_name");
let user_pop_id = document.getElementById("user_pop_id");
let user_pop_department = document.getElementById("user_pop_department");
let user_pop_email = document.getElementById("user_pop_email");
let user_pop_phone = document.getElementById("user_pop_phone");

user_pop_close.addEventListener("click", function () {
  user_pop_info.classList.remove("show");
  user_pop_close.classList.remove("show");
});

for (let i = 0; i < unit_card.length; i++) {
  unit_card[i].addEventListener("click", function () {
    user_pop_info.classList.add("show");
    user_pop_close.classList.add("show");

    let unit_code_ = this.getElementsByClassName("unit-info")[0].innerHTML;
    let unit_name_ = this.getElementsByClassName("unit-info")[1].innerHTML;
    let unit_department_ =
      this.getElementsByClassName("unit-info")[2].innerHTML;

    unit_code.value = unit_code_;
    unit_name.value = unit_name_;
    unit_department.value = unit_department_;
  });
}
