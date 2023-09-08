<?php

class Student
{

    private int $id;
    private int $grade_id;
    private string $email;
    private string $fullname;
    private DateTime $birthdate;
    private string $gender;
    protected static $pdo;
    private string $tableName;

    public function __construct(
        int $id = null,
        int $grade_id = null,
        string $email = null,
        string $fullname = null,
        DateTime $birthdate = null,
        string $gender = null
    ) {
        if ($id !== null) $this->id = $id;
        if ($grade_id !== null) $this->grade_id = $grade_id;
        if ($email !== null) $this->email = $email;
        if ($fullname !== null) $this->fullname = $fullname;
        if ($birthdate !== null) $this->birthdate = $birthdate;
        if ($gender !== null) $this->gender = $gender;
        $this->tableName = "student";
    }

    public static function connect()
    {
        $password = (PHP_OS == 'Linux') ? '' : 'root';
        $dsn = 'mysql:host=localhost;dbname=lp_official;charset=utf8';
        self::$pdo = new \PDO($dsn, 'root', $password);
    }

    protected static function getPdo()
    {
        if (!self::$pdo) {
            self::connect();
        }
        return self::$pdo;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getIdGrade(): int
    {
        return $this->grade_id;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getFullname(): string
    {
        return $this->fullname;
    }

    public function getBirthdate(): DateTime
    {
        return $this->birthdate;
    }

    public function getGender(): string
    {
        return $this->gender;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function setIdGrade(int $grade_id): void
    {
        $this->grade_id = $grade_id;
    }

    public function setFullName(string $fullname): void
    {
        $this->fullname = $fullname;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function setBirthdate(DateTime $birthdate): void
    {
        $this->birthdate = $birthdate;
    }

    public function setGender(string $gender): void
    {
        $this->gender = $gender;
    }

    public function findOneStudent(int $id)
    {
        $query = "SELECT * FROM $this->tableName WHERE id = :id";
        $request = self::getPdo()->prepare($query);
        $request->execute([":id" => $id]);
        $result = $request->fetchAll(pdo::FETCH_ASSOC);
        $this->setId($id);
        $this->setIdGrade($result[0]['grade_id']);
        $this->setEmail($result[0]['email']);
        $this->setFullName($result[0]['fullname']);
        $this->setBirthdate(new DateTime($result[0]['birthdate']));
        $this->setGender($result[0]['gender']);
        return $this;
    }
}

