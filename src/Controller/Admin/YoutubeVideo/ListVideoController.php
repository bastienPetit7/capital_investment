<?php

namespace App\Controller\Admin\YoutubeVideo;

use App\Repository\VideoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ListVideoController extends AbstractController
{
    /**
     * @Route("admin/youtubevideo/list", name="admin_youtube_video_list")
     * @param VideoRepository $videoRepository
     * @return Response
     */
    public function list(VideoRepository $videoRepository): Response
    {
        $videos = $videoRepository->findAll();

        return $this->render("admin/youtube_video/list.html.twig",[
            'videos' => $videos
        ]);
    }
}