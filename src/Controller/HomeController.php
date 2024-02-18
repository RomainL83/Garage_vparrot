<?php

namespace App\Controller;

use App\Entity\Car;
use App\Entity\Company;
use App\Entity\Message;
use App\Entity\User;
use App\Form\MessageType;
use App\Service\CarUtils;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_homepage')]
    public function maPremierePage(Request $request, EntityManagerInterface $entityManager, CarUtils $carUtils): Response
    {
        /** @var Company $company */
        $company = $entityManager->getRepository(Company::class)->findOneBy(['email' => 'contact@vparrot.com']);

        $message = new Message();
        $message->setCompany($company);
        $form = $this->createForm(MessageType::class, $message);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($message);
            $entityManager->flush();
            return $this->redirectToRoute('app_homepage');
        }

        // On filtre les filtres vides dans le HTTP Query
        $filterQuery = $request->query->all() ? array_filter($request->query->all()['filter']) : null;
        if ($filterQuery) {
            $cars = $carUtils->filter($filterQuery);
        } else {
            $cars = $entityManager->getRepository(Car::class)->findAll();
        }

        return $this->render('homepage/index.html.twig', [
            'messageForm' => $form->createView(),
            'cars' => $cars,
        ]);
    }
}