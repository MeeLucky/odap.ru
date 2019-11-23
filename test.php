<script>
	let val = "2:12,32";
	console.log(val);
	val = val.split('');

	let dot1 = val.indexOf(',');
	let dot2 = val.indexOf(':');

	// console.log(dot1);
	// console.log(val.length-3);
	if(val.length -2 != dot1) {
		console.log("return");
	}

	if(dot1 > 0) {
		let temp = val[dot1];
		val[dot1] = val[dot1-1]
		val[dot1-1] = temp;
	}

	if(dot2 > 0) {
		let temp = val[dot2];
		val[dot2] = val[dot2-1]
		val[dot2-1] = temp;
	}

	if(val[0] == ":")
		val[0] = "";

	let len = val.length;
	let res = "";
	for(let i = 0; i < len; i++) 
		res += val[i];
	

	console.log(res.trim());

	// console.log(dot1 + " : " + dot2);

	// console.log(res);
</script>