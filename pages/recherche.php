<?php
    require("../inc/connection.php");
    require("../inc/function.php");

    $bdd = dbconnect();

    $numDept = $_POST['numDept'];
    $nom = $_POST['nom'];
    $ageMin = $_POST['min'];
    $ageMax = $_POST['max'];
    
    if (isset($_POST['num'])) {
        $page = (int)$_POST['num'];
    } else {
        $page = 0;
    }

    if ($page < 0) {
        $page = 0;
    }

    $nextPage = $page + 1;
    $prevPage = $page - 1;
    if ($prevPage < 0) {
        $prevPage = 0;
    }

    $resultat = rechercher($bdd, $numDept, $nom, $ageMin, $ageMax, $page);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Résultat Recherche</title>
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
</head>
<body>

    <nav class="navbar navbar-expand-lg bg-body-tertiary p-3">
        <div class="container-fluid">
            <a href="../pages/index.php" class="btn btn-outline-secondary">Retour</a>
        </div>
    </nav>

    <main>
        <div class="container mt-5">
            <table class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Nom</th>
                        <th>Prénom</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($donnee = mysqli_fetch_assoc($resultat)) { ?>
                        <tr>
                            <td><?php echo $donnee['first_name']; ?></td>
                            <td><?php echo $donnee['last_name'];?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>

            <div class="d-flex justify-content-between mt-4">
                <?php if ($page > 0) { ?>
                    <form action="../pages/recherche.php" method="post">
                        <input type="hidden" name="numDept" value="<?php echo $numDept;?>">
                        <input type="hidden" name="nom" value="<?php echo $nom?>">
                        <input type="hidden" name="min" value="<?php echo $ageMin?>">
                        <input type="hidden" name="max" value="<?php echo $ageMax?>">
                        <input type="hidden" name="num" value="<?php echo $prevPage?>">
                        <input type="submit" class="btn btn-secondary" value="Précédent">
                    </form>
                <?php } else { ?>
                    <div></div> 
                <?php } ?>

                <?php if (mysqli_num_rows($resultat) === 20) { ?>
                    <form action="../pages/recherche.php" method="post">
                        <input type="hidden" name="numDept" value="<?php echo $numDept;?>">
                        <input type="hidden" name="nom" value="<?php echo $nom?>">
                        <input type="hidden" name="min" value="<?php echo $ageMin?>">
                        <input type="hidden" name="max" value="<?php echo $ageMax?>">
                        <input type="hidden" name="num" value="<?php echo $nextPage?>"> 
                        <input type="submit" class="btn btn-primary" value="Suivant">
                    </form>
                <?php } else { ?>
                    <div></div> 
                <?php } ?>
            </div>

            <p class="text-center mt-3">Page <?php echo $page + 1; ?></p>
        </div>
    </main>
</body>
</html>
