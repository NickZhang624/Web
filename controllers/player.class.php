<?php
require_once 'models/model.class.php';

class PlayerController extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function byTeam($id){

        $arr = array('id'=>$id);
        $sql= 'SELECT * FROM players_teams_vw WHERE team_id =:id LIMIT 30';
        $this->all($sql, $arr);
    }

    public function show($id){

        $arr = array('player_id'=>$id);
        $sql= 'SELECT name, team, position, age, height, weight FROM players_teams_vw WHERE player_id =:id';
        $this->findOne($sql, $id);
    }
}