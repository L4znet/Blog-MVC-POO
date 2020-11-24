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
        $query = $connexion->prepare("INSERT INTO users (username, password, lastname, firstname, email, adress, zipcode, city, phone, grade) VALUES (:username, :password, :lastname, :firstname, :email, :adress, :zipcode, :city, :phone, :grade)");
        $test = $query->execute($data);
        if (!$test) {
            printf("Message d'erreur : %s\n", $connexion->error);
            die;
        }
    }

    public static function update($data, $id)
    {
        $q = array('lastname' => $data['lastname'], 'password' => $data['password'],  'firstname' => $data['firstname'], 'username' => $data['username'], 'email' => $data['email'], 'adress' => $data['adress'], 'zipcode' => $data['zipcode'], 'city' => $data['city'], 'grade' => $data['grade'], 'phone' => $data['phone'], 'id' => $id, 'updated_at' => date('Y-m-d H:i:s'));
        $connexion = self::dbConnect();
        $query = $connexion->prepare("UPDATE users SET lastname = :lastname, password = :password,  firstname = :firstname, username = :username, email = :email, adress = :adress, zipcode = :zipcode, city = :city, phone = :phone, grade = :grade, updated_at = :updated_at WHERE id = :id");
        $query->execute($q);
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

    public static function delete($id)
    {
        $connexion = self::dbConnect();
        $query = $connexion->prepare("DELETE FROM  users WHERE id = :id");

        $query->execute(['id' => $id]);
    }
}
