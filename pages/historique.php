<?php
 
    require("../inc/connection.php");
    require("../inc/function.php");

    $bdd = dbconnect();

    $numeroEmp = $_POST['num'];

    $employees = SalaireHistorique($bdd, $numeroEmp);


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employés</title>
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Salaire</th>
                    <th>Date de début</th>
                    <th>Date de fin</th>
                </tr>
            </thead>
            <tbody>
                <?php while($donnee = mysqli_fetch_assoc($employees)){ ?>
                    <tr>
                        <td><?php echo $donnee['first_name'];?></td>
                        <td><?php echo $donnee['last_name'];?></td>
                        <td><?php echo $donnee['salary'];?></td>
                        <td><?php echo $donnee['from_date'];?></td>
                        <td><?php echo $donnee['to_date'];?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <form action="../pages/fiche.php" method="post">
            <input type="hidden" name="num" value="<?php echo $numeroEmp?>">
            <input type="submit" value="Retour">
        </form>
    </div>
</body>
</html>
