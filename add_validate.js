function isNumeric(zip){
	var numericExpression = /^[0-9]+$/;
	if(zip.value.match(numericExpression)){
		return true;
	}else{
		alert("Please enter a 5 digit zip code");
		zip.focus();
		return false;
	}
}
