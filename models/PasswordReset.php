<?php
require_once 'models/Model.php';

class PasswordReset extends Model
{
    public $member_id;
    public $password;
    public $token;
    public $id_valid;
    public $expired_at;
    public $create_at;
    public function insert(){
        $obj_insert = $this->connection->prepare("INSERT INTO password_reset(member_id, token, expired_at)
        VALUES (:member_id, :token, :expired_at)");
        $time = date('Y-m-d H:i:s');
        // expire the token after 12 hours
        $RESET_TOKEN_LIFE = '10 minutes';
        $this->expired_at = date('Y-m-d H:i:s', strtotime($time . ' + ' . $RESET_TOKEN_LIFE));
        $arr_insert= [
          ':member_id' => $this->member_id,
          ':token' => $this->token,
          ':expired_at' => $this->expired_at
        ];
        return $obj_insert->execute($arr_insert);;
    }
    public function getID(){
        $obj_select = $this->connection->prepare("SELECT * FROM password_reset 
            WHERE token = :token AND is_valid = 0 AND expired_at >= now()");
        $arr_select = [
            ':token' => $this->token
        ];
        $obj_select->execute($arr_select);
        return $obj_select->fetch(PDO::FETCH_ASSOC);
    }
    public function updateValid() {
        $obj_update = $this->connection->prepare("UPDATE password_reset SET is_valid  = 1 WHERE token = :token");
        $arr_update = [
            ':token' => $this->token
        ];
        return $obj_update->execute($arr_update);
    }
}