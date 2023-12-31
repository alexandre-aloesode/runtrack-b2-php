<?php

function find_one_student(string $email): array
{
    $password = '';
    $dsn = 'mysql:host=localhost;dbname=lp_official;charset=utf8';
    $pdo = new PDO($dsn, 'root', $password);

    $requestReadAll = "SELECT * FROM student WHERE email = :email";

    $queryReadAll = $pdo->prepare($requestReadAll);

    $queryReadAll->execute([
        ':email' => $email
    ]);

    $resultReadAll = $queryReadAll->fetchAll(pdo::FETCH_ASSOC);

    return $resultReadAll;
}

function display_student_data()
{
    if (isset($_GET['input-email-student'])) {
        $data = find_one_student($_GET['input-email-student']);
        echo "
      <table>
          <thead>
              <tr>
              <th>ID</th>
                  <th>Grade</th>
                  <th>Email</th>
                  <th>Fullname</th>
                  <th>Birthdate</th>
                  <th>Gender</th>
              </tr>
          </thead>
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
    } else {
        return;
    }
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
    <form method="GET">
        <label for="input-email-student">Email</label>
        <input type="text" name="input-email-student">
        <button type="submit" value="Submit">Soumettre</button>
    </form>
    <?= display_student_data() ?>
</body>

</html>