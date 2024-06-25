let reg_form = document.querySelector(".registration");
let button_reg = document.querySelector(".reg_button");

let log_form = document.querySelector(".authorization");
let button_log = document.querySelector(".log_button");

button_reg.onclick = function () {
  reg_form.classList.toggle("hidden");
};

button_log.onclick = function () {
  log_form.classList.toggle("hidden");
};
