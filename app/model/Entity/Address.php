<?php

namespace App\Model\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="address")
 * @property string $firstname
 * @property string $surname
 * @property string $company
 * @property string $mail
 * @property string $phone
 * @property string $street
 * @property string $city
 * @property string $zipcode
 * @property string $country
 */
class Address extends Entity
{

    /**
     * @ORM\Column(type="string", length=128)
     */
    protected $firstname;

    /**
     * @ORM\Column(type="string", length=128)
     */
    protected $surname;

    /**
     * @ORM\Column(type="string", length=128)
     */
    protected $company;

    /**
     * @ORM\Column(type="string")
     */
    protected $mail;

    /**
     * @ORM\Column(type="string", length=20)
     */
    protected $phone;

    /**
     * @ORM\Column(type="string", length=200)
     */
    protected $street;

    /**
     * @ORM\Column(type="string", length=200)
     */
    protected $city;

    /**
     * @ORM\Column(type="string", length=200)
     */
    protected $country;

    /**
     * @ORM\Column(type="string", length=20)
     */
    protected $zipcode;

    // <editor-fold defaultstate="collapsed" desc="setters">
    // </editor-fold>
    // <editor-fold defaultstate="collapsed" desc="getters">
    // </editor-fold>
    
    /**
     * Render Entity
     * @return string
     */
    public function render()
    {
        return $this->getFirstname() . " " . $this->getSurname();
    }

}
