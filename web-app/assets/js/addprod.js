// let addButt = document.querySelector(".add-product-button");
// let addButPole = document.querySelector(".add-product-button");
// let addInBD = document.querySelector(".add-button");
// let pole = document.querySelector(".add-pole");

// addButt.onclick = function () {
//   addButPole.classList.toggle("hidden");
//   pole.classList.toggle("hidden");
// };

// addInBD.onclick = function () {
//   addButPole.classList.toggle("hidden");
//   pole.classList.toggle("hidden");
// };

let mainButton = document.querySelector(".add-product-button");
let pole = document.querySelector(".add-pole");

mainButton.onclick = function () {
  mainButton.classList.toggle("hidden");
  pole.classList.toggle("hidden");
};

let noProd = document.querySelector(".no-product");
let addUser = document.querySelector(".add-in-user");
let addGlobal = document.querySelector(".add-in-db");

noProd.onclick = function () {
  noProd.classList.toggle("hidden");
  addUser.classList.toggle("hidden");
  addGlobal.classList.toggle("hidden");
};

let buttUser = document.querySelector(".add-but-user");

buttUser.onclick = function () {
  mainButton.classList.toggle("hidden");
  pole.classList.toggle("hidden");
};

let buttDB = document.querySelector(".add-but-db");

buttDB.onclick = function () {
  noProd.classList.toggle("hidden");
  addUser.classList.toggle("hidden");
  addGlobal.classList.toggle("hidden");
};
