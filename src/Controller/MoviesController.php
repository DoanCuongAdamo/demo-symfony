<?php

namespace App\Controller;

use App\Repository\MoviesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MoviesController extends AbstractController
{
    // #[Route('/movies/{name}', name: 'app_movies', defaults:['name' => null], methods:['GET', 'HEAD'])]
    // public function index($name): Response
    // {
        // return $this->render('movies/index.html.twig', [
        //     'controller_name' => 'MoviesController',
        //     'name' => $name,
        // ]);
        // return $this->json([
        //     'controller_name' => 'MoviesController',
        //     'name' => $name,
        // ]);
    //     return $this->render('index.html.twig', ['title' => 'movies']);
    //     $movies = ['Avengers' => 'endants', 'season' => '2', 'year' => 2011];
    //     return $this->render('index.html.twig', array('movies' => $movies));
    //     dump($movies);
    // }
    

    /**
     * @Route("/old", name="old")
     */
    public function oldMethod(): Response
    {
        return $this->json(['name'=> 'babe', 'age'=> 21]);
    }

    #[Route('/movies/{name}', name: 'app_movies', defaults:['name' => null], methods:['GET', 'HEAD'])]
    public function index(MoviesRepository $moviesRepository): Response
    {
        $movies = $moviesRepository->findAll();
        return $this->render('index.html.twig');
    }
}
