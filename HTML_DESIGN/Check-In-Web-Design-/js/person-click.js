let user_card = document.getElementsByClassName("person-card");
let user_pop_close = document.getElementById("user_pop_close");
let user_pop_info = document.getElementById("user_pop_info");

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

for (let i = 0; i < user_card.length; i++) {
  user_card[i].addEventListener("click", function () {
    user_pop_info.classList.add("show");
    user_pop_close.classList.add("show");

    let user_image_holder = this.getElementsByClassName(
      "person-image-holder"
    )[0];
    let user_image =
      user_image_holder.getElementsByClassName("person-image")[0];

    let user_info = this.getElementsByClassName("person-info")[0];
    let user_name =
      user_info.getElementsByClassName("person-name")[0].innerHTML;
    let user_department =
      user_info.getElementsByClassName("person-department")[0].innerHTML;
    let user_id = user_info.getElementsByClassName("person-id")[0].innerHTML;
    let user_email =
      user_info.getElementsByClassName("person-email")[0].innerHTML;
    let user_phone =
      user_info.getElementsByClassName("person-phone")[0].innerHTML;

    user_pop_image.src = user_image.src;
    user_pop_name.innerHTML = user_name;
    user_pop_department.innerHTML = user_department;
    user_pop_id.innerHTML = user_id;
    user_pop_email.innerHTML = user_email;
    user_pop_phone.innerHTML = user_phone;

    // modal_overlay.style.transform = "scale(1)";
    // modal_overlay.style.opacity = "1";
    // modal_pic.style.transform = "scale(1)";
  });
}
