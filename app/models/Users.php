<?php
class Users extends Model
{
    protected static $table_name = 'users';

    public static function findUsingParams($param, $data)
    {
        $connexion = self::dbConnect();
        $query = $connexion->prepare("SELECT * FROM users WHERE $param = :$param");

        $query->execute(["{$param}" => $data]);
        $data = $query->fetchObject('Users');
        
        return $data;
    }

    public static function get()
    {
        $connexion = self::dbConnect();
        $query = $connexion->prepare("SELECT * FROM users ORDER BY id DESC");

        $query->execute();
        return $query->fetchAll(PDO::FETCH_CLASS, 'Users');
    }


    public static function create($data)
    {
        $connexion = self::dbConnect();
        $query = $connexion->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");

       
        $query->execute($data);
        $id = $connexion->lastInsertId();

        return Users::find($id);
    }

    public static function update($data, $id)
    {
        $q = array('title' => $data['title'], 'text' => $data['text'], 'id' => $id, 'updated_at' => date('Y-m-d H:i:s'));
        $connexion = self::dbConnect();
        $query = $connexion->prepare("UPDATE users SET username = :username, password = :password, updated_at = :updated_at WHERE id = :id");

        $query->execute($q);
        $id = $connexion->lastInsertId();

        return Article::find($id);
    }

    public static function can($rank_needed, $id)
    {
        $connexion = self::dbConnect();
        $query = $connexion->prepare("SELECT rank FROM users WHERE id = :id");

        $query->execute(['id' => $id]);
        $data = $query->fetchObject('Users');
        
        if ($data == $rank_needed) {
            return true;
        } else {
            return false;
        }
    }
}
