<?php
require_once 'dbconfig.php';

class Pizza {
    public $PizzaID;
    public $Naam;
    public $Grootte;
    public $Prijs;
    
        public function show()
    {
         return $this->PizzaID. " ". $this->Naam;
    }
}

$sth = $pdo->prepare("SELECT * FROM pizza");
$sth->execute();

print("Fetch all of the remaining rows in the result set:\n");
$result = $sth->fetchAll(PDO::FETCH_CLASS, "Pizza");


foreach($result as $user){
    echo $user->show();
    echo "<br>";
//    echo $pizzadingen[0];
}

//print_r($result[1]);

?>
