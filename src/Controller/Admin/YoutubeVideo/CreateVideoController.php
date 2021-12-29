<?php

namespace App\Controller\Admin\YoutubeVideo;

use App\Entity\User;
use App\Entity\Video;
use App\Form\VideoType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CreateVideoController extends AbstractController
{
    /**
     * @Route("admin/youtubevideo/create", name="admin_youtube_video_create")
     */
    public function create(EntityManagerInterface $em, Request $request)
    {
        $video = new Video();

        $form = $this->createForm(VideoType::class,$video);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            /** @var User $user */
            $user = $this->getUser();

            $video->setUser($user);

            $em->persist($video);

            $em->flush();

            $this->addFlash("light","The video " . $video->getName() . " has been added successfully.");

            return $this->redirectToRoute("admin_youtube_video_list");
        }

        return $this->render("admin/youtube_video/create.html.twig",[
            'form' => $form->createView()
        ]);
    }
}