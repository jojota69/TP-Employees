<?php

    require("../inc/connection.php");
    require("../inc/function.php");

    $bdd = dbconnect();

    $departments = getDepartements($bdd);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Departements</title>
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Départements</th>
                    <th>Manager</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($donnee = mysqli_fetch_assoc($departments)) { ?>
                    <tr>
                        <td><?php echo $donnee['dept_name']; ?></td>
                        <td><?php echo $donnee['first_name']; ?> <?php echo $donnee['last_name']; ?></td>
                        <td>
                            <form action="../pages/employees.php" method="post">
                                <input type="hidden" name="num" value="<?php echo $donnee['dept_no'];?>">
                                <input type="submit" class="btn btn-primary btn-sm" value="Liste des employees...">
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>
