<?php
require_once 'models/model.class.php';

class UserController extends Model{
    public function __construct(){
        parent::__construct();
    }

    public function index(){
        $sql = 'SELECT * FROM users';
        $this->all($sql);       
    }

    public function destroy($id){
        $sql = 'DELETE FROM users WHERE id = :id';
        $this->delete($sql,$id);
    }

    public function show($id){
        $sql = 'SELECT * FROM users WHERE id = :id';
        $this->findOne($sql,$id);
    }
}