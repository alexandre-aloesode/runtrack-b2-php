<?php

require_once "./class/Student.php";
require_once "./class/Grade.php";

function findOneGrade(int $id) {

    $grade = new Grade();
    $grade->findOneGrade($id);
    return $grade;
} 

$grade = findOneGrade(2);
$gradeStudents = $grade->getStudents();
var_dump($gradeStudents);

?>