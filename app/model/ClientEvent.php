<?php


class ClientEvent
{
    private $messageID;
    private $clientID;
    private $notificationID;
    private $startDate;
    private $frequency;
    private $status;

    /**
     * ClientEvent constructor.
     * @param $messageID
     * @param $clientID
     * @param $notificationID
     * @param $startDate
     * @param $frequency
     * @param $status
     */
    public function __construct($clientID, $notificationID, $startDate, $frequency, $status, $messageID = null)
    {
        $this->clientID = $clientID;
        $this->notificationID = $notificationID;
        $this->startDate = $startDate;
        $this->frequency = $frequency;
        $this->status = $status;
        if($messageID!=null){
            $this->messageID= $messageID;
        }
    }

    /**
     * @return mixed
     */
    public function getMessageID()
    {
        return $this->messageID;
    }

    /**
     * @param mixed $messageID
     */
    public function setMessageID($messageID)
    {
        $this->messageID = $messageID;
    }

    /**
     * @return mixed
     */
    public function getClientID()
    {
        return $this->clientID;
    }

    /**
     * @param mixed $clientID
     */
    public function setClientID($clientID)
    {
        $this->clientID = $clientID;
    }

    /**
     * @return mixed
     */
    public function getNotificationID()
    {
        return $this->notificationID;
    }

    /**
     * @param mixed $notificationID
     */
    public function setNotificationID($notificationID)
    {
        $this->notificationID = $notificationID;
    }

    /**
     * @return mixed
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * @param mixed $startDate
     */
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;
    }

    /**
     * @return mixed
     */
    public function getFrequency()
    {
        return $this->frequency;
    }

    /**
     * @param mixed $frequency
     */
    public function setFrequency($frequency)
    {
        $this->frequency = $frequency;
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




}