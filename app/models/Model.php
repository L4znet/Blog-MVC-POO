<?php
class Model
{
    protected static function dbConnect()
    {
        return new PDO('mysql:host=localhost;port=;dbname=blog_mvc', 'root', '');
    }


    protected static $table_name;
    
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

    public static function delete($id)
    {
        $connexion = self::dbConnect();
        $query = $connexion->prepare("DELETE FROM  " . self::guessTableName() . " WHERE id = :id");

        $query->execute(['id' => $id]);

        return this::find($id);
    }
}
