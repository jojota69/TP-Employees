<?php

    require('../inc/connection.php');
    require('../inc/function.php');

    $bdd = dbconnect();

    $nombre = nbrEmployees($bdd);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
</head>
<body>
     <div class="container mt-5">
        <h2 class="mb-4 text-center">Statistiques des Employés par Titre</h2>
        <table class="table table-bordered table-hover shadow">
            <thead class="table-dark">
                <tr>
                    <th>Titre</th>
                    <th>Homme</th>
                    <th>Femme</th>
                    <th>Salaire Moyen</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($donnee = mysqli_fetch_assoc($nombre)) { ?>
                    <tr>
                        <td><?php echo $donnee['title'];?></td>
                        <td><?php echo $donnee['M']; ?></td>
                        <td><?php echo $donnee['F']; ?></td>
                        <td><?php echo number_format($donnee['salary'], 2, ',', ' '); ?> $</td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <a href="../pages/index.php" class="btn btn-primary">Retour</a>
    </div>
</body>
</html>