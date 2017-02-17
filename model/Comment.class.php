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

}
