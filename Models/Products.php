<?php

class Products{
    //variable for set connect to DB
    private $conn;
    

    // intialize variables
    
    public $id;
    public $products_name;
    public $products_description;
    public $category_name;


    // constructor:
                    // constructor is method in class which run atomatically when create instance of class  

    public function __construct($db){
        $this->conn=$db;
    }    

    // method for get products_data

    public function getDetails(){
        // query
        $query="SELECT p.*, c.id as category_id, c.category_name as category_name FROM products p 
              LEFT JOIN category c 
              ON p.category_id=c.id";
        
      
        //prepare statement
        $stmt=$this->conn->prepare($query);
       
       
       
        //execute query
        $stmt->execute();

        return $stmt;
    }
}

?>
