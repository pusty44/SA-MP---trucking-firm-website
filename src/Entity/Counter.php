<?php
/**
 * Created by PhpStorm.
 * User: Dawid Pierzak
 * Date: 07.01.2019
 * Time: 17:09
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Table(name="hw_counter")
 * @ORM\Entity()
 */
class Counter
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var integer
     * @ORM\Column(type="integer")
     */
    private $km;

    /**
     * @var integer
     * @ORM\Column(type="integer")
     */
    private $loads;

    /**
     * @var integer
     * @ORM\Column(type="integer")
     */
    private $fuel;

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
     * @return int
     */
    public function getKm(): int
    {
        return $this->km;
    }

    /**
     * @param int $km
     */
    public function setKm(int $km): void
    {
        $this->km = $km;
    }

    /**
     * @return int
     */
    public function getLoads(): int
    {
        return $this->loads;
    }

    /**
     * @param int $loads
     */
    public function setLoads(int $loads): void
    {
        $this->loads = $loads;
    }

    /**
     * @return int
     */
    public function getFuel(): int
    {
        return $this->fuel;
    }

    /**
     * @param int $fuel
     */
    public function setFuel(int $fuel): void
    {
        $this->fuel = $fuel;
    }



}