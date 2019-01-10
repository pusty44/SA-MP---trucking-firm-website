<?php
/**
 * Created by PhpStorm.
 * User: Dawid Pierzak
 * Date: 08.01.2019
 * Time: 20:39
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Table(name="hw_tachograph")
 * @ORM\Entity(repositoryClass="App\Repository\TachoRepository")
 */
class Tachograph
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="user", referencedColumnName="username", nullable=false)
     */
    private $user;

    /**
     * @var string
     * @ORM\Column(type="datetime")
     */
    private $addDate;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $startKm;

    /**
     * @var int
     * @ORM\Column(type="integer")
     */
    private $endKm;

    /**
     * @var bool
     * @ORM\Column(type="boolean", options={"default" : false})
     */
    private $fuel;

    /**
     * @var string
     * @ORM\Column(type="text", nullable=true, options={"default" : null})
     */
    private $damage;

    /**
     * @ORM\ManyToOne(targetEntity="Load")
     * @ORM\JoinColumn(name="loadId", referencedColumnName="id", nullable=true)
     */
    private $loadId;

    /**
     * Tachograph constructor.
     */
    public function __construct()
    {
        $this->addDate = new \DateTime();
        $this->startKm = 0;
        $this->endKm = 0;
        $this->fuel = false;
        $this->loadId = null;
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
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user): void
    {
        $this->user = $user;
    }

    /**
     * @return \DateTime
     */
    public function getAddDate(): \DateTime
    {
        return $this->addDate;
    }

    /**
     * @param string $addDate
     */
    public function setAddDate(string $addDate): void
    {
        $this->addDate = $addDate;
    }

    /**
     * @return int
     */
    public function getStartKm(): int
    {
        return $this->startKm;
    }

    /**
     * @param int $startKm
     */
    public function setStartKm(int $startKm): void
    {
        $this->startKm = $startKm;
    }

    /**
     * @return int
     */
    public function getEndKm(): int
    {
        return $this->endKm;
    }

    /**
     * @param int $endKm
     */
    public function setEndKm(int $endKm): void
    {
        $this->endKm = $endKm;
    }

    /**
     * @return string|null
     */
    public function getDamage(): ?string
    {
        return $this->damage;
    }

    /**
     * @param string $damage
     */
    public function setDamage(string $damage): void
    {
        $this->damage = $damage;
    }

    /**
     * @return bool
     */
    public function isFuel(): bool
    {
        return $this->fuel;
    }

    /**
     * @param bool $fuel
     */
    public function setFuel(bool $fuel): void
    {
        $this->fuel = $fuel;
    }

    /**
     * @return mixed
     */
    public function getLoad()
    {
        return $this->loadId;
    }

    /**
     * @param mixed $load
     */
    public function setLoad($load): void
    {
        $this->loadId = $load;
    }



}