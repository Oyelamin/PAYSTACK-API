<html>
	<head>
		<title>Paystack Inline</title>
		<!-- Paystack Library is ready to fly -->
		<script src='https://js.paystack.co/v1/inline.js'></script> 
	</head>
	<style type="text/css">
		input, button {
			margin: 2px;
			padding: 10px;
		}
		button {
			background-color: blue;
			color: white;
			border: 0px;
			cursor: pointer;
		}
	</style>
	<body>
		<div></div>
		<button>Make Payment</button>
	</body>
	<script type="text/javascript">
		
		function makepayment(key, email, amount, ref, callback) {
			var handler = PaystackPop.setup({
				key: key, // This is your public key only! 
				email: email || 'customer@email.com', // Customers email
				amount: amount || 5000000.00, // The amount charged, I like big money lol
				ref: ref || 6019, // Generate a random reference number and put here",
				metadata: { // More custom information about the transaction
				 custom_fields: [
					{}
				 ]
				},
				callback: callback || function(response){
				  let div = document.getElementsByTagName("div")[0] 
				  div.innerHTML = "This was the json response reference </br />" + response.reference;
				},
				onClose: function(){
				  alert('window closed');
				}
			});
			// Payment Request Just Fired  
			handler.openIframe(); 
		}
		let dom = document.getElementsByTagName("button")[0];
		dom.addEventListener("click", function() {
			makepayment("pk_test_027b0ed8bbf544d8b7b53e3a3e11576bef57b313") // edit this and input your public key .. This is mine, please pay in ony big money lol
		});
	</script>
</html>
