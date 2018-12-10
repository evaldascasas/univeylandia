function addProduct(code){
	if(getElementById("foto")){
		var amount = document.getElementById(code).value;
		window.location.href = 'index.php?action=add&code='+foto+'&amount='+amount;
	}
}
function deleteProduct(code){
	window.location.href = 'index.php?action=remove&code='+code;
}
