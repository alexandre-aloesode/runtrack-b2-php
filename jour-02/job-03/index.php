<?php

function insert_student(array $data)
{
    $password = '';
    $dsn = 'mysql:host=localhost;dbname=lp_official;charset=utf8';
    $pdo = new PDO($dsn, 'root', $password);

    $requestInsert = "INSERT INTO student (email, fullname, birthdate, grade_id, gender) VALUES (:email, :fullname, :birthdate, :grade_id, :gender)";

    $queryInsert = $pdo->prepare($requestInsert);

    $queryInsert->execute([
        ':email' => $data['input-email-student'],
        ':fullname' => $data['input-fullname'],
        ':gender' => $data['input-gender'],
        ':birthdate' => $data['input-birthdate'],
        ':grade_id' => $data['input-grade_id']
    ]);
    if ($queryInsert) {
        echo "L'étudiant a bien été ajouté";
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
    <form method="POST">

        <label for="input-email-student">Email</label>
        <input type="email" name="input-email-student">

        <label for="input-fullname">Nom complet</label>
        <input type="text" name="input-fullname">

        <label for="input-gender">Sexe</label>
        <select name="input-gender">
            <option>Homme</option>
            <option>Femme</option>
        </select>

        <label for="input-birthdate">Date de naissance</label>
        <input type="date" name="input-birthdate">

        <label for="input-grade_id">Grade</label>
        <input type="number" name="input-grade_id">

        <button type="submit" value="Submit">Soumettre</button>
    </form>
    <?php if (isset($_POST['input-email-student']) && isset($_POST['input-fullname']) && isset($_POST['input-gender']) && isset($_POST['input-birthdate']) && isset($_POST['input-grade_id'])) {
        var_dump($_POST);   
        insert_student($_POST);
    } else {
        echo "Veuillez remplir tous les champs";
    }
    ?>

</body>

</html>