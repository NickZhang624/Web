<?php
require_once 'models/model.class.php';

class AuthController extends Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function register($user)
    {
        $salt = uniqid(mt_rand(), true);
        $pepper = "sfl%-36**8gdrg&80?";
        $password = $salt . $_POST["password"] . $pepper;
        $hash = hash('sha512', $password);

        $sql = "INSERT INTO users (username, passwd, salt) VALUES (:username,:passwd,:salt)";
        $arr = array('username' => $user['username'], 'passwd' =>$hash, 'salt'=>$salt);

        $this->insert($sql, $arr);
        if (isset($_SESSION["error_message"])){
            header("Location: /register_form");
        }else{
            header("Location: /login_form");
        }
    }

    public function authenticate($user){
        unset($_SESSION["error_message"]);
        $salt = $this ->getSaltValue($user["username"]);
        $pepper = "sfl%-36**8gdrg&80?";
        $password = $salt . $_POST["password"] . $pepper;
        $hash = hash('sha512', $password);
        $select = "SELECT count(*) as count, id, role FROM users
        WHERE username =:username
        AND passwd =:passwd";

        $stmt = $this->db->prepare($select);
        $stmt->bindValue(':username', $_POST['username'], SQLITE_TEXT);
        $stmt->bindValue(':passwd', $hash, SQLITE_TEXT);

        $result = $stmt->execute();
        $row = $stmt->fetchArray();
        if($row['count'] > 0 && $row['role'] === 'admin'){
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $_POST['username'];
            header("Location: /admin/admin_dashboard");
            exit();
        }else if($row['count'] > 0 && $row['role'] === 'team_admin'){
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $_POST['username'];
            $_SESSION['id'] = $row['id'];
            header("Location: /admin/team_dashboard");
            exit();
        }else{
            $_SESSION['error_message'] = "Sorry we don't have that user!";
            header("Location: /login_form");
        }
    }

    public function logout(){
        session_destroy();
        header("Location: /");
    }
    

    private function getSaltValue($salt){
        $salt = "SELECT salt FROM users
        WHERE username =:username";

        return $salt;
    }
}