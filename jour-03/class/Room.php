<?php

class Room {
    
    private int $id;
    private int $floor_id;
    private string $name;
    private int $capacity;
    protected static $pdo;
    private string $tableName;

    public function __construct(int $id = null, int $floor_id = null, string $name = null, int $capacity = null) 
    {
        if($id !== null) $this->id = $id;
        if($floor_id !== null) $this->floor_id = $floor_id;
        if($name !==null) $this->name = $name;
        if($capacity !== null) $this->capacity = $capacity;
        $this->tableName = "room";
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

    public function getFloorId() : int 
    {
        return $this->floor_id;
    }

    public function getName() : string
    {
        return $this->name;
    }

    public function getCapacity() : int 
    {
        return $this->capacity;
    }

    public function setId(int $id) : void 
    {
        $this->id = $id;
    }

    public function setFloorId(int $floor_id) : void 
    {
        $this->floor_id = $floor_id;
    }

    public function setName(string $name) : void 
    {
        $this->name = $name;
    }

    public function setCapacity(int $capacity) : void 
    {
        $this->capacity = $capacity;
    }

    public function findOneRoom(int $id)
    {
        $query = "SELECT * FROM $this->tableName WHERE id = :id";
        $request = self::getPdo()->prepare($query);
        $request->execute([":id" => $id]);
        $result = $request->fetchAll(pdo::FETCH_ASSOC);
        $this->setId($id);
        $this->setFloorId($result[0]['floor_id']);
        $this->setName($result[0]['name']);
        $this->setCapacity($result[0]['capacity']);
        return $this;
    }

    public function getGrades()  : array
    {
        $this->tableName = "grade";
        $query = "SELECT * FROM $this->tableName WHERE room_id = :room_id";
        $request = self::getPdo()->prepare($query);
        $request->execute([":room_id" => $this->id]);
        $result = $request->fetchAll(pdo::FETCH_ASSOC);
        return $result;

    }

}

?>