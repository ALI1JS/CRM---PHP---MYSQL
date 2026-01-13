

# Argument Named PHP 8.0 Version ==> applied
  - more readable
  - order not matter

# Union Types  ==> applied
  - more safer types ===> (|)

# Match Expression   ==> applied
  - used instead of the switch or the more (if else)

# Nullsafe Operator (?->)  ==> applied
 - it return null in any part is null


# Constructor Property Promotion   ==> applied
  - instead of use properites and assign its value from the constructor 
     you can assgin it directly as paramters

  public function __construct( // Constructor Property Promotion
        private $host = "mysql",
        private $username = "root",
        private $password = "password",
        private $database = "crm"
    ) {
        try {

            $this->conn = new PDO(
                "mysql:host=$this->host;dbname=$this->database;charset=utf8mb4",
                $this->username,
                $this->password,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                ]
            );

        } catch (PDOException $e) {
            die("Connection Failed: " . $e->getMessage());
        }
    }


# Attributes (Annotations Replacement)  ==> applied

# Stringable Interface 
  - to print object as a string or pass object as a string Before PHP 8 throw
   error but PHP 8 provide a stringable interface that implemented auttmaticlly when use the magic method is __tostring like this 
   class Product {
     public function __tostring (): string {
       return "Mobile";
     }
   } 

   so we can pass object from Product as string for function that need string 
  
  function printProduct(string | Stringable $product)
{
    echo $product;
}

printProduct(new Product());


# Improved Error Handling (TypeError)
- strlen([]); ==> Fatal error:


# Intersection Types ==> (&)
 - enforce multiple types 

# Never  ==> applied
  - used with function that not return normally like throw error 

# Unpacking array  ==> applied
  - $arr1 = []; $arr2 = []; $arr3 = [...$arr1, ...$arr2]; 

# Enums and Readonly properites  ==> applied
# Final Class 
  - the final class can not be extended 
  - if i need extend from class but there is method i don't need to be      overrided so make it final and also the constant

# readonly class   ==> applied
  - instead mark each properites as readonly we can mark the class

# Disjunctive Normal Form
  - can combine intersection (&) and union (|)

# Allow null, false, and true as stand-alone types
  - that mean allow the function return the exact value like true , false or null

# New “Random” extension 
  -  provide new class for random generator

# Typed Class Constants 
   - before php 8.3 can not use types with constant in classes
  
# Class & Enum Dynamic Constant Fetch

# Class Dynamic Constant Fetch

# #[\Override] Attribute
 - This tell php that method must override from the parent class

# json_validate() Function
  - Built in function that check if the string is valid json or not so it return boolean value

# class_alias()
  - it enable you to give another name for exist classes 

# Property Hooks 
   - it provides a getter and setter for assign and access the properites

# #[\Deprecated] Attribute 

# dom features and HTML5 support

# Array Helper functions
  - array_all()
  - array-any()
  - array_find()
  - array_find_key()