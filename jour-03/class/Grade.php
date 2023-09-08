<?php

class Grade {
    
    private int $id;
    private int $room_id;
    private string $name;
    private DateTime $year;
    protected static $pdo;
    private string $tableName;

    public function __construct(int $id = null, int $room_id = null, string $name = null, DateTime $year = null) 
    {
        if($id !== null) $this->id = $id;
        if($room_id !== null) $this->room_id = $room_id;
        if($name !==null) $this->name = $name;
        if($year !== null) $this->year = $year;
        $this->tableName = "grade";
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

    public function getId() : int 
    {
        return $this->id;
    }

    public function getRoomId() : int 
    {
        return $this->room_id;
    }

    public function getName() : string 
    {
        return $this->name;
    }

    public function getYear() : DateTime 
    {
        return $this->year;
    }

    public function setId(int $id) : void 
    {
        $this->id = $id;
    }

    public function setRoomId(int $room_id) : void 
    {
        $this->room_id = $room_id;
    }

    public function setName(string $name) : void 
    {
        $this->name = $name;
    }

    public function setYear(DateTime $year) : void 
    {
        $this->year = $year;
    }

    public function findOneGrade(int $id)
    {
        $query = "SELECT * FROM $this->tableName WHERE id = :id";
        $request = self::getPdo()->prepare($query);
        $request->execute([":id" => $id]);
        $result = $request->fetchAll(pdo::FETCH_ASSOC);
        $this->setId($id);
        $this->setRoomId($result[0]['room_id']);
        $this->setName($result[0]['name']);
        $this->setYear(new DateTime($result[0]['year']));
        return $this;
    }

    public function getStudents() : array 
    {
        $this->tableName = "student";
        $query = "SELECT * FROM $this->tableName WHERE grade_id = :grade_id";
        $request = self::getPdo()->prepare($query);
        $request->execute([":grade_id" => $this->id]);
        $result = $request->fetchAll(pdo::FETCH_ASSOC);
        return $result;
    }

}

?>