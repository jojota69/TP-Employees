CREATE OR REPLACE VIEW v_employees
AS SELECT * FROM employees;


CREATE OR REPLACE VIEW v_departments
AS SELECT * FROM departments ORDER BY dept_no;


CREATE OR REPLACE VIEW v_dept_manager
AS SELECT vd.dept_no, vd.dept_name, ve.first_name, ve.last_name FROM v_departments AS vd 
JOIN dept_manager ON vd.dept_no = dept_manager.dept_no
JOIN v_employees AS ve ON ve.emp_no = dept_manager.emp_no
WHERE dept_manager.to_date = "9999-01-01";


CREATE OR REPLACE VIEW v_employees_dept
AS SELECT ve.emp_no, de.dept_no, ve.first_name, ve.last_name FROM v_employees as ve
JOIN dept_emp as de ON ve.emp_no = de.emp_no;
WHERE de.dept_no = '%s' ORDER BY ve.first_name ASC;


CREATE OR REPLACE VIEW v_employees_salaires
AS SELECT employees.emp_no, titles.title, salaries.salary, salaries.from_date, salaries.to_date FROM employees
JOIN salaries ON employees.emp_no = salaries.emp_no
JOIN titles ON employees.emp_no = titles.emp_no;


CREATE OR REPLACE VIEW v_employees_titles
AS SELECT employees.emp_no, titles.title, titles.from_date, titles.to_date FROM employees
JOIN titles ON employees.emp_no = titles.emp_no;


CREATE OR REPLACE VIEW v_employees_titles_long
AS SELECT emp_no, title, from_date, to_date, DATEDIFF(to_date, from_date) AS duree FROM v_employees_titles;


CREATE OR REPLACE VIEW v_employees_nbr
AS SELECT titles.title, SUM(CASE WHEN employees.gender = 'M' THEN 1 ELSE 0 END) AS M,
SUM(CASE WHEN employees.gender = 'F' THEN 1 ELSE 0 END) AS F,
AVG(salaries.salary) AS salary
FROM employees
JOIN titles ON employees.emp_no = titles.emp_no
JOIN salaries ON employees.emp_no = salaries.emp_no
GROUP BY titles.title;