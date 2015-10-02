<?php 
	if(isset($_GET['action']) and $_GET['action'] == 'add'){
		$user->addToCart(intval($_GET['id']));
	}
	$products = $user->getProducts(12,0);

 ?>