<?php

namespace App\Controller;

use App\Entity\SimNumber;
use App\Form\SimNumberType;
use App\Repository\SimNumberRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/sim/number')]
class SimNumberController extends AbstractController
{
    #[Route('/', name: 'app_sim_number_index', methods: ['GET'])]
    public function index(SimNumberRepository $simNumberRepository): Response
    {
        return $this->render('sim_number/index.html.twig', [
            'sim_numbers' => $simNumberRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_sim_number_new', methods: ['GET', 'POST'])]
    public function new(Request $request, SimNumberRepository $simNumberRepository): Response
    {
        $simNumber = new SimNumber();
        $form = $this->createForm(SimNumberType::class, $simNumber);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $simNumberRepository->save($simNumber, true);

            return $this->redirectToRoute('app_sim_number_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('sim_number/new.html.twig', [
            'sim_number' => $simNumber,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_sim_number_show', methods: ['GET'])]
    public function show(SimNumber $simNumber): Response
    {
        return $this->render('sim_number/show.html.twig', [
            'sim_number' => $simNumber,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_sim_number_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, SimNumber $simNumber, SimNumberRepository $simNumberRepository): Response
    {
        $form = $this->createForm(SimNumberType::class, $simNumber);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $simNumberRepository->save($simNumber, true);

            return $this->redirectToRoute('app_sim_number_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('sim_number/edit.html.twig', [
            'sim_number' => $simNumber,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_sim_number_delete', methods: ['POST'])]
    public function delete(Request $request, SimNumber $simNumber, SimNumberRepository $simNumberRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$simNumber->getId(), $request->request->get('_token'))) {
            $simNumberRepository->remove($simNumber, true);
        }

        return $this->redirectToRoute('app_sim_number_index', [], Response::HTTP_SEE_OTHER);
    }
}
