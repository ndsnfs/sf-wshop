<?php
namespace App\Controller;

use App\Entity\Domain\Media\Image;
use App\Entity\FeedbackDTO;
use App\Form\AdminImageAdderType;
use App\Form\ImageListType;
use App\Form\ImageType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class FeedbackController extends AbstractController
{
    /**
     * @Route("/feedback", name="feedback",methods={"GET","POST"})
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function form(Request $request)
    {
        $feedbackDTO = new FeedbackDTO();
        $img = new Image();
        $img->setPath('https://www.google.com/images/branding/googlelogo/2x/googlelogo_color_92x30dp.png');
        $img1 = new Image();
        $img1->setPath('https://www.google.com/images/branding/googlelogo/2x/googlelogo_color_92x30dp.png');
        $feedbackDTO->addImage($img);
        $feedbackDTO->addImage($img1);
        $feedbackDTO->setEmail('n_ds@mail.ru');
        $form = $this->createFormBuilder($feedbackDTO)
            ->add('email', EmailType::class, ['label' => 'Email'])
            ->add('images', ImageListType::class, [
                'entry_type' => ImageType::class,
                'entry_options' => ['label' => false],
                'allow_add' => true,
                'allow_delete' => true,
            ])
            ->add('save', SubmitType::class, ['label' => 'Send'])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            echo 111;
            die;
        }

        return $this->render('form/feedback.html.twig', [
            'form' => $form->createView(),
            'res' => 1,
        ]);
    }
}