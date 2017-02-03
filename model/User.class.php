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

    public function checkCredentials($db)
    {
        // cette methode recupere en base le profil de l'utilisateur a partir de login et passwd
        // et renvoie true si ces valeurs sont correctes, false sinon

        /*
        $sql = 'SELECT count(*) FROM User WHERE login ="'.$this->login.'" AND passwd = "'.$this->passwd.'"';
        $count = $db->query($sql)->fetchColumn();
        if ($count > 0) 
                return true;
        return false; */
        $sql = 'SELECT PROFILE FROM User WHERE login ="'.$this->login.'" AND passwd = "'.$this->passwd.'"';
        $statement = $db->prepare($sql);
        $statement->execute();
        $result = $statement->fetchColumn();

        if ($result === false)
            return false;
        $this->profile=$result;
        return true;
    }

    public function listAll($db)
    {
        $statement = $db->prepare("SELECT login, mail, profile, status FROM User");
        $statement->execute();
        $result = $statement->fetchAll();
        return $result;
    }
}
