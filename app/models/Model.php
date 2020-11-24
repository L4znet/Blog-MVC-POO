<?php
class Model
{
    protected static function dbConnect()
    {
        $pdo = new PDO('mysql:host=localhost;port=;dbname=blog_mvc', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        return $pdo;
    }
    protected static $table_name;



    public static function get()
    {
        $connexion = self::dbConnect();
        $query = $connexion->prepare("SELECT * FROM " . self::guessTableName() . " ORDER BY id DESC");

        $query->execute();
        return $query->fetchAll(PDO::FETCH_CLASS, 'Model');
    }


    public static function find($id)
    {
        $table_name = static::$table_name;

        $connexion = self::dbConnect();
        $query = $connexion->prepare("SELECT * FROM  " . self::guessTableName() . " WHERE id = :id");

        $query->execute(['id' => $id]);
        $data = $query->fetchObject(static::class);
        return $data;
    }


    private static function guessTableName()
    {
        if (isset(static::$table_name)) {
            return static::$table_name;
        } else {
            return strtolower(static::class) . 's';
        }
    }
}
