<?php

namespace App\Service;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class AbstractService
{
    /**
     * @var EntityManagerInterface
     */
    protected $entityManager;
    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * AbstractService constructor.
     * @param EntityManagerInterface $entityManager
     * @param ContainerInterface $container
     */
    public function __construct(
        EntityManagerInterface $entityManager,
        ContainerInterface $container
    ) {
        $this->entityManager = $entityManager;
        $this->container = $container;
    }

    /**
     * @return string
     */
    protected function generateUniqueFileName(): string
    {
        return md5(uniqid());
    }

    /**
     * @param string $className
     * @return int
     */
    public function deleteAll(string $className): int
    {
        return $this->entityManager->getRepository($className)->deleteAll();
    }

    function generateSeoUrl(string $string, string $separator = "-")
    {
        $accents_regex = '~&([a-z]{1,2})(?:acute|cedil|circ|grave|lig|orn|ring|slash|th|tilde|uml);~i';
        $special_cases = array('&' => 'and', "'" => '');
        $string = mb_strtolower(trim($string), 'UTF-8');
        $string = str_replace(array_keys($special_cases), array_values($special_cases), $string);
        $string = preg_replace($accents_regex, '$1', htmlentities($string, ENT_QUOTES, 'UTF-8'));
        $string = preg_replace("/[^a-z0-9]/u", "$separator", $string);
        $string = preg_replace("/[$separator]+/u", "$separator", $string);
        return $string;
    }

    /**
     * @param string $domainUrl
     * @param $data
     */
    public function sendDataToDomain(string $domainUrl, $data): void
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $domainUrl);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_exec($ch);
        curl_close($ch);
    }

    protected function getFileName(string $imageUrl)
    {
        $imageUrlAsCollection = new ArrayCollection(explode('/', $imageUrl));
        return $imageUrlAsCollection->last();
    }
}