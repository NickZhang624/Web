<?php
session_start();
require_once  'controllers/team.class.php';
require_once  'controllers/player.class.php';
require_once  'controllers/coach.class.php';
require_once  'controllers/auth.php';

if(!isset($_GET['team_id'])){
    $_GET['team_id'] = null;
}

if(!isset($_GET['player_id'])){
    $_GET['player_id'] = null;
}
