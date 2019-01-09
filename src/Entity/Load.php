<?php
/**
 * Created by PhpStorm.
 * User: Dawid Pierzak
 * Date: 09.01.2019
 * Time: 00:34
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * @ORM\Table(name="hw_loads")
 * @ORM\Entity()
 */
class Load
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity="User", inversedBy="id")
     * @ORM\JoinTable(
     *  name="hw_userLoad",
     *  joinColumns={
     *      @ORM\JoinColumn(name="load_id", referencedColumnName="id")
     *  },
     *  inverseJoinColumns={
     *      @ORM\JoinColumn(name="user_id", referencedColumnName="username")
     *  }
     * )
     */
    private $user;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $title;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime")
     */
    private $addDate;


    /**
     * @var integer
     * @ORM\Column(type="integer",options={"default" : 1})
     */
    private $available;

    /**
     * @var boolean
     * @ORM\Column(type="boolean",options={"default" : false})
     */
    private $ended;

    /**
     * Load constructor.
     */
    public function __construct()
    {
        $this->addDate = new \DateTime();
        $this->ended = false;
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
     * @return int
     */
    public function getAvailable(): int
    {
        return $this->available;
    }

    /**
     * @param int $available
     */
    public function setAvailable(int $available): void
    {
        $this->available = $available;
    }



    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
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
     * @return bool
     */
    public function isEnded(): bool
    {
        return $this->ended;
    }

    /**
     * @param bool $ended
     */
    public function setEnded(bool $ended): void
    {
        $this->ended = $ended;
    }




}