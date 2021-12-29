<?php

namespace App\Controller\Admin\YoutubeVideo;

use App\Repository\VideoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ShowVideoController extends AbstractController
{
    /**
     * @Route("admin/youtubevideo/show/{id}", name="admin_youtube_video_show")
     */
    public function show(int $id,VideoRepository $videoRepository)
    {
        $video = $videoRepository->find($id);

        if(!$video)
        {
            $this->addFlash("danger","This study case is not found.");
            return $this->redirectToRoute("admin_youtube_video_list");
        }

        return $this->render("admin/youtube_video/show.html.twig",[
            'video' => $video
        ]);
    }
}