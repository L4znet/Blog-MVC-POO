<?php
class Article extends Model
{
    protected static $table_name = 'articles';

    public static function get()
    {
        $connexion = self::dbConnect();
        $query = $connexion->prepare("SELECT * FROM articles ORDER BY id DESC");

        $query->execute();
        return $query->fetchAll(PDO::FETCH_CLASS, 'Article');
    }


    public static function create($data)
    {
        $connexion = self::dbConnect();
        $query = $connexion->prepare("INSERT INTO articles (title, text) VALUES (:title, :text)");

       
        $query->execute($data);
        $id = $connexion->lastInsertId();

        return Article::find($id);
    }

    public static function update($data, $id)
    {
        $q = array('title' => $data['title'], 'text' => $data['text'], 'id' => $id, 'updated_at' => date('Y-m-d H:i:s'));
        $connexion = self::dbConnect();
        $query = $connexion->prepare("UPDATE articles SET title = :title, text = :text, updated_at = :updated_at WHERE id = :id");

        $query->execute($q);
        $id = $connexion->lastInsertId();

        return Article::find($id);
    }

    public static function soft_destroy($id)
    {
        $q = array('deleted_at' => 1, 'id' => $id);
        $connexion = self::dbConnect();
        $query = $connexion->prepare("UPDATE articles SET deleted_at = :deleted_at WHERE id = :id");

        $query->execute($q);
        $id = $connexion->lastInsertId();

        return Article::find($id);
    }

    public static function restore($id)
    {
        $q = array('deleted_at' => null, 'id' => $id);
        $connexion = self::dbConnect();
        $query = $connexion->prepare("UPDATE articles SET deleted_at = :deleted_at WHERE id = :id");

        $query->execute($q);
        $id = $connexion->lastInsertId();

        return Article::find($id);
    }

    public static function hard_destroy($id)
    {
        $connexion = self::dbConnect();
        $query = $connexion->prepare("DELETE FROM articles WHERE id = :id");

        $query->execute(['id' => $id]);

        return Article::find($id);
    }
}
