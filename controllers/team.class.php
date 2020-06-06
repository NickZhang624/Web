<?php
require_once 'models/model.class.php';

class TeamController extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $sql = 'SELECT distinct id, team, logo FROM teams ORDER BY team asc';
        $this->query($sql);
    }

    public function show($id){
        $sql = 'SELECT * FROM teams WHERE id =:id';
        $this->findOne($sql, $id);
    }
}
