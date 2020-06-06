<?php
require_once 'models/model.class.php';

class CoachController extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function show($id){

        $arr = array('team_id'=>$id);
        $sql= 'SELECT distinct coach FROM players_teams_vw WHERE team_id =:id';
        $this->findOne($sql, $id);
    }
}