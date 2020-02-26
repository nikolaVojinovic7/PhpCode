<?php


class Client
{
    private $id;
    private $companyName;
    private $businessNumber;
    private $firstName;
    private $lastName;
    private $phoneNumber;
    private $cellNumber;
    private $website;
    private $status;

    public function __construct($companyName, $businessNumber, $firstName, $lastName, $phoneNumber, $cellNumber, $website, $status,  $id=null)
    {
        $this->companyName = $companyName;
        $this->businessNumber = $businessNumber;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->phoneNumber = $phoneNumber;
        $this->cellNumber= $cellNumber;
        $this->website = $website;
        $this->status = $status;
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
    public function getCompanyName()
    {
        return $this->companyName;
    }

    /**
     * @param mixed $companyName
     */
    public function setCompanyName($companyName)
    {
        $this->companyName = $companyName;
    }

    /**
     * @return mixed
     */
    public function getBusinessNumber()
    {
        return $this->businessNumber;
    }

    /**
     * @param mixed $businessNumber
     */
    public function setBusinessNumber($businessNumber)
    {
        $this->businessNumber = $businessNumber;
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param mixed $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param mixed $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * @return mixed
     */
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    /**
     * @param mixed $phoneNumber
     */
    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;
    }

    /**
     * @return mixed
     */
    public function getCellNumber()
    {
        return $this->cellNumber;
    }

    /**
     * @param mixed $cellNumber
     */
    public function setCellNumber($cellNumber)
    {
        $this->cellNumber = $cellNumber;
    }

    /**
     * @return mixed
     */
    public function getWebsite()
    {
        return $this->website;
    }

    /**
     * @param mixed $website
     */
    public function setWebsite($website)
    {
        $this->website = $website;
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