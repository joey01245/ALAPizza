<?php 
require_once 'dbconfig.php';

   
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/style.css">

    <title>Sopranos Pizza's</title>


</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #0f9b49">

            <!--          <a class="navbar-brand" href="#">Navbar</a>-->
            <button class="navbar-toggler whitetext" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            Menu
          </button>

            <a id='title' href="index.php"><span>Sopranos Pizza</span></a>
            <img id='logo' src="img/placeholder4.png" width="50">

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="bestellen.php">Bestellen</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <div class='banner'>
        <h2 class='pl-3 pt-2 text-center'>Pizza Bestellen</h2>
        <hr>
    </div>

    <main class="container border mt-4 mb-5">
        <form class='bestelling'>
            <div class='row'>

                <div class='col-lg-4'>
                    <label class="lead">Gegevens:</label>
                    <input type="text" class="form-control contactinput" placeholder="Naam" required>
                    <input type="text" class="form-control contactinput" placeholder="Adres" required>
                    <input type="text" class="form-control contactinput" placeholder="Woonplaats" required>
                    <input type="text" class="form-control contactinput" placeholder="Postcode" required>
                    <input type="text" class="form-control contactinput" placeholder="E-Mail" required>
                    <input type="text" class="form-control contactinput" placeholder="Telefoonnummer" required>
                </div>

                <div class='col-lg-12'>
                    <hr>
                </div>
                <div class='col-md-8'>
                    <label class='lead'>Bestelling:</label>
                </div>
                <div class='col-lg-2'>
                    <label class='lead'>Prijs:</label>
                </div>
                <div class='col-md-2'>
                    <label class='lead'>Hoeveelheid:</label>
                </div>
                
<?php
         try {
                        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        $stmt = $pdo->prepare("SELECT Naam, Grootte, Prijs FROM pizza limit 1 "); 
                        $stmt->execute();


                    while(list($Naam, $Grootte, $Prijs) = $stmt->fetch(PDO::FETCH_NUM)) {
                        echo "<div class='col-lg-12 mt-2'>$Naam</div>
                        <div class='col-md-2'>
                                <img class='pizzaplaatje' src='img/placeholder4.png' height='150px' width='150px'>
                            </div>
                                <div class='col-md-6'>
                                   <span id='eerstepizza'>
                                    <input type='radio' name='grootte' value='medium'> Medium<br>
                                    <input type='radio' name='grootte' value='large'> Large<br>
                                    <input type='radio' name='grootte' value='calzone'> Calzone<br>
                                    </span>
                                </div>
                           <div class='col-md-2'>
                            <label>&euro; $Prijs</label>
                           </div>
                           
                           <div class='col-md-2 col-sm-3'>
                            <input type='text' class='form-control' required placeholder='0'>
                           </div>";
                        }


                    }
                    catch(PDOException $e) {
                        echo "Error: " . $e->getMessage();
                    }
            unset($pdo);
            $pdo = null;
?>

                    <div class='col-md-12 text-right mb-2'>
                        <label class='lead font-weight-bold mr-3'>Subtotaal:</label>
                        <label id='subtotaal'>&euro; 0,00</label>
                    </div>
                    <div class='col-md-12 bestelknopdiv text-right mb-2'>
                        <button class='btn btn-primary' type="submit">Bestel</button>
                    </div>

            </div>
        </form>

    </main>
    <!-- /.container -->

    <footer>

    </footer>

</body>

</html>
