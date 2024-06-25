const poductTemplate = document.querySelector("#product-template").content;
const stepsTemplate = document.querySelector("#steps-template").content;

const stepList = document.querySelector(".steps");
const prodList = document.querySelector(".ingridients");

let prodButton = document.querySelector(".add-prod");
let stepButton = document.querySelector(".add-step");

stepButton.onclick = function () {
  let newStep = stepsTemplate.querySelector(".js-steps").cloneNode(true);
  stepList.appendChild(newStep);
};

prodButton.onclick = function () {
  let newProd = poductTemplate.querySelector(".js-prod").cloneNode(true);
  prodList.appendChild(newProd);
};
