<?php
// namespace App\Users;

class User
{
    public $id;
    public $login;
    public $mail;
    public $passwd;
    public $profile;
    public $creation_date;

    public function __construct($data = null)
    {
        if (is_array($data)) {
            $this->login = $data['login'];
            $this->mail = $data['mail'];
            $this->passwd = $data['passwd'];
            $this->profile = 'NORMAL';
        }
    }

    public function checkUserNonexistant($db)
    {
        // Xavier : a modifier ici
        return true;
    }

    public function persist($db)
    {
        if ($this->checkUserNonexistant($db))
        {
            $statement = $db->prepare(
            'insert into User
            (login, mail, passwd, profile, creation_date)
            values
            (:login, :mail, :passwd, :profile, NOW())'
            );
            $statement->bindParam(':login', $this->login);
            $statement->bindParam(':mail', $this->mail);
            $statement->bindParam(':passwd', $this->passwd);
            $statement->bindParam(':profile', $this->profile);
        
            $statement->execute();
            return true;
        }
        else 
            return false;
    }
}
