<?php
	

	if(isset($_GET['action']) and $_GET['action'] == 'add'){
		$user->addToCart(intval($_GET['id']));
	}

	$cart_total_price = $user->getTotalCartPrice($_SESSION['id']);
	
	$cart_total_items = $user->getCartItemsCount($_SESSION['id']);
	
	$products = $user->getProducts(12,0);

 ?>