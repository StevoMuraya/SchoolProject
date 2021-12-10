let unit_card = document.getElementsByClassName("unit-card");
let user_pop_close = document.getElementById("user_pop_close");
let user_pop_info = document.getElementById("user_pop_info");
let form_action = document.getElementById("update_form_action");
let delete_action = document.getElementById("delete_action");
let unit_analysis = document.getElementById("unit_analysis");
let update_link = document.getElementById("update_link");
let analysis_link = document.getElementById("analysis_link");

let unit_code = document.getElementById("unit_code");
let unit_name = document.getElementById("unit_name");
let unit_department = document.getElementById("unit_department");

user_pop_close.addEventListener("click", function () {
    user_pop_info.classList.remove("show");
    user_pop_close.classList.remove("show");
});

for (let i = 0; i < unit_card.length; i++) {
    unit_card[i].addEventListener("dblclick", function () {
        user_pop_info.classList.add("show");
        user_pop_close.classList.add("show");

        let unit_code_ = this.getElementsByClassName("unit-info")[0];
        unit_code_ = unit_code_.getElementsByTagName("p")[0];
        unit_code_ = unit_code_.getElementsByTagName("span")[1].innerHTML;
        console.log(unit_code_);

        let unit_name_ = this.getElementsByClassName("unit-info")[1];
        unit_name_ = unit_name_.getElementsByTagName("p")[0];
        unit_name_ = unit_name_.getElementsByTagName("span")[1].innerHTML;
        console.log(unit_name_);

        let unit_department_ = this.getElementsByClassName("unit-info")[2];
        unit_department_ = unit_department_.getElementsByTagName("p")[0];
        unit_department_ =
            unit_department_.getElementsByTagName("span")[1].innerHTML;
        console.log(unit_department_);

        let unit_id_ = this.getElementsByClassName("unit-info")[3].innerHTML;

        let link = update_link.innerHTML;
        let link2 = analysis_link.innerHTML;
        console.log();

        delete_action.action = link + unit_id_;
        form_action.action = link + unit_id_;
        unit_analysis.href = link2 + unit_id_;

        unit_code.value = unit_code_;
        unit_name.value = unit_name_;
        unit_department.value = unit_department_;
    });
}
