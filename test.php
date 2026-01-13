<?php
class User
{

    public function __tostring(): string
    {
        return "User";
    }

    public function print(): string
    {
        return "User from print";
    }
}
;

$obj = new User();

echo ($obj);

class Product
{
    public function __tostring(): string
    {
        return "Mobile";
    }
}

function printProduct(string | Stringable $product)
{
    echo $product;
}

printProduct(new Product());


// 9️⃣ Improved Error Handling (TypeError)
// strlen([]);



/**
 * 
 *  Week Map 
 * Array doesn't store the object as a key only number or string 
 * $array = [];
 * $pro = new Product();
 *
 * $array[$pro] = "Labtpb";
 *
 * print_r($array);
 * 
 * to fix this issue PHP Before 8 provide a data structure to use the object as
 * a key is ==> $storage = new SplObjectStorage();
 * $obj = new stdClass();
 * $storage[$obj] = "data";
 * 
 * but appear another isssue is the array and this new struture use strong reffrence
 * that mean when the object deleted still its value exist in the memory and this make 
 * another issue is memory leak
 * 
 * To solve this issue must use week reference so PHP 8 provides another data structure
 * that use memory week is ==> weekMap()
 * $map = new weekMap(); 
 */

$storage = new SplObjectStorage();
$obj = new stdClass();

$storage[$obj] = "value";
echo $storage[$obj];

// unset($obj);


$map = new WeakMap();

$map[$obj] = "value";



// Typed Class Constants

class Shap {
   
  const float BI = 3.14; // now we can use types with constant


}


// Class Dynamic Constant Fetch -

echo Shap::BI . "\n"; 

$bi = "BI";
echo Shap::{$bi} . "\n"; 


// Enum Dynamic Constant Fetch 


enum Status {
    case OPEN;
    case CLOSED;
}


echo Status::OPEN->name . "\n";


$openStatus = "OPEN";
echo Status::{$openStatus}->name . "\n";


// #[\Override] Attribute

class Employee {

    private string $name;
    private string $email;
    

    public function update() {
        echo "update from parent";
    }

    public string $setName {

        set(string $newName){
            $this->name = $newName;   
        }
    }

    #[\Deprecated(
        message:"Deprecated use the get and set hooks",
        since: "8.4"
    )]
    public function getName (): string {
        return $this->name;
    }
}


$emObj = new Employee();
$emObj->getName(); // return Deprecated error 


class Manager extends Employee {
   
    #[\Override()]
    public function update() {
        echo "update from child";
    }
}

$obj = new Manager();
$obj->update();


// class_alias()

// class_alias(DateTime::class, "Dato");

// $dateObj = new Dato();