<?php
require __DIR__ . '/../config/database.php';

class Comment
{
    public $id;
    public $description;
    public $image_id;
    public $liker_id;
    public $creation_date;

    public function __construct($data = null)
    {
        if (is_array($data)) {
            if (isset($data['description']))
                $this->description = $data['description'];
            if (isset($data['image_id']))
                $this->image_id = $data['image_id'];
            if (isset($data['liker_id']))
                $this->liker_id = $data['liker_id'];
        }
    }

    public function listByimage($db)
    {
        $statement = $db->prepare("SELECT id, description, liker_id, creation_date FROM Comment WHERE image_id = :image_id ORDER BY creation_date DESC");
        $statement->bindParam(':image_id', $this->image_id);
        $statement->execute();
        $result = $statement->fetchAll();
        return $result;
    }

    public function listByUser($db)
    {
        $statement = $db->prepare("SELECT id, description, image_id, creation_date FROM Comment WHERE liker_id = :liker_id ORDER BY creation_date DESC");
        $statement->bindParam(':liker_id', $this->liker_id);
        $statement->execute();
        $result = $statement->fetchAll();
        return $result;
    }

}
