<?php
require __DIR__ . '/../config/database.php';

class Image
{
    public $id;
    public $user_id;
    public $image_name;
    public $creation_date;

    public function __construct($data = null)
    {
        if (is_array($data)) {
            if (isset($data['user_id']))
                $this->user_id = $data['user_id'];
            if (isset($data['image_name']))
                $this->image_name = $data['image_name'];
        }
    }


    public function listBestPhotos($db)
    {
        $statement = $db->prepare("SELECT i.image_name, count(l.id) likes FROM Image i INNER JOIN like_table l ON i.id = l.image_id GROUP BY i.image_name DESC");
        $statement->execute();
        $result = $statement->fetchAll();
        return $result;
    }

    public function persist($db)
    {
        $statement = $db->prepare('INSERT INTO Image
        (user_id, image_name)
        VALUES
        (:user_id, :image_name)');
        $statement->bindParam(':user_id', $this->user_id);
        $statement->bindParam(':image_name', $this->image_name);
        $statement->execute();
        return true;
    }
}
