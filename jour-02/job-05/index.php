<?php
function find_full_rooms()
{
    $password = '';
    $dsn = 'mysql:host=localhost;dbname=lp_official;charset=utf8';
    $pdo = new PDO($dsn, 'root', $password);

    $requestReadAll = "SELECT room.id AS room_id, room.name AS room_name, room.capacity, grade.id AS grade_id,
    grade.room_id AS grade_room_id, grade.name AS grade_name, student.id AS student_id, student.grade_id AS grade_id,
    student.fullname AS student_name FROM room
    INNER JOIN grade ON room.id = grade.room_id
    INNER JOIN student ON grade.id = student.grade_id";

    $queryReadAll = $pdo->prepare($requestReadAll);

    $queryReadAll->execute();

    $resultReadAll = $queryReadAll->fetchAll(pdo::FETCH_ASSOC);

    $roomsAttendance = [];

    foreach ($resultReadAll as $key => $value) {
        if (!isset($roomsAttendance[$value['room_id']]['attendance'])) {
            $roomsAttendance[$value['room_id']]['attendance'] = 0;
        }
        if ($value['room_id'] == $value['grade_room_id']) {
            $roomsAttendance[$value['room_id']]['attendance'] += 1;
        }
    }

    $resultReadAll = array_map(function ($room) use ($roomsAttendance) {
        if (isset($roomsAttendance[$room['room_id']]['attendance'])) {
            $room['attendance'] = $roomsAttendance[$room['room_id']]['attendance'];
        } else {
            $room['attendance'] = 0;
        }
        return $room;
    }, $resultReadAll);

    return $resultReadAll;
}

function display_rooms()
{
    $data = find_full_rooms();
    $rooms = [];
    echo "
    <table>
        <thead>
              <tr>
                  <th>Name</th>
                  <th>Capacity</th>
                  <th>Attendance</th>
                  <th>IsFull</th>
              </tr>
          </thead>
        <tbody>";
    foreach ($data as $key => $value) {
        if (!in_array($value['room_name'], $rooms)) {
            echo "<tr>";
            echo "<td>" . $value['room_name'] . "</td>";
            echo "<td>" . $value['capacity'] . "</td>";
            echo "<td>" . $value['attendance'] . "</td>";
            if ($value['attendance'] >= $value['capacity']) {
                echo "<td>Yes</td>";
            } else {
                echo "<td>No</td>";
            }
            array_push($rooms, $value['room_name']);
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

    <?= display_rooms() ?>

</body>

</html>