<?php

    require("../inc/connection.php");
    require("../inc/function.php");

    $bdd = dbconnect();

    $numDept = $_POST['num'];

    $employees = getEmployees($bdd, $numDept);

    $numDepts = getNumDepartements($bdd);
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

    <nav class="navbar navbar-expand-lg bg-body-tertiary py-3">
    <div class="container">
        <div class="row w-100 justify-content-center">
            <div class="col-md-10">
                <form class="d-flex gap-2 justify-content-center" role="search" action="../pages/recherche.php" method="post">
                    <select name="numDept" class="form-select w-auto">
                        <?php while ($donnee = mysqli_fetch_assoc($numDepts)) { ?>
                            <option value="<?php echo $donnee['dept_no'];?>"><?php echo $donnee['dept_no'];?></option>
                        <?php } ?>
                    </select>
                        <input type="text" name="nom" placeholder="Nom" class="form-control w-auto">
                        <input type="text" name="min" placeholder="Age min" class="form-control w-auto">
                        <input type="text" name="max" placeholder="Age max" class="form-control w-auto">
                        <button class="btn btn-primary" type="submit">Rechercher</button>
                    </form>
                </div>
            </div>
        </div>
    </nav>


    <main>
        <div class="container mt-5">
            <table class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Fiche</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($donnee = mysqli_fetch_assoc($employees)){ ?>
                        <tr>
                            <td><?php echo $donnee['first_name'];?></td>
                            <td><?php echo $donnee['last_name'];?></td>
                            <td>
                                <form action="../pages/fiche.php" method="post">
                                    <input type="hidden" name="num" value="<?php echo $donnee['emp_no'];?>">
                                    <input type="hidden" name="numDepart" value="<?php echo $numDept;?>">
                                    <input type="submit" class="btn btn-primary btn-sm" value="Fiche de l'employé...">
                                </form>
                            </td>                        
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </main>
</body>
</html>
