<?php


namespace App\Controller\LandingEbook;

use App\Entity\ThemeStudyCase;
use App\Repository\ThemeStudyCaseRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class CategoryEbookController extends AbstractController
{


    /**
     * @Route("landing/ebook/categorie/{id}", name="landing_ebook_category_show")
     *
     * @param ThemeStudyCaseRepository $themeStudyCaseRepository
     * @return void
     */
    public function show(ThemeStudyCase $themeEbook): Response
    {

        $ebooks = $themeEbook->getStudyCases()->getValues(); 


        return $this->render('landing_ebook/show_by_categories.html.twig', [
            "ebooks" => $ebooks
        ]);
    
    }


}