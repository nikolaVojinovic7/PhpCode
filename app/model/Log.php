<?php


class Log
{
    private $id;
    private $username;
    private $moduleName;
    private $actionDone;
    private $dateTime;
    private $ipAddress;

    /**
     * Log constructor.
     * @param $username
     * @param $moduleName
     * @param $actionDone
     * @param $dateTime
     * @param $ipAddress
     * @param null $id
     */
    public function __construct($username, $moduleName, $actionDone, $dateTime, $ipAddress, $id = null)
    {
        $this->username = $username;
        $this->moduleName = $moduleName;
        $this->actionDone = $actionDone;
        $this->dateTime = $dateTime;
        $this->ipAddress = $ipAddress;
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
    public function getModuleName()
    {
        return $this->moduleName;
    }

    /**
     * @param mixed $moduleName
     */
    public function setModuleName($moduleName)
    {
        $this->moduleName = $moduleName;
    }

    /**
     * @return mixed
     */
    public function getActionDone()
    {
        return $this->actionDone;
    }

    /**
     * @param mixed $actionDone
     */
    public function setActionDone($actionDone)
    {
        $this->actionDone = $actionDone;
    }

    /**
     * @return mixed
     */
    public function getDateTime()
    {
        return $this->dateTime;
    }

    /**
     * @param mixed $dateTime
     */
    public function setDateTime($dateTime)
    {
        $this->dateTime = $dateTime;
    }

    /**
     * @return mixed
     */
    public function getIpAddress()
    {
        return $this->ipAddress;
    }

    /**
     * @param mixed $ipAddress
     */
    public function setIpAddress($ipAddress)
    {
        $this->ipAddress = $ipAddress;
    }


}