<?php
/**
 * Created by PhpStorm.
 * User: Dawid Pierzak
 * Date: 07.01.2019
 * Time: 19:34
 */

namespace App\Service;


use Symfony\Component\HttpFoundation\File\UploadedFile;

class RecruitService extends AbstractService
{
    public function saveForm(){

    }
    public function saveImage(UploadedFile $image)
    {

        $fileName = $this->generateUniqueFileName() . '.' . $image->guessExtension();
        $fileDirectory = $this->container->getParameter('images_directory');

        if (!in_array($image->guessExtension(), ['jpg', 'jpeg', 'png', 'gif'])) {
            throw new \Exception('Nieprawidłowy format pliku');
        }
        $image->move(
            $fileDirectory,
            $fileName
        );

        return $fileDirectory.'/'.$fileName;
    }

}