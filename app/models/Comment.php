<?php
class Comment extends Model
{
    protected static $table_name = 'comments';

    public static function get()
    {
        $connexion = self::dbConnect();
        $query = $connexion->prepare("SELECT * FROM comments WHERE deleted IS NULL AND validate = :validate ORDER BY created_at DESC");

        $query->execute(['validate' => 0]);
        return $query->fetchAll(PDO::FETCH_CLASS, 'Comment');
    }

    public static function getForArticle($id)
    {
        $connexion = self::dbConnect();
        $query = $connexion->prepare("SELECT * FROM comments WHERE article_id = :article_id AND validate = :validate ORDER BY created_at DESC");

        $query->execute(['article_id' => $id, 'validate' => 1]);
        return $query->fetchAll(PDO::FETCH_CLASS, 'Comment');
    }

    public static function getForUser($user_id)
    {
        $connexion = self::dbConnect();
        $query = $connexion->prepare("SELECT * FROM comments WHERE user_id = :user_id AND validate = :validate ORDER BY created_at DESC");

        $query->execute(['user_id' => $user_id, 'validate' => 1]);
        return $query->fetchAll(PDO::FETCH_CLASS, 'Comment');
    }

    public static function getNotValidate()
    {
        $connexion = self::dbConnect();
        $query = $connexion->prepare("SELECT * FROM comments WHERE validate = :validate ORDER BY created_at DESC");

        $query->execute(['validate' => 0]);
        return $query->fetchAll(PDO::FETCH_CLASS, 'Comment');
    }

    public static function validate($id)
    {
        $connexion = self::dbConnect();
        $validate = 1;
        $q = array('id' => $id, 'validate' => $validate);
       
        $query = $connexion->prepare("UPDATE comments SET validate = :validate WHERE id = :id");

        $result = $query->execute($q);

        return $result;
    }

    public static function create($data)
    {
        $connexion = self::dbConnect();
        $query = $connexion->prepare("INSERT INTO comments (article_id, author, text) VALUES (:article_id, :author, :text)");

       
        $query->execute(['article_id' => $data['article_id'], 'author' => $data['author'], 'text' => $data['text']]);
        $id = $connexion->lastInsertId();

        return Comment::find($article_id, $id);
    }

    public static function update($data, $id)
    {
        $connexion = self::dbConnect();
        $q = array('author' => $data['author'], 'text' => $data['text'], 'id' => $id, 'updated_at' => date('Y-m-d H:i:s'));
        
        $query = $connexion->prepare("UPDATE comments SET author = :author, text = :text, updated_at = :updated_at WHERE id = :id");

        $query->execute($q);
        $id = $connexion->lastInsertId();

        return Comment::find($id);
    }

    public static function delete($id)
    {
        $connexion = self::dbConnect();
        $query = $connexion->prepare("DELETE FROM comments WHERE id = :id");

        $query->execute(['id' => $id]);

        return Article::find($id);
    }
}
