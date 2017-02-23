<?php

class User
{
    public $login;
    public $mail;
    public $passwd;
    public $cle;
    public $profile;
    public $creation_date;
    public $status;

    public function __construct($data = null)
    {
        if (is_array($data)) {
			if (isset($data['login']))
				$this->login = $data['login'];
			if (isset($data['mail']))
				$this->mail = $data['mail'];
			if (isset($data['passwd']))
				$this->passwd = $data['passwd'];
            if (isset($data['cle']))
                $this->cle = $data['cle'];
            $this->profile = 'NORMAL'; // je n'autorise pas la creation d'un admin par ce biais
            $this->status = 'NOT_ACTIVATED';
        }
    }

    public function checkUserNonexistant($db)
    {
        $sql = 'SELECT count(*) FROM User WHERE login ="'.$this->login.'"';
        $count = $db->query($sql)->fetchColumn();
        if ($count > 0)
            return false;
        return true;
    }

    public function persist($db)
    {
        if ($this->checkUserNonexistant($db))
        {
			try {
            $statement = $db->prepare('INSERT INTO User
            (login, mail, passwd, cle, profile, creation_date, status)
            VALUES
            (:login, :mail, :passwd, :cle, :profile, NOW(), :status)'
            );
            $statement->bindParam(':login', $this->login);
            $statement->bindParam(':mail', $this->mail);
            $statement->bindParam(':passwd', $this->passwd);
            $statement->bindParam(':cle', $this->cle);
            $statement->bindParam(':profile', $this->profile);
            $statement->bindParam(':status', $this->status);
            $statement->execute();
			}
			catch (PDOException $e)
			{
				// a priori, ce cas n'arrive qu'en cas de doublon sur mail
				return false;
			}
            return true;
        }
        else 
            return false;
    }

    public function checkCredentials($db)
    {
        // cette methode recupere en base le profil de l'utilisateur a partir de login et passwd
        // et renvoie true si ces valeurs sont correctes, false sinon

        $sql = 'SELECT profile, status FROM User WHERE login ="'.$this->login.'" AND passwd = "'.$this->passwd.'"';
        $statement = $db->prepare($sql);
        $statement->execute();
        $result = $statement->fetchAll();

        if (count($result) === 0)
            return false;
        $value = $result[0];
        $this->profile = $value['profile'];
        $this->status = $value['status'];
        return true;
    }

    public function listAll($db)
    {
        $statement = $db->prepare("SELECT login, mail, profile, status FROM User");
        $statement->execute();
        $result = $statement->fetchAll();
        return $result;
    }

    public function getDb($db)
    {
        // cette methode renvoie l'ensemble des donnees d'un user a partir de login
        $statement = $db->prepare('SELECT passwd, cle, profile, status FROM User WHERE login ="'.$this->login.'"');
        $statement->execute();
        $result = $statement->fetchAll();
        if (count($result) === 0)
            return false;
        $value = $result[0];
        $this->passwd = $value['passwd'];
        $this->cle = $value['cle'];
        $this->profile = $value['profile'];
        $this->status = $value['status'];        
        return true;
    }

    public function getUserByMail($db)
    {
        // cette methode renvoie l'ensemble des donnees d'un user a partir du mail
        $statement = $db->prepare('SELECT login, passwd, cle, profile, status FROM User WHERE mail = "'.$this->mail.'"');
        $statement->execute();
        $result = $statement->fetchAll();
        if (count($result) === 0)
            return false;
        $value = $result[0];
        $this->login = $value['login'];
        $this->passwd = $value['passwd'];
        $this->cle = $value['cle'];
        $this->profile = $value['profile'];
        $this->status = $value['status'];        
        return true;
    }

    public function setDb($db)
    {
        // cette methode modifie en base les donnees passwd et status d'un user a partir de login+passwd
        $sql = 'UPDATE User SET PASSWD=:passwd, STATUS=:status WHERE login ="'.$this->login.'" AND passwd = "'.$this->passwd.'"';
        $statement = $db->prepare($sql);
        $statement->bindParam(':passwd', $this->passwd);
        $statement->bindParam(':status', $this->status);        
        return ($statement->execute());
    }
    public function setPasswdByLogin($db)
    {
        // cette methode modifie en base les donnees passwd d'un user a partir de login
        $sql = 'UPDATE User SET PASSWD=:passwd WHERE login ="'.$this->login.'"';
        $statement = $db->prepare($sql);
        $statement->bindParam(':passwd', $this->passwd);
        return ($statement->execute());
    }

    public function deleteUser($db)
    {
        $sql = 'DELETE FROM User where login="'.$this->login.'"';
        $statement = $db->prepare($sql);
        return ($statement->execute());
    }

    public function findByImage($db, $image_id)
    {
        // renvoie true si trouve et met a jour les attributs mail et login
        // cette methode renvoie l'ensemble des donnees d'un user a partir du parametre image_id 
        $statement = $db->prepare('SELECT login, mail FROM user u INNER JOIN image i ON i.user_id=u.login WHERE i.id='.$image_id);
        $statement->execute();
        $result = $statement->fetchAll();
        if (count($result) === 0)
            return false;
        $value = $result[0];
        $this->mail = $value['mail'];
        $this->login = $value['login']; 
        return true;
    }
}
