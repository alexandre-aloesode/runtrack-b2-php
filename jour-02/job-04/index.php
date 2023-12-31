<?php
function find_all_students_grades()
{
    $password = '';
    $dsn = 'mysql:host=localhost;dbname=lp_official;charset=utf8';
    $pdo = new PDO($dsn, 'root', $password);

    $requestReadAll = "SELECT email, fullname, name FROM student
    INNER JOIN grade ON student.grade_id = grade.id";

    $queryReadAll = $pdo->prepare($requestReadAll);

    $queryReadAll->execute();

    $resultReadAll = $queryReadAll->fetchAll(pdo::FETCH_ASSOC);

    return $resultReadAll;
}

function display_students_grades()
{
    $data = find_all_students_grades();
    echo "
    <table>
    <thead>
    <tr>";
    foreach ($data[0] as $key => $value) {
        echo "<th>" . $key . "</th>";
    }
    echo "</thead>
        <tbody>";
    foreach ($data as $key => $value) {
        echo "<tr>";
        foreach ($value as $key2 => $value2) {
            echo "<td>" . $value2 . "</td>";
        }
        echo "</tr>";
    }
    echo

    "</tbody>
    </table>
    ";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <?= display_students_grades() ?>

</body>

</html>