<?php
namespace aitsydney
class Product extends Database{
public $products = array();
public function__construct(){
parent::__construct();
}
public function getProducts(){
    $query="SELECT
@product_id := product.product_id AS product_id,
product.name,
product.description,
product.price,
(SELECT @image_id := product_image.image_id FROM product_image WHERE product_image.product_ID= @product_id LIMIT 1) AS image_id,
(SELECT image_file_name FROM image WHERE image.image_id = @image_id) AS image
from product";

$statement = $this -> connection -> prepare($query);
if ($statement -> execute() ) {
    $result = $statement -> get_result();
    while(row = $result -> fetch_assoc() ){
        array_push($this-> products, $row );
    }
}
return $this -> products;
}
ublic function getProductDetail($id){
    $query = "SELECT
    product_id,
    name,
    description,
    price
    FROM `product` WHERE product_id = ?";

    $statement = $this -> connection -> prepare ( $query );
    $statement -> bind_param( 'i', $id );
         if ($statement -> execute()) {
             $product_detail = array();
             $result = $statement -> get_result();
             $row = $result -> fetch_assos();
             $product_detail['product'] = $row;
             return $product_detail;    
         }
         
     }
}
?>