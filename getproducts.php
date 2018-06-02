<?php
// set header for api reaponse

header('Access-Control-Allow-Origin: *');
// this is public api so * means any can access
header('Content-Type:application/json');
//for get in  json response


//include models and config database

include_once('../config/Database.php');
include_once('../Models/Products.php');

// instantiate database obj
$database_obj=new Database();

//connect db
$db=$database_obj->connect();


// instantiate models obj
    //here we have to pass db obj because it call constructor automatically and set property of products mmodel to this db obj
$product_obj=new Products($db);


//call method to getdata
$result=$product_obj->getDetails();

// check any products
$num=$result->rowCount();

if($num>0){
    //set response

    $products_details=[];
    $products_details['data']=[];

    while($row=$result->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        
       
        //method for direct access by index
        $product_item=[
            'product_id'=>$id,
            'product_name'=>$products_name,
            'product_description'=>$products_description,
            'category_id'=>$category_id,
            'category_name'=>$category_name
        ];
        array_push($products_details['data'],$product_item);
    }
    // json output response
    echo json_encode($products_details);
  }

else{
    echo json_encode([
        'message'=>'No products found!',
    ]);
}


?>