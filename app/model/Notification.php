<?php


class Notification
{
    /**
     * Notification constructor.
     * @param $id
     * @param $name
     * @param $type
     * @param $status
     */
    public function __construct($name, $type, $status, $id = null)
    {
        if($id!=null){
            $this->id = $id;
        }
        $this->name = $name;
        $this->type = $type;
        $this->status = $status;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
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
    private $id;
    private $name;
    private $type;
    private $status;
}