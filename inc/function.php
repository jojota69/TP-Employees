<?php

    function getDepartements($bdd){
        $sql = "SELECT * FROM v_dept_manager";
        $requete = mysqli_query($bdd, $sql);
        return $requete;
    }

    function getEmployees($bdd, $numeroDept){
        $sql = "SELECT * FROM v_employees_dept
                WHERE v_employees_dept.dept_no = '%s' ORDER BY v_employees_dept.first_name ASC;";
        $sql = sprintf($sql, $numeroDept);
        $requete = mysqli_query($bdd, $sql);
        return $requete;
    }

    function rechercher($bdd, $numDept, $nom, $min, $max, $page){
        $offset = $page * 20;
        $conditions = [];
        $params = [];
        $sql = "SELECT departments.*, employees.*, TIMESTAMPDIFF(YEAR, employees.birth_date, CURDATE()) as Age 
                FROM employees
                JOIN dept_emp ON employees.emp_no = dept_emp.emp_no 
                JOIN departments ON dept_emp.dept_no = departments.dept_no";

        if (!empty($numDept)) {
            $conditions[] = "dept_emp.dept_no = '%s'";
            $params[] = $numDept;
        }
        if (!empty($nom)) {
            $conditions[] = "employees.first_name LIKE '%%%s%%'";
            $params[] = $nom;
        }
        if (!empty($min)) {
            $conditions[] = "TIMESTAMPDIFF(YEAR, employees.birth_date, CURDATE()) >= '%d'";
            $params[] = (int)$min;
        }
        if (!empty($max)) {
            $conditions[] = "TIMESTAMPDIFF(YEAR, employees.birth_date, CURDATE()) <= '%d'";
            $params[] = (int)$max;
        }
        if (count($conditions) > 0) {
            $sql .= " WHERE " . implode(" AND ", $conditions);
        }
        $sql .= " ORDER BY departments.dept_no LIMIT %d, 20;";
        $params[] = $offset;
        $sql = vsprintf($sql, $params);
        $requete = mysqli_query($bdd, $sql);
        return $requete;
    }

    function ficheEmployees($bdd, $numeroEmp) {
        $sql = "SELECT * FROM v_employees WHERE emp_no = '%s';";
        $sql = sprintf($sql, $numeroEmp);
        $requete = mysqli_query($bdd, $sql);
        return $requete;
    }

    function SalaireHistorique($bdd, $numeroEmp) {
        $sql = "SELECT * FROM v_employees_salaires AS vs
                WHERE vs.emp_no = '%s'
                AND YEAR(vs.to_date) <> 9999
                ORDER BY vs.from_date;";
        $sql = sprintf($sql, $numeroEmp);
        $requete = mysqli_query($bdd, $sql);
        return $requete;
    }

    function EmploiHistorique($bdd, $emp_no) {
        $sql = "SELECT *FROM v_employees_titles AS vet
                WHERE vet.emp_no = '%s' AND YEAR(vet.to_date) <> 9999
                ORDER BY vet.from_date;";
        $sql = sprintf($sql, $emp_no);
        $result = mysqli_query($bdd, $sql);
        return $result;
    }

    function getEmploiplusLong($bdd, $emp_no) {
        $sql = "SELECT * FROM v_employees_titles_long
                WHERE emp_no = '%s' AND YEAR(to_date) <> 9999
                ORDER BY duree DESC LIMIT 1;";
        $sql = sprintf($sql, $emp_no);
        $result = mysqli_query($bdd, $sql);
        return $result;
    }

    function nbrEmployees($bdd){
        $sql = "SELECT * FROM v_employees_nbr";
        $requete = mysqli_query($bdd, $sql);
        return $requete;
    }
  
    function getNbEmployeesByDept($bdd, $dept_no) {
        $sql = "SELECT COUNT(ve.emp_no) as nb FROM v_employees_dept AS ve WHERE dept_no = '%s';";
        $sql = sprintf($sql, $dept_no);
        $result = mysqli_query($bdd, $sql);
        $row = mysqli_fetch_assoc($result);
        return $row['nb'];
    }
?>