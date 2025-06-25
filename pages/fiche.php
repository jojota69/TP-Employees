<?php

    require("../inc/connection.php");
    require("../inc/function.php");

    $bdd = dbconnect();

    $numeroEmp = $_POST['num'];

    $numDept = $_POST['numDepart'];

    $employees = ficheEmployees($bdd, $numeroEmp);

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
    <div class="container mt-5">
        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Date de naissance</th>
                    <th>Date d'embauche</th>
                    <th>Genre</th>
                    <th>Historique</th>
                </tr>
            </thead>
            <tbody>
                <?php while($donnee = mysqli_fetch_assoc($employees)){ ?>
                        <tr>
                            <td><?php echo $donnee['first_name'];?></td>
                            <td><?php echo $donnee['last_name'];?></td>  
                            <td><?php echo $donnee['birth_date'];?></td>
                            <td><?php echo $donnee['hire_date'];?></td>
                            <td>
                                <?php if ($donnee['gender'] == "M") { 
                                    echo "Homme";
                                }
                                else{
                                    echo "Femme";
                                }
                                ?>
                            </td> 
                            <td>                 
                                <form action="../pages/historique.php" method="post">
                                    <input type="hidden" name="num" value="<?php echo $donnee['emp_no']?>">
                                    <input type="submit" class="btn btn-primary btn-sm" value="Historique des salaires...">
                                </form>
                            </td>                 
                        </tr>
                <?php } ?>
            </tbody>
        </table>
        <form action="../pages/employees.php" method="post">
            <input type="hidden" name="num" value="<?php echo $numDept?>">
            <input type="submit" value="Retour">
        </form>
    </div>
</body>
</html>
