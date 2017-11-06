function exec(id) {
	if(document.getElementById('fromcity').value.length == 0 && document.getElementById('tocity').value.length == 0){			
		if(window.confirm("Is this your source city: "+id)){
			fromcity = id;
			document.getElementById('fromcity').value = id;

		}else{
			document.getElementById('fromcity').value = "";
		}
	}
	else if(document.getElementById('fromcity').value.length != 0 && document.getElementById('tocity').value.length == 0){
		if(window.confirm("Is this your destination city: "+id)){
			tocity = id;
			document.getElementById('tocity').value = id;
		}
		else{
			document.getElementById('tocity').value = "";
		}
	}
}

// function show(id) {
// 	// console.log(fromset+" "+toset);
// 	if(document.getElementById('fromcity').value.length == 0)
// 		document.getElementById('fromcity').value = id;
// 	else if(document.getElementById('tocity').value.length == 0)
// 		document.getElementById('tocity').value = id;
// }

function reset() {
	window.location.reload();
}