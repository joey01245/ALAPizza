<?php 
require_once 'dbconfig.php';

    try {
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $stmt = $pdo->prepare("SELECT pizzaID, Naam, Grootte, Prijs FROM pizza LIMIT 1 "); 
                $stmt->execute();

                // set the resulting array to associative

            while ($row = $stmt->fetch())
              {

                $id = $row['pizzaID'];
                $naam = $row['Naam'];
                $grootte = $row['Grootte'];            
                $prijs = $row['Prijs'];
//                $waterhoogte = $row['waterhoogte'];

              }

            }
            catch(PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
    unset($pdo);
    $pdo = null;
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
        <h2 class='pl-3 pt-2'>Pizza Bestellen</h2>
        <hr>
    </div>

    <main class="container border mt-4 mb-5">
        <form class='bestelling'>
            <div class='row'>

                <div class='col-lg-4'>
                    <label class="lead">Gegevens:</label>
                    <input type="text" class="form-control contactinput" placeholder="Naam">
                    <input type="text" class="form-control contactinput" placeholder="Adres">
                    <input type="text" class="form-control contactinput" placeholder="Woonplaats">
                    <input type="text" class="form-control contactinput" placeholder="Postcode">
                    <input type="text" class="form-control contactinput" placeholder="E-Mail">
                    <input type="text" class="form-control contactinput" placeholder="Telefoonnummer">
                </div>

                <div class='col-lg-12'>
                    <hr>
                    <?php echo $id ?>
                </div>




                <div class='col-md-12 bestelknopdiv text-right mb-2'>
                    <button class='btn btn-primary'>Bestel</button>
                </div>

            </div>
        </form>

    </main>
    <!-- /.container -->

    <footer>

    </footer>

</body>

</html>
