<?php

    require("../inc/connection.php");
    require("../inc/function.php");

    $bdd = dbconnect();

    $numeroEmp = $_POST['num'];

    $numDept = $_POST['numDepart'];

    $employees = ficheEmployees($bdd, $numeroEmp);
    $historique = SalaireHistorique($bdd, $numeroEmp);
    $emploi = EmploiHistorique($bdd, $numeroEmp);

    $emploiPlusLong = getEmploiplusLong($bdd, $numeroEmp);
    $emploi2 = mysqli_fetch_assoc($emploiPlusLong);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fiche-Employés</title>
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h1 class="text-center text-primary fw-bold mb-4">Fiche employé</h1>
    </div>
    <div class="container mt-5">
        <?php ($donnee = mysqli_fetch_assoc($employees))  ?>
            <table class="table table-bordered w-50 mx-auto">
                <tbody>
                    <tr>
                        <th class="table-dark">Nom</th>
                        <td><?php echo $donnee['first_name']; ?></td>
                    </tr>
                    <tr>
                        <th class="table-dark">Prénom</th>
                        <td><?php echo $donnee['last_name']; ?></td>
                    </tr>
                    <tr>
                        <th class="table-dark">Date de naissance</th>
                        <td><?php echo $donnee['birth_date']; ?></td>
                    </tr>
                    <tr>
                        <th class="table-dark">Date d'embauche</th>
                        <td><?php echo $donnee['hire_date']; ?></td>
                    </tr>
                    <tr>
                        <th class="table-dark">Genre</th>
                        <td>
                            <?php 
                                if ($donnee['gender'] == "M") { 
                                    echo "Homme";
                                } else {
                                    echo "Femme";
                                }
                            ?>
                        </td>
                    </tr>
                </tbody>
            </table>       
    </div>
    <div class="container mt-5">
        <h3 class="mt-4 fw-bold">Historique des salaires</h3>
        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Emploi</th>
                    <th>Salaire</th>
                    <th>Date de début</th>
                    <th>Date de fin</th>
                </tr>
            </thead>
            <tbody>
                <?php while($salaire = mysqli_fetch_assoc($historique)){ ?>
                    <tr>
                        <td><?php echo $salaire['title'];?></td>
                        <td><?php echo $salaire['salary'];?>$</td>
                        <td><?php echo $salaire['from_date'];?></td>
                        <td><?php echo $salaire['to_date'];?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <div class="container mt-5">
        <h3 class="mt-4 fw-bold">Historique des emplois</h3>
        
        <?php if (mysqli_num_rows($emploi) === 0) { ?>
            <h4>Rien</h4>
        <?php }
        else { ?>
            <table class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Emploi</th>
                        <th>Date de début</th>
                        <th>Date de fin</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($donnee2 = mysqli_fetch_assoc($emploi)){ ?>                
                        <tr>
                            <td><?php echo $donnee2['title'];?></td>
                            <td><?php echo $donnee2['from_date'];?></td>
                            <td><?php echo $donnee2['to_date'];?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php } ?>
    </div>
        <?php if ($emploi2) { ?>
        <div class="alert alert-info mt-4">
            <strong>Emploi le plus long :</strong>
            <?php echo $emploi2['title']; ?>
            (du <?php echo $emploi2['from_date']; ?> au <?php echo $emploi2['to_date']; ?>)
            <p>Duree : <?php echo $emploi2['duree'] ;?>jours</p>
        </div>
        <?php } ?>
    <form action="../pages/employees.php" method="post">
            <input type="hidden" name="num" value="<?php echo $numDept?>">
            <input type="submit" value="Retour">
    </form>
</body>
</html>
