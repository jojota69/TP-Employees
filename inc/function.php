<?php

    function getDepartements($bdd){
        $sql = "SELECT departments.dept_no, departments.dept_name, employees.first_name, employees.last_name 
                FROM departments JOIN dept_manager ON departments.dept_no = dept_manager.dept_no
                JOIN employees ON dept_manager.emp_no = employees.emp_no 
                WHERE to_date = (SELECT MAX(to_date) FROM dept_manager)
                ORDER BY departments.dept_no;";
        $requete = mysqli_query($bdd, $sql);
        return $requete;
    }

    function getNumDepartements($bdd){
        $sql = "SELECT dept_no FROM departments ORDER BY dept_no;";
        $requete = mysqli_query($bdd, $sql);
        return $requete;
    }

    function getEmployees($bdd, $numeroDept){
        $sql = "SELECT employees.emp_no, employees.first_name, employees.last_name, employees.birth_date, employees.gender, employees.hire_date
                FROM employees
                JOIN dept_emp on employees.emp_no = dept_emp.emp_no
                WHERE dept_emp.dept_no = '%s';";
        $sql = sprintf($sql, $numeroDept);
        $requete = mysqli_query($bdd, $sql);
        return $requete;
    }

    function rechercher($bdd, $numDept, $nom, $min, $max, $page){
        $limit = $page * 20;
        $sql = "SELECT employees.*, TIMESTAMPDIFF(YEAR, employees.birth_date, CURDATE()) as Age FROM employees
                JOIN dept_emp ON employees.emp_no = dept_emp.emp_no
                WHERE dept_emp.dept_no = '%s' 
                AND first_name LIKE '%%%s%%' 
                AND TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) > '%s' 
                AND TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) < '%s' LIMIT %s, 20;";
        $sql = sprintf($sql, $numDept, $nom, $min, $max, $limit);
        $requete = mysqli_query($bdd, $sql);
        return $requete;
    }

    function ficheEmployees($bdd, $numeroEmp) {
        $sql = "SELECT * FROM employees WHERE emp_no = '%s'; ";
        $sql = sprintf($sql, $numeroEmp);
        $requete = mysqli_query($bdd, $sql);
        return $requete;
    }

    function SalaireHistorique($bdd, $numeroEmp) {
        $sql = "SELECT employees.first_name, employees.last_name, salaries.salary, salaries.from_date, salaries.to_date
                FROM employees
                JOIN titles ON employees.emp_no = titles.emp_no 
                JOIN salaries ON employees.emp_no = salaries.emp_no
                WHERE employees.emp_no = '%s'
                ORDER BY salaries.from_date;";
        $sql = sprintf($sql, $numeroEmp);
        $requete = mysqli_query($bdd, $sql);
        return $requete;
    }
    
?>