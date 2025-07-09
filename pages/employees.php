<?php

    require("../inc/connection.php");
    require("../inc/function.php");

    $bdd = dbconnect();

    $numDept = $_POST['num'];

    $employees = getEmployees($bdd, $numDept);

    $nomDepts = getDepartements($bdd);
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
    <div class="container mt-4">
        <h1 class="text-center text-primary fw-bold mb-4">Liste des employés</h1>
    </div>
    <div class="container mt-3" style="max-width: 900px;">
        <nav class="navbar navbar-expand-lg bg-body-tertiary justify-content-center p-0">
            <form class="d-flex justify-content-center w-100" role="search" action="../pages/recherche.php" method="post">
                <div class="input-group me-2" style="min-width: 200px;">
                    <label class="input-group-text" for="numDept">Département</label>
                    <select class="form-select" name="numDept" id="numDept">
                        <option value="">Tous</option>
                        <?php while ($donnee = mysqli_fetch_assoc($nomDepts)) { ?>
                            <option value="<?php echo $donnee['dept_no'];?>"><?php echo $donnee['dept_name'];?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <input type="text" name="nom" placeholder="Nom" class="form-control me-2" style="max-width: 150px;">
                    <input type="text" name="min" placeholder="Age min" class="form-control me-2" style="max-width: 100px;">
                    <input type="text" name="max" placeholder="Age max" class="form-control me-2" style="max-width: 100px;">
                    <button class="btn btn-primary" type="submit">Rechercher</button>
                </form>
            </nav>
        </div>
        
        <main>
            <div class="container mt-5">
            <a href="../pages/index.php" class="btn btn-primary mb-3">Retour</a>
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
                                    <input type="submit" class="btn btn-primary btn-sm" value="-->">
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
