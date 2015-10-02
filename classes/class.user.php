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
		            $stmt->bindParam(':buyer_id',$buyer_id,PDO::PARAM_INT);
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
					$prod = $this->getaProductByID($product_id);
					if (intval($prod['stock']) > 0 ) {
						$stmt = $this->db->prepare('INSERT into `cart-items` (product_id , buyer_id , quantity) values (:productId , :sessionId , :quantity)');
			            $stmt->bindParam(':productId', $product_id, PDO::PARAM_INT);
			            $stmt->bindParam(':sessionId', $_SESSION['id'], PDO::PARAM_INT);
			            $new_quantity = intval($prod['stock'] - 1);
			            $stmt->bindParam(':quantity', $new_quantity, PDO::PARAM_INT);
			            $stmt->execute();
			            $row = $stmt->fetchAll();
			            return $row;
					}
				} catch (PDOException $e) {
					echo "<div>".$e->getMessage()."</div>";
				}
			}

			
		}
 ?>