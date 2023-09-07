<!-- Dans le dossier job-01, faites un fichier index.php. À l’intérieur de ce fichier faites une
fonction find_all_students(). Cette fonction devra retourner un tableau avec toutes les
lignes et toutes les colonnes de la table student sous forme de tableau associatif.
Dans la suite de votre fichier PHP, faites une structure HTML basique et générer un
tableau HTML à l’aide du retour de la fonction pour afficher tous les étudiants. -->

<?php
function find_all_students()
{
    $password = '';
    $dsn = 'mysql:host=localhost;dbname=lp_official;charset=utf8';
    $pdo = new PDO($dsn, 'root', $password);

    $requestReadAll = "SELECT * FROM student";

    $queryReadAll = $pdo->prepare($requestReadAll);

    $queryReadAll->execute();

    $resultReadAll = $queryReadAll->fetchAll(pdo::FETCH_ASSOC);

    return $resultReadAll;
}

function display_students()
{
    $data = find_all_students();
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

    <?= display_students() ?>

</body>

</html>