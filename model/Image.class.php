<?php

class Image
{
    public $id;
    public $user_id;
    public $image_name;
    public $creation_date;

    public function __construct($data = null)
    {
        // a faire
    }


    public function listBestPhotos($db)
    {
        $statement = $db->prepare("SELECT i.image_name, count(l.id) likes FROM Image i INNER JOIN like_table l ON i.id = l.image_id GROUP BY i.image_name DESC");
        $statement->execute();
        $result = $statement->fetchAll();
        return $result;
    }
}
