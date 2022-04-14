<?php 

class Database {
    protected $database;
    protected $models;
    protected $extra;
    protected $data = [];
    protected $RequestReady = false;
    protected $RequestQuery = "";
    protected $table;
    protected $Exception = null;
    public function __construct(Settings $DBConfig) {
        $hostname = $DBConfig->get('hostname');
        $database = $DBConfig->get('database');
        $username = $DBConfig->get('username');
        $password = $DBConfig->get('password');
        $this->database = $this->connect($database, $hostname, $username, $password);
    }
    
    public function getException() {
        return $this->Exception;
    }
    protected function connect($db_database, $db_hostname, $db_username, $db_password) {
        try { 
            $pdo = new PDO("mysql:host=$db_hostname;dbname=$db_database;charset=utf8mb4", $db_username, $db_password); 
            $pdo->setAttribute(PDO::ATTR_CASE, PDO::CASE_LOWER);
            $pdo->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch(PDOException $e) {
            $this->Exception = $e;
        }
    }
    public function select($table) {
        $this->table = $table;
        $this->RequestReady = false;
        return $this;
    }
    public function lastInsertId() {
        $db = $this->database;
        return $db->lastInsertId();

    }
    public function insert($data) {
        $db = $this->database;
        $table = $this->table;
        $model = $this->models->getModels()[$table]; 
        $prefix = $model[1];
        $model = $model[0];
    
        $keys = [];
        $values = [];      
        foreach ($model as $c) {
            $keys[] = $prefix."_".$c;
            $values[] = "?";
        } 
        $Keys = join(",", $keys);
        $Values = join(",", $values);
        $query = "INSERT INTO `$table` ($Keys) VALUES ($Values);"; 
        
        $request = $db->prepare($query);
        if ($request->execute($data))
            return true;
        return false;
    }
    public function delete($val, $col) {
        $db = $this->database;
        $table = $this->table;
        $query = "DELETE FROM $table WHERE $col = ?;";
        $request = $db->prepare($query);
        if ($request->execute([$val]))
            return true;
        return false;

    }
    public function e() {
        $db = $this->database;
        return $db->prepare($this->RequestQuery)->execute($this->data);
    }
    public function extra($extra) {
        $this->extra = $extra;
        return $this;
    }
    public function bindData($data) {
        $this->data = $data;
        return $this;
    }
    public function join($with, $col1 = '', $col2 = '') {
        $db = $this->database;
        $table = $this->table;
        $pref1 = $this->models->getModels()[$table][1];
        $pref2 = $this->models->getModels()[$with][1];
        if ($col1 == '' || $col2 == '') {
            $col1 = 'id';
            $col2 = $pref1."_id";
        }
        $col1 = $pref1."_".$col1;
        $col2 = $pref2."_".$col2;
        $extra = $this->extra;
        if ($extra) {
            $extra = " AND $extra";
        }
        $query = "SELECT T1.*, T2.* 
        FROM $table T1, $with T2 
        WHERE T1.$col1 = T2.$col2 $extra;";
        $this->RequestReady = true;
        $this->RequestQuery = $query;
        return $this;
    }
    public function query($query, $data = []) {
        $this->RequestReady = true;
        $this->RequestQuery = $query;
        $this->bindData($data);
        return $this;
    }

    public function fetchAll() {
        $db = $this->database;
        if (!$this->RequestReady) {
            $table = $this->table;
            $extra = $this->extra;
            if ($table != null) {
                $query = "SELECT * FROM $table $extra;";
            }
        } else {
            $query = $this->RequestQuery;
        }
        $request = $db->prepare($query);
        $request->execute($this->data);
        $result = $request->fetchAll(PDO::FETCH_ASSOC);
        return $result;
        
    } 
    
}

?>