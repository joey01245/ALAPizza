<?php

class JoeyPDO {
    private $MODE = PDO::FETCH_OBJ;
    
    private $conn;
    
    private $cnn = array(
            'wamp' => [
                        "dsn" => "mysql:host=joey01245.nl;dbname=joeynl_pizzaALA",
                        "usr" => "joeynl_wp2",
                        "pwd" => "joey012451"
                        ],
            'usbw' => [
                        "dsn" => "mysql:host=localhost;dbname=mmpizza;port=3307",
                        "usr" => "root",
                        "pwd" => "usbw"
                        ]
        );

    
    /**
     * Constructor, maakt verbinding met de MySQL database.
     * Een lege constructor of met wamp zal de WAMPserver-verbinding starten
     * dus zonder port en zonder wachtwoord.
     * Wanneer usbw als argument wordt meegegeven, dan worden port=3307
     * en password meegegeven.
     */
    public function __construct($modus = 'wamp') {
        $this->conn = new PDO($this->cnn[$modus]['dsn'],
                              $this->cnn[$modus]['usr'],
                              $this->cnn[$modus]['pwd']);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function setMode($newMode) {
        $this->MODE = $newMode;    
    }
    
    // voorbeelden! Adjust to taste ;-)
    //
    public function getAllPizzas() {
        $stmt = $this->conn->prepare("SELECT PizzaID, Naam, Prijs
            FROM pizzatest");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function getPizzaById($id) {
        $stmt = $this->conn->prepare("SELECT PizzaID, Naam, Prijs
            FROM pizzatest WHERE PizzaID = :id");
        $stmt->execute([":id" => $id]);
        return $stmt->fetch(PDO::FETCH_OBJ);
    }
    
    public function getPizzaByNamepart($namepart) {
        $search = "%$namepart%";
        $stmt = $this->conn->prepare("SELECT PizzaID, Naam, Prijs
            FROM pizzatest WHERE Naam LIKE ?");
        $stmt->execute([$search]);
        return $stmt->fetchAll($this->MODE);
    }
    
    public function getPizzaNameByNamepart($namepart) {
        $search = "%$namepart%";
        $stmt = $this->conn->prepare("SELECT PizzaID, Naam, Prijs
            FROM pizzatest WHERE Naam LIKE ?");
        $stmt->execute([$search]);
        
        $terugding = $stmt->fetchAll($this->MODE);
        
        $k = "<div>";
        foreach($terugding as $rows) {
            $k .= "{$rows->Naam}<br>";
        }
        $k .= "</div>";
        
        return $k;
    }
    
    public function getRandomPizza() {
        $sql = "SELECT pizzaid, naam, prijs, image FROM pizzatest ORDER BY RAND() LIMIT 1";
            
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        
        $k = "<div class='text-center'>";
        while(list($id, $name, $price, $image) = $stmt->fetch(PDO::FETCH_NUM)) {
            $k .= "$name <br>";
            $k .= "<img src='data:image/jpeg;base64,".base64_encode( $image )."' height='200px' width='200px'><br>";
            $k .= "Nu voor maar &euro; $price";
        }
        $k .= "</div>";
        
        return $k;
        
    }
    
//    public function getPizzaAndCategory($asTable = false, $border = false) {
//        $sql = <<<EOS
//    SELECT description, cat.category, price 
//    FROM pizza p
//    JOIN categories cat 
//    ON p.category = cat.id
//EOS;
//        
//        $stmt = $this->conn->prepare($sql);
//        $stmt->execute();
//        
//        if(!$asTable)
//            return $stmt->fetchAll($this->MODE);
//        else {
//            $brdr = $border ? "border='1' style='border-collapse:collapse;'" : "";
//            
//            $s = "<table width='80%' $brdr cellspacing='5' cellpadding='5'>";
//            while(list($desc, $cat, $pri) = $stmt->fetch(PDO::FETCH_NUM)) {
//                $s .= "<tr><td>$desc</td><td>$cat</td><td>$pri</td></tr>";
//            }
//            $s .= "</table>";
//            return $s;
//        }
//    }
    
    
    /**
     * Presenteert een verkoopoverzicht op het scherm.
     */
//    public function maakOverzicht() {
//        if($this->conn->query('SELECT COUNT(*) FROM opdracht')->fetchColumn() == 0)
//            exit("<h3>Er zijn nog geen opdrachten aanwezig in de database</h3><a href='pizzabestellen.php'>Ga terug naar de bestelpagina</a>");
//        
//        $haalOpdrachten     = $this->conn->prepare("SELECT id, kid, opdrachtdatum 
//                                                    FROM opdracht");
//        
//        $haalOpdrachtregels = $this->conn->prepare("SELECT id, opdrachtid, pid, aantal, kortingspercentage 
//                                                    FROM opdrachtregel WHERE opdrachtid = :orid");
//        
//        $haalPizza          = $this->conn->prepare("SELECT id, description, price 
//                                                    FROM pizza WHERE id = :pid");
//        
//        $haalOpdrachten->execute();
//        while(list($opdrid, $opdrkid, $opdrdatum) = $haalOpdrachten->fetch(PDO::FETCH_NUM)) {
//            echo "<pre>BESTELLING<br>" . str_repeat('-', 10) ."<br>{$this->getKlant($opdrkid, 0)}</span><br>"
//                ."<strong>Besteldatum</strong>   : ".date('d-m-Y H:i:s', strtotime($opdrdatum))."<br>" // 4 spaties
//                ."<strong>Opdrachtnummer:</strong> $opdrid<br><br>";
//            
//            $besteltotaal = 0;
//
//            $haalOpdrachtregels->execute( [":orid" => $opdrid] );
//            while(list($regelid, $regeloid, $regelpid, $regelcnt, $regeldisc) = $haalOpdrachtregels->fetch(PDO::FETCH_NUM)) {
//
//                $haalPizza->execute( [":pid" => $regelpid] );
//                while(list($pizzid, $pizzdesc, $pizzpri) = $haalPizza->fetch(PDO::FETCH_NUM)) {
//                    
//                    list($ki, $ev, $kpr) = $this->haalKortingsprijs($regeldisc, $pizzpri);
//                    
//                    echo str_pad($regelcnt, 10,' ',STR_PAD_LEFT) 
//                        , " x " . str_pad($pizzdesc, 30, ' ') 
//                        , " &agrave; $ev &euro; {$this->nf($kpr)}"  
//                        , " $ki = &euro; {$this->nf($regelcnt * $kpr)}<br>";
//                    $besteltotaal += ($regelcnt * $kpr);
//                }
//            }
//            echo "<p style='text-align:center'><strong>TOTAAL BESTELLING &euro; {$this->nf($besteltotaal)}</strong></p>";
//            echo "</pre><hr>";
//        } // einde while opdrachtids
//    }


    

    /// PRIVATE /// INTERNAL UTILITIES /// HANDIG ///////////////////////////////////

    /**
     * "PRETTY PRINT" handige functie die het werken met print_r vereenvoudigt.
     * @param mixed $bron variabele die met print_r getoond moet worden
     * @param string $titel optionele titel (in een <h3></h3>) bij de output
     *                                                                
     * @version 1.0
     */
    static function pp($bron, $titel="") {
        if(strlen($titel) > 0) echo "<h3>$titel</h3>";
        echo "<pre>", print_r($bron, true), "</pre>";
    }

    /**
     * Haalt een willekeurig getal op
     * @param  int $van ondergrens
     * @param  int $tot bovengrens
     * @return int het gegenereerde willekeurige getal tussen $van en $tot (inclusief)
     */
    public function willekeurig($van, $tot) {
        $seed = microtime(true) * 1e8;
        srand($seed);
        return (int)rand($van, $tot);
    }
    
    /**
     * formatteer een bedrag naar een NL-versie (1.234,00)
     * (2 decimalen, punt als duizendtallenscheider, komma als decimale punt).
     * is vooral ook een verkorting van de functienaam
     * @param  float $bedrag het bedrag in US-vorm (1,234.00)
     * @return string geformatteerd bedrag
     */
    private function nf($bedrag) {
        return number_format($bedrag, 2, ',','.');
    }
    
 } // einde class JoeyPDO
