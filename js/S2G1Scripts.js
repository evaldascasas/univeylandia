
var contador = 0;       //variable per a tancar la finestra que es mou despres de X interaccions

/*Joc que demana a l'usuari el seu nom i el substitueix en un text, també afegeix al final del text una
despedida amb el nom de l'usuari. Finalment pregunta a l'usuari quants caracters creu que hi han, i
mostra els que hi han i diu si ha encertat o no*/

/*Fem els canvis en el text amb el nom de l'usari*/
function replace() {
  var nom = prompt("Introdueix el teu nom");
  var str = document.getElementById("paragraf1").innerHTML;
  var resultat = str.replace("nom", nom);
  resultat = resultat.concat(" Tothom estimava molt a ",nom);
  document.getElementById("paragraf1").innerHTML = resultat;
}

/*Comptem els caracters*/
function comptar(){
  var str = document.getElementById("paragraf1").innerHTML;
  var numero = str.length;
  var resultat = "Hi han " + numero + " lletres.";
  document.getElementById("paragraf3").innerHTML = resultat;
}

//JavaScript Number
function visitantsArrodonits() {
    var numvisitants = Number(Math.floor(Math.random() * 10000));
    document.getElementById("visitantdiaris").innerHTML = "El numero de visitants es: " + numvisitants.toPrecision() +   " k";
}

function visitantsFixats() {
    var numvisitants = Number(Math.floor(Math.random() * 10000));
    document.getElementById("visitantdiaris2").innerHTML = "El numero de visitants es: " + numvisitants.toFixed(2) +   " k";
}


//JavaScript Navigator
function infonav(){
    document.getElementById("infonav").innerHTML = navigator.platform;
    document.getElementById("infonav2").innerHTML = navigator.appVersion;
    document.getElementById("infonav3").innerHTML =
"cookiesEnabled is " + navigator.cookieEnabled;
}

//JavaScript Screen
function infoscreen() {

    document.getElementById("infoscreen").innerHTML =
"Screen Width: " + screen.width;
    document.getElementById("infoscreen1").innerHTML =
"Screen Height: " + screen.height;
    document.getElementById("infoscreen2").innerHTML =
"Screen Pixel Depth: " + screen.pixelDepth;
}

function proba(){
    alert("hola");
}
//JavaScript History
function goBack() {
    window.history.back()
}

function goForward() {
    window.history.forward()
}

//JavaScript Location
function locationURL(){
    document.getElementById("url").innerHTML = window.location.href;
}

function locationAssign(){
     window.location.assign("https://www.portaventuraworld.com/")
}

//JavaScript Document, Window
function finestraPromocio(){
    //setTimeout(function(){ alert("Estas preparat per al Nadal?"); }, 5000);
    myWindow1=window.open('','Ventana','width=720,height=480')
	myWindow1.document.write('<html>')
	myWindow1.document.write('<head>')
	myWindow1.document.write('<title>UNIVEYLANDIA Promocio WINTER2K18</title>')
	myWindow1.document.write('</head>')
	myWindow1.document.write('<body>')
    myWindow1.document.write('<img src= "img/UNIVEYLANDIAPromocioNadal.jpg" />')
	myWindow1.document.write('</body>')
	myWindow1.document.write('</html>')
  myWindow1.setInterval(moveFinetraPromocio, 60);

}

function moveFinetraPromocio(){
    myWindow1.moveBy(1, 0);
    ++contador;
    if (contador == 500){
      myWindow1.close();
    }

}

var num3 = 0;

function GenerarCaptchaNumeric(){
    var operacioCaptcha = Math.ceil(Math.random()* 3) ;
    var num1 = Math.ceil(Math.random()* 10);
    var num2 = Math.ceil(Math.random()* 10);
    var mostrarOperacioCaptcha = 0;
    if(operacioCaptcha == 1) {
        num3 = eval(num1 + num2);
        mostrarOperacioCaptcha = num1 + '+' + num2 + '=';
        document.getElementById("captcha").innerHTML = mostrarOperacioCaptcha;
    }
    if(operacioCaptcha == 2){
        num3 = eval(num1 - num2);
        mostrarOperacioCaptcha = num1 + '-' + num2 + '=';
        document.getElementById("captcha").innerHTML = mostrarOperacioCaptcha;
    }
   if(operacioCaptcha == 3){
        num3 = eval(num1 * num2);
        mostrarOperacioCaptcha = num1 + '*' + num2 + '=';
        document.getElementById("captcha").innerHTML = mostrarOperacioCaptcha;
    }
}

function ComprovarCaptchaNumeric() {
    var resultatCaptcha = parseFloat(document.getElementById("resultatCaptcha").value);
    if(resultatCaptcha === num3) {
    alert("CAPTCHA SUPERAT");
    }
    else {

        alert("CAPTCHA NO SUPERAT");
    }
}

var valorImatge = "";

function GenerarCaptchaImatge(){

    var seleccionarImatge = Math.ceil(Math.random()*5);
    //var valorImatge = "";

    var coche = "img/captcha/captcha1.jpg";
    var moto = "img/captcha/captcha2.jpg";
    var avio = "img/captcha/captcha3.jpg";
    var bus = "img/captcha/captcha4.jpg";
    var camio = "img/captcha/captcha5.jpg";

    if(seleccionarImatge == 1){
        document.getElementById("imagenCaptchaNumeric").src = coche;
        valorImatge = "coche";
    }
    if(seleccionarImatge == 2){
        document.getElementById("imagenCaptchaNumeric").src = moto;
        valorImatge = "moto";
    }
    if(seleccionarImatge == 3){
        document.getElementById("imagenCaptchaNumeric").src = avio;
        valorImatge = "avio";
    }
    if(seleccionarImatge == 4){
        document.getElementById("imagenCaptchaNumeric").src = bus;
        valorImatge = "bus";
    }
    if(seleccionarImatge == 5){
        document.getElementById("imagenCaptchaNumeric").src = camio;
        valorImatge = "camio";
    }
}

function ComprovarCaptchaImatge(){
    var resultatCaptchaImatge = document.getElementById("resultatCaptchaImatge").value;
    if(resultatCaptchaImatge === valorImatge) {
    alert("CAPTCHA SUPERAT");
    }
    else {

        alert("CAPTCHA NO SUPERAT");
    }
}

function display_hidden_fields(){
    var paco = document.getElementById("hidden");

    if(paco.style.display == "none"){
      paco.style.display = "block";
      GenerarCaptchaImatge();
    }else{
      paco.style.display = "none";
    }
}
