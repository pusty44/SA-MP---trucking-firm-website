<?php
/**
 * Created by PhpStorm.
 * User: Dawid Pierzak
 * Date: 07.01.2019
 * Time: 19:22
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * @ORM\Table(name="hw_recruit")
 * @ORM\Entity()
 */
class Recruit
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $serverNick;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $email;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $forumNick;


    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $profileLink;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $practice;

    /**
     * @var string
     * @ORM\Column(type="string")
     */
    private $age;

    /**
     * @ORM\Column(type="string")
     */
    private $avatar;

    /**
     * @ORM\Column(type="string")
     */
    private $coverPhoto;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=true, options={"default" : null})
     */
    private $activationHash;

    /**
     * @var string
     * @ORM\Column(type="integer", options={"default" : 0})
     */
    private $status;

    /**
     * Recruit constructor.
     */
    public function __construct()
    {
        $this->status = 0;
        $this->activationHash = md5(uniqid());
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
     * @return string|null
     */
    public function getServerNick(): ?string
    {
        return $this->serverNick;
    }

    /**
     * @param string $serverNick
     */
    public function setServerNick(string $serverNick): void
    {
        $this->serverNick = $serverNick;
    }

    /**
     * @return string|null
     */
    public function getForumNick(): ?string
    {
        return $this->forumNick;
    }

    /**
     * @param string $forumNick
     */
    public function setForumNick(string $forumNick): void
    {
        $this->forumNick = $forumNick;
    }


    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }


    /**
     * @return string|null
     */
    public function getProfileLink(): ?string
    {
        return $this->profileLink;
    }

    /**
     * @param string $profileLink
     */
    public function setProfileLink(string $profileLink): void
    {
        $this->profileLink = $profileLink;
    }

    /**
     * @return string|null
     */
    public function getPractice(): ?string
    {
        return $this->practice;
    }

    /**
     * @param string $practice
     */
    public function setPractice(string $practice): void
    {
        $this->practice = $practice;
    }

    /**
     * @return string|null
     */
    public function getAge(): ?string
    {
        return $this->age;
    }

    /**
     * @param string $age
     */
    public function setAge(string $age): void
    {
        $this->age = $age;
    }

    public function getAvatar()
    {
        return $this->avatar;
    }

    public function setAvatar($avatar)
    {
        $this->avatar = $avatar;
        return $this;
    }


    public function getCoverPhoto()
    {
        return $this->coverPhoto;
    }

    public function setCoverPhoto($coverPhoto)
    {
        $this->coverPhoto = $coverPhoto;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getActivationHash(): ?string
    {
        return $this->activationHash;
    }

    /**
     * @param string $activationHash
     */
    public function setActivationHash(string $activationHash): void
    {
        $this->activationHash = $activationHash;
    }



    /**
     * @return string|null
     */
    public function getStatus(): ?string
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus(string $status): void
    {
        $this->status = $status;
    }


}