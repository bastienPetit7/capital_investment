<?php

namespace App\Controller\Admin\YoutubeVideo;

use App\Entity\User;
use App\Entity\Video;
use App\Form\VideoType;
use App\Repository\VideoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class EditVideoController extends AbstractController
{
    /**
     * @Route("admin/youtubevideo/edit/{id}", name="admin_youtube_video_edit")
     */
    public function create(int $id,VideoRepository $videoRepository,EntityManagerInterface $em, Request $request)
    {
        $video = $videoRepository->find($id);

        if(!$video)
        {
            $this->addFlash("danger","This video cannot be found");
            return $this->redirectToRoute("admin_youtube_video_list");
        }

        $form = $this->createForm(VideoType::class,$video);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            /** @var User $user */
            $user = $this->getUser();

            $video->setUser($user);

            $em->flush();

            $this->addFlash("light","The video " . $video->getName() . " has been edited successfully.");

            return $this->redirectToRoute("admin_youtube_video_show",['id'=> $id]);
        }

        return $this->render("admin/youtube_video/edit.html.twig",[
            'form' => $form->createView()
        ]);
    }
}