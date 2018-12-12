var tipusEntrada = ["Bàsica - 40€", "Turbo - 60€"];
var restaurantDinar = ["UniveyPizza", "UniveySushi"];
var restaurantSopar = ["UniveyPizza", "UniveySushi"];
var entrada;

function myOnLoad() {
  imprimirTipusEntrada();
  imprimirRestaurantDinar();
  imprimirRestaurantSopar();
}

function imprimirTipusEntrada() {
  tipusEntrada.sort();
  addOptions("tipus", tipusEntrada);
}

function imprimirRestaurantDinar() {
  restaurantDinar.sort();
  addOptions("restDinar", restaurantDinar);
}

function imprimirRestaurantSopar() {
  restaurantSopar.sort();
  addOptions("restSopar", restaurantSopar);
}

function addOptions(domElement, array) {
  var select = document.getElementsByName(domElement)[0];

  for (value in array) {
    var option = document.createElement("option");
    option.text = array[value];
    select.add(option);
  }
}

function agafarDades() {
  var optionTipus = document.getElementById("tipus");
  var opTi = optionTipus.options[optionTipus.selectedIndex].text;
  var optionDinar = document.getElementById("restDinar");
  var opDi = optionDinar.options[optionDinar.selectedIndex].text;
  var optionSopar = document.getElementById("restSopar");
  var opSo = optionSopar.options[optionSopar.selectedIndex].text;

  entrada = [opTi, opDi, opSo];

  for (i=0;i<entrada.length;i++) {
    document.getElementById("resum").innerHTML = entrada;
  }
}
