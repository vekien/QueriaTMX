<?php

namespace App\Controller;

use App\Entity\Text;
use App\Repository\TextRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /** @var EntityManagerInterface $emi */
    private $emi;
    
    public function __construct(EntityManagerInterface $emi)
    {
        $this->emi = $emi;
    }
    
    /**
     * @Route("/")
     */
    public function home(Request $request)
    {
        $query = trim($request->get('search'));
        $maxResults = filter_var($request->get('max_results', 100), FILTER_VALIDATE_INT);
        $option = filter_var($request->get('option', 1), FILTER_VALIDATE_INT);

        if ($query) {
            /** @var TextRepository $repo */
            $repo = $this->emi->getRepository(Text::class);
            $translations = $repo->search($query, $maxResults, $option);
        }
        
        return $this->render('home.html.twig', [
            'translations' => $translations ?? [],
        ]);
    }
}
