<!doctype html>

<html>

<head>
    <title>Page Title</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1.0">
    <style>
        #container {
            width: 80%;
            padding: 10px;
            margin: 1cm auto;
            font-family: tahoma, sans-serif;
            box-shadow: none;
        }

        div {
            box-shadow: 5px 5px 2px rgba(10,10,10,0.4);
        }
        
        #hetid {
            font-size: 2em;
            font-weight: bold;
            width: 50px;
            height: 2cm;
            margin: 20px;
            float: left;
            background-color: aquamarine;
            padding: 10px;
        }

        #dedesc {
            font-size: 1.5em;
            font-weight: bold;
            width: 500px;
            height: 2cm;
            margin: 20px;
            float: left;
            background-color: aquamarine;
            padding: 10px;
        }

        #deprijs {
            font-size: 1em;
            font-weight: bold;
            width: 100px;
            height: 2cm;
            margin: 20px;
            float: left;
            background-color: aquamarine;
            padding: 10px;
        }

    </style>
</head>

<body>
    <div id="container">
        <?php
        
            function getVariantSelect($selname, $pid) {
                global $verb;
                
                $haalVarianten = <<<HKG
                    SELECT id, variant, pricecalc 
                    FROM variants WHERE pizza_id = :hetpizzaid
                    AND active = 1
HKG;
    
        $stmt = $verb->prepare($haalVarianten);
        $stmt->execute([":hetpizzaid" => $pid]);

        $s = "<label>Variant to :</label><br><select id='$selname' name='$selname'>"
            ."<option value=''>--Choose variant--</option>";
        while(list($id, $vr, $pc) = $stmt->fetch(PDO::FETCH_NUM)) {
            $s .= "<option value='$id'>$vr, $pc</option>";
        }
        $s .= "</select><br>";
        $s .= "<div class='foutmelding' id='fout'></div>";
        
        return $s;
    }
        
    $verb = new PDO("mysql:host=localhost;dbname=mmpizza", 'root', '');

    $stmt = $verb->prepare("SELECT id AS Joey, description AS JEWEETWEL, price FROM pizza");

    $stmt->execute();
    
    while(list($hetID, $deDescription, $dePrijs) = $stmt->fetch(PDO::FETCH_NUM)) {
        echo "<div id='hetid'>$hetID</div><div id='dedesc'>$deDescription</div><div id='deprijs'>$dePrijs</div>";
        echo "<br style='clear:both;'>";
    }

    //echo "<pre>", print_r($res, true), "</pre>";
        
        echo "<hr>";
        
        echo getVariantSelect('joeyszoeklijst', 1);
?>
    </div>
</body>

</html>
