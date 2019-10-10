let queueCount;

$('#allProducts').load('php/getInitalItems.php');
$.get('php/getTotalCount.php', function(data) {
	console.log(data);
	queueCount = data - 6;

	if(queueCount < 0) {
		queueCount = 0;
	}

	$('#count').html(queueCount);	
});

$(document).ready(function() {
  setInterval(function() {
	let products = document.querySelectorAll('.productInfo');  	
	if(products.length > 0) {
		let lastProductCreatedDate = products[products.length-1].querySelector('span').innerHTML;

		$.ajax({
			url: 'php/getNextItem.php',
			data: {
				createdDate: lastProductCreatedDate
			},
			success: function(data) {
				$('#allProducts').append(data);
				products[0].parentNode.removeChild(products[0]);
			}
		});	

		if(queueCount > 0) {
			queueCount--;	
		}

		$('#count').html(queueCount);
	}
	
  }, 30 * 1000);
});

$('#queueBtn').click(function() {
	if(queueCount > 0) {
		let products = document.querySelectorAll('.productInfo');
		window.location.href = encodeURI('php/showQueue.php?createdDate=' + products[products.length-1].querySelector('span').innerHTML);
	} else {
		alert('Queue is empty!');
	}
})