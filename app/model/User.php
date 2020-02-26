<?php


class User
{
    private $id;
    private $userFirstName;
    private $userLastName;
    private $userEmail;
    private $userCellNumber;
    private $userPosition;
    private $username;
    private $password;
    private $status;
    private $userPic;

    /**
     * User constructor.
     * @param $userFirstName
     * @param $userLastName
     * @param $userEmail
     * @param $userCellNumber
     * @param $userPosition
     * @param $username
     * @param $password
     * @param $status
     * @param $userPic
     */
    public function __construct($userFirstName, $userLastName, $userEmail, $userCellNumber, $userPosition, $username, $password, $status, $userPic, $id = null)
    {
        $this->userFirstName = $userFirstName;
        $this->userLastName = $userLastName;
        $this->userEmail = $userEmail;
        $this->userCellNumber = $userCellNumber;
        $this->userPosition = $userPosition;
        $this->username = $username;
        $this->password = $password;
        $this->status = $status;
        $this->userPic = $userPic;
        if($id!=null){
            $this->id = $id;
        }
    }

    /**
     * @return null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param null $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getUserFirstName()
    {
        return $this->userFirstName;
    }

    /**
     * @param mixed $userFirstName
     */
    public function setUserFirstName($userFirstName)
    {
        $this->userFirstName = $userFirstName;
    }

    /**
     * @return mixed
     */
    public function getUserLastName()
    {
        return $this->userLastName;
    }

    /**
     * @param mixed $userLastName
     */
    public function setUserLastName($userLastName)
    {
        $this->userLastName = $userLastName;
    }

    /**
     * @return mixed
     */
    public function getUserEmail()
    {
        return $this->userEmail;
    }

    /**
     * @param mixed $userEmail
     */
    public function setUserEmail($userEmail)
    {
        $this->userEmail = $userEmail;
    }

    /**
     * @return mixed
     */
    public function getUserCellNumber()
    {
        return $this->userCellNumber;
    }

    /**
     * @param mixed $userCellNumber
     */
    public function setUserCellNumber($userCellNumber)
    {
        $this->userCellNumber = $userCellNumber;
    }

    /**
     * @return mixed
     */
    public function getUserPosition()
    {
        return $this->userPosition;
    }

    /**
     * @param mixed $userPosition
     */
    public function setUserPosition($userPosition)
    {
        $this->userPosition = $userPosition;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return mixed
     */
    public function getUserPic()
    {
        return $this->userPic;
    }

    /**
     * @param mixed $userPic
     */
    public function setUserPic($userPic)
    {
        $this->userPic = $userPic;
    }
}