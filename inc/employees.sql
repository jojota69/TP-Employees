SELECT departments.dept_name, employees.first_name 
FROM departments JOIN dept_manager ON departments.dept_no = dept_manager.dept_no
JOIN employees ON dept_manager.emp_no = employees.emp_no;

SELECT employees.first_name, employees.last_name, employees.birth_date, employees.gender
FROM employees
JOIN dept_emp on employees.emp_no = dept_emp.emp_no
WHERE dept_emp.dept_no = "d005";

SELECT COUNT(employees.emp_no)
FROM employees
JOIN dept_emp on employees.emp_no = dept_emp.emp_no
WHERE dept_emp.dept_no = "d005";

SELECT employees.*, TIMESTAMPDIFF(YEAR, employees.birth_date, CURDATE()) as Age FROM employees
JOIN dept_emp ON employees.emp_no = dept_emp.emp_no
WHERE dept_emp.dept_no = '%s' 
AND first_name LIKE '%%%s%%' 
AND TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) > '%s' 
AND TIMESTAMPDIFF(YEAR, birth_date, CURDATE()) < '%s';


SELECT COUNT FROM employees JOIN titles ON employees.emp_no = titles.emp_no;

SELECT 
    titles.title,
    SUM(CASE WHEN employees.gender = 'M' THEN 1 ELSE 0 END) AS M,
    SUM(CASE WHEN employees.gender = 'F' THEN 1 ELSE 0 END) AS F,
    AVG(salaries.salary)
FROM employees
JOIN titles ON employees.emp_no = titles.emp_no
JOIN salaries ON employees.emp_no = salaries.emp_no
GROUP BY titles.title;

