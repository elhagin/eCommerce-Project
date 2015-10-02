<?php 
	class User
		{
			private $db;//database PDO Object
			function __construct($db)
			{
				$this->db = $db;
			}
			//returns array with products
			function getProducts($numberOfProducts = 12 , $offset = 0){

				try {
					$stmt = $this->db->prepare('SELECT * FROM products Order By regdate DESC Limit :productsNumber
					 offset :offset ;');
		            // $stmt->execute(array('productsNumber' => $numberOfProducts ,'offset' => $offset ));
		            
		            $stmt->bindParam(':productsNumber', $numberOfProducts, PDO::PARAM_INT);
		            $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
		            $stmt->execute();
		            $row = $stmt->fetchAll();
		            return $row;
				} catch (PDOException $e) {
					echo "<div>".$e->getMessage()."</div>";
				}

			}
			function getaProductByID($product_id){
				try {
					$stmt = $this->db->prepare('SELECT * FROM products where product_id = :productID');
		            $stmt->bindParam(':productID', $product_id, PDO::PARAM_INT);
		            $stmt->execute();
		            $row = $stmt->fetchAll();
		            return $row;
				} catch (PDOException $e) {
					echo "<div>".$e->getMessage()."</div>";
				}
			}
			function hasBoughtBefore($buyer_id , $product_id){
				try {
					$stmt = $this->db->prepare('SELECT * FROM `cart-items` where product_id = :productID and buyer_id = :buyer');
		            $stmt->bindParam(':productID', $product_id, PDO::PARAM_INT);
		            $stmt->bindParam(':buyer',$buyer_id,PDO::PARAM_INT);
		            $stmt->execute();
		            $row = $stmt->fetchAll();
		            if (count($row) > 0){
		            	return true;
		            }
		            else{
		            	return false;
		            }
				} catch (PDOException $e) {
					echo "<div>".$e->getMessage()."</div>";
				}
			}
			//add item to cart
			function addToCart($product_id){
				//not finished
				try {
					
					//delete this fucking line
					
					//until here :D
					$prod = $this->getaProductByID($product_id);
					
					if ($prod[0]['stock'] > 0 ) {
						
						if ($this->hasBoughtBefore($_SESSION['id'],$product_id)) {
							
							$stmt = $this->db->prepare('UPDATE `cart-items` SET quantity = quantity + 1 Where product_id = :productID AND buyer_id = :buyerID');
				            $stmt->bindParam(':productID', $product_id, PDO::PARAM_INT);
				            $stmt->bindParam(':buyerID', $_SESSION['id'], PDO::PARAM_INT);
				            $stmt->execute();
				            $this->decreaseProduct($product_id,1);

						} else {

							
							$stmt = $this->db->prepare('INSERT into `cart-items` (product_id , buyer_id , quantity) values (:productId , :sessionId , :quantity)');
				            $stmt->bindParam(':productId', $product_id, PDO::PARAM_INT);
				            $stmt->bindParam(':sessionId', $_SESSION['id'], PDO::PARAM_INT);
				            $new_quantity = 1;
				            $stmt->bindParam(':quantity', $new_quantity, PDO::PARAM_INT);
				            $stmt->execute();
				            
				            
				            $this->decreaseProduct($product_id,1);
				            
				            return true;
						}
						
						
						
					}
					
				} catch (PDOException $e) {
					echo "<div>".$e->getMessage()."</div>";
				}
			}
			function getCartItems($buyer_id){
				try {
						$stmt = $this->db->prepare('SELECT * from `cart-items` where buyer_id = :buyerID ');
			            $stmt->bindParam(':buyerID', intval($buyer_id), PDO::PARAM_INT);
			            $stmt->execute();
			            $row = $stmt->fetchAll();
			            return $row;
				} catch (PDOException $e) {
					echo "<div>".$e->getMessage()."</div>";
				}
			}
			function decreaseProduct($product_id,$quantity){
				try {
							$stmt = $this->db->prepare('UPDATE products SET stock = stock - 1 Where product_id = :productID');
				            $stmt->bindParam(':productID', $product_id, PDO::PARAM_INT);
				            $stmt->execute();
				} catch (PDOException $e) {
					echo "<div>".$e->getMessage()."</div>";
				}
			}
			function getTotalCartPrice($owner_id){
				try {
					$stmt = $this->db->prepare('SELECT SUM( c.quantity * p.price ) AS totalprice
						FROM  `cart-items` c
						INNER JOIN  `products` p ON p.product_id = c.product_id
						WHERE c.buyer_id = :buyerID');
					$stmt->bindParam(':buyerID', $owner_id, PDO::PARAM_INT);
					$stmt->execute();
					$row = $stmt->fetchAll();
					return $row[0]['totalprice'];
				} catch (PDOException $e) {
					echo "<div>".$e->getMessage()."</div>";
				}
				
			}
			function getCartItemsCount($owner_id){
				try {

					$stmt = $this->db->prepare('SELECT SUM(quantity) AS totalitems
						FROM  `cart-items`
						WHERE buyer_id = :buyerID');
					$stmt->bindParam(':buyerID', $owner_id, PDO::PARAM_INT);
					$stmt->execute();
					$row = $stmt->fetchAll();
					return $row[0]['totalitems'];
				} catch (PDOException $e) {
					echo "<div>".$e->getMessage()."</div>";
				}
				
			}

			
		}
 ?>