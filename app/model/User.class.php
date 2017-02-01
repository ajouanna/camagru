<?php

class User
{
    public $id;
    public $login;
    public $mail;
    public $passwd;
    public $profile;
    public $creation_date;
    public $status;

    public function __construct($data = null)
    {
        if (is_array($data)) {
            $this->login = $data['login'];
            $this->mail = $data['mail'];
            $this->passwd = hash('whirlpool',$data['passwd']); // le mdp est encode directement
            $this->profile = 'NORMAL';
            $this->status = 'NOT_ACTIVATED';
        }
    }

    public function checkUserNonexistant($db)
    {
        $sql = 'SELECT count(*) FROM User WHERE login ="'.$this->login.'" OR mail = "'.$this->mail.'"';
        $count = $db->query($sql)->fetchColumn();
        if ($count > 0)
            return false;
        return true;
    }

    public function persist($db)
    {
        if ($this->checkUserNonexistant($db))
        {
            $statement = $db->prepare('INSERT INTO User
            (login, mail, passwd, profile, creation_date, status)
            VALUES
            (:login, :mail, :passwd, :profile, NOW(), :status)'
            );
            $statement->bindParam(':login', $this->login);
            $statement->bindParam(':mail', $this->mail);
            $statement->bindParam(':passwd', $this->passwd);
            $statement->bindParam(':profile', $this->profile);
            $statement->bindParam(':status', $this->status);
            $statement->execute();
            return true;
        }
        else 
            return false;
    }
}
