<?php

class Floor {
    
    private int $id;
    private string $name;
    private int $level;
    protected static $pdo;
    private string $tableName;

    public function __construct(int $id = null, int $level = null, string $name = null) 
    {
        if($id !== null) $this->id = $id;
        if($level !== null) $this->level = $level;
        if($name !==null) $this->name = $name;
        $this->tableName = "floor";
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

    public function getName() : string 
    {
        return $this->name;
    }

    public function getLevel() : int 
    {
        return $this->level;
    }

    public function setId(int $id) : void 
    {
        $this->id = $id;
    }

    public function setName(string $name) : void 
    {
        $this->name = $name;
    }

    public function setLevel(int $level) : void 
    {
        $this->level = $level;
    }

    public function findOneFloor(int $id)
    {
        $query = "SELECT * FROM $this->tableName WHERE id = :id";
        $request = self::getPdo()->prepare($query);
        $request->execute([":id" => $id]);
        $result = $request->fetchAll(pdo::FETCH_ASSOC);
        $this->setId($id);
        $this->setName($result[0]['name']);
        $this->setLevel($result[0]['level']);
        return $this;
    }

    public function getRooms() : array
    {
        $this->tableName = "room";
        $query = "SELECT * FROM $this->tableName WHERE floor_id = :floor_id";
        $request = self::getPdo()->prepare($query);
        $request->execute([":floor_id" => $this->id]);
        $result = $request->fetchAll(pdo::FETCH_ASSOC);
        return $result;

    }
}

?>