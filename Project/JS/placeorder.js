function ValidateEmail(par){
	var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
	if(par.value.match(mailformat)){
		return true;
	}
	else{
		window.alert("You have entered an invalid email address!");
		return false;
	}
}

function phonenumber(par){
	var phonenum = /^\d{10}$/;
	if(par.value.match(phonenum)){
		return true;
	}
	else{
		alert("Enter a valid phone number without country code");
		return false;
	}
}

function validate(form) {
	ValidateEmail(document.orderform.femailid);
	ValidateEmail(document.orderform.temailid);
	phonenumber(document.orderform.fmobno);
	phonenumber(document.orderform.tmobno);
}