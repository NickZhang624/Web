<?php
class Model
{
    protected $db;

    public function __construct()
    {
        $this->db = new SQLite3('data/db.sqlite3', SQLITE3_OPEN_CREATE | SQLITE3_OPEN_READWRITE);
    }

    /*** For plain generic queries with no parameters***/
    protected function query($sql)
    {
        $results = $this->db->query($sql);
        $this->outputNestedObject($results);
    }

    /*** For retrieving a single row result ***/
    protected function findOne($sql, $id)
    {
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id, SQLITE3_TEXT);
        $results = $stmt->execute();
        $this->outputPlainObject($results);
    }

    /*** For retrieving all records with or without a WHERE clause ***/
    protected function all($sql, $arr = null)
    {
        $stmt = $this->db->prepare($sql);
        foreach ($arr as $key => $value) {
            $stmt->bindValue(":$key", $value, SQLITE3_TEXT);
        }
        $results = $stmt->execute();
        $this->outputNestedObject($results);
    }

    protected function insert($sql, $arr = null)
    {
        unset($_SESSION["error_message"]);
        $stmt = $this->db->prepare($sql);
        foreach ($arr as $key => $value) {
            $stmt->bindValue(":$key", $value, SQLITE3_TEXT);
        }
        $result = $stmt->execute();
        if($result == FALSE){
            $_SESSION["error_message"] = $this->db->lastErrorMsg();
        }
    }

    protected function update($sql, $arr)
    {
        $stmt = $this->db->prepare($sql);
        foreach ($arr as $key => $value) {
            $stmt->bindValue(":$key", $value, SQLITE3_TEXT);
        }
        $stmt->execute();
    }

    protected function delete($sql, $id = null)
    {
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id, SQLITE3_TEXT);
        $stmt->execute();
    }

     /*** For outputting a simple JSON object ***/
    protected function outputPlainObject($result)
    {
        while ($res = $result->fetchArray(SQLITE3_ASSOC)) {
            echo json_encode($res);
        }
        exit();
    }

    /*** For outputting a more complex JSON object ***/
    protected function outputNestedObject($result)
    {
        $data = array();
        while ($res = $result->fetchArray(1)) {
            array_push($data, $res);
        }
        echo "{\"data\":" . json_encode($data) . "}";
        exit();
    }

}

