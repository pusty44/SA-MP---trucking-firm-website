<?php
/**
 * Created by PhpStorm.
 * User: Dawid Pierzak
 * Date: 07.01.2019
 * Time: 16:08
 */

namespace App\Controller;


use App\Entity\Recruit;
use App\Entity\User;
use App\Form\RecruitType;
use App\Service\RecruitService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class recrutationController extends AbstractController
{
    /**
     * Root template
     *
     * @Route("/recruit", name="recruit")
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Exception
     */

    public function recruit(Request $request, RecruitService $recruitService)
    {
        $error = false;
        $recruit = new Recruit();
        $form = $this->createForm(RecruitType::class, $recruit);
        $form->handleRequest($request);
        foreach ($form->getErrors(true) as $error) {
            echo $error->getMessage();
        }
        if ($form->isSubmitted() && $form->isValid()) {
            try {
                /** @var UploadedFile $avatar */
                $avatar = $recruit->getAvatar();
                /** @var UploadedFile $cover */
                $cover = $recruit->getCoverPhoto();
                $fileName = md5(uniqid());
                $av_ext = $avatar->guessExtension();
                $cov_ext = $cover->guessExtension();
                $avatar->move(
                    $this->getParameter('images_directory'),
                    $fileName.'.'.$avatar->guessExtension()
                );
                $cover->move(
                    $this->getParameter('images_directory'),
                    'cover_'.$fileName.'.'.$cover->guessExtension()
                );
            }catch(FileException $e){
                echo $e->getMessage();
            }
            $recruit->setAvatar('/upload/'.$fileName.'.'.$av_ext);
            $recruit->setCoverPhoto('/upload/cover_'.$fileName.'.'.$cov_ext);
            $em = $this->getDoctrine()->getManager();
            $em->persist($recruit);
            $em->flush();
            $error = true;

        }
        return $this->render('recruit.html.twig', array(
            'title' => 'Rekrutacja',
            'form' => $form->createView(),
            'error' => $error
        ));
    }

    /**
     * Root template
     *
     * @Route("/cron/recruits", name="cron_recruits")
     * @throws \Exception
     */
    public function cron(){
        $recruts = $this->getDoctrine()->getRepository(Recruit::class)->findBy(['status' => 2]);
        /** @var Recruit $recrut */
        foreach ($recruts as $recrut){
            $mail = new PHPMailer(true);
            try {
                //Server settings
                $mail->SMTPDebug = 0;
                $mail->CharSet = 'UTF-8';
                $mail->Encoding = 'base64';
                $mail->isSMTP();
                $mail->Host = 'smtp.dpoczta.pl';
                $mail->SMTPAuth = true;
                $mail->Username = 'noreply@helpcode.net';
                $mail->Password = '4Cm1LRb15wzS';
                $mail->SMTPSecure = 'tls';
                $mail->Port = 587;

                $mail->setFrom('noreply@helpcode.net', 'Support TSNO');

                $mail->addAddress($recrut->getEmail());

                $mail->addReplyTo('help@helpcode.net', 'Support TSNO');
                $mail->isHTML(true);
                $mail->Subject = 'Rekrutacja na kierowcę TSNO';
                $message = '
                Twoje zgłoszenie rekrutacyjne na kierowcę TSNO zostało rozpatrzone pozytywnie!<br />
                Dokończ rekrutację rejestrując konto klikając w poniższy link:
                <a href="https://tsno.helpcode.net/register/'.$recrut->getActivationHash().'">https://tsno.helpcode.net/register/'.$recrut->getActivationHash().'</a>
                <hr />
                Pozdrawiamy,
                Ekipa Transport Się Nie Opłaca
';
                $mail->Body    = $message;
                $mail->AltBody = $message;

                if($mail->send()) {
                    $recrut->setStatus(3);
                    $em = $this->getDoctrine()->getManager();
                    $em->persist($recrut);
                    $em->flush();
                    $user = new User();
                    $user->setEmail($recrut->getEmail());
                    $user->setUsername($recrut->getServerNick());
                    $user->setPassword('tsno');
                    $user->setActivationHash($recrut->getActivationHash());
                    $em->persist($user);
                    $em->flush();
                    $error = 'ok';
                }
            } catch (Exception $e) {
                $error = 'Błąd podczas wysyłania wiadomości e-mail: '. $mail->ErrorInfo;
            }

        }
        return new JsonResponse(array('error' => $error));
    }
}