<?php

namespace App\Controller;

use Doctrine\DBAL\Connection;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class MasterController extends AbstractController
{
    /**
     * @var Master
     */
    private $master;
    private SessionInterface $session;
    private SpaceToDashes $space;
    private Capitalize $capital;

    /**
     * MasterController constructor.
     * @param Master $master
     */
    public function __construct(Master $master, SessionInterface $session, SpaceToDashes $space, Capitalize  $capital)
    {
        $this->master = $master;
        $this->session = $session;
        $this->space = $space;
        $this->capital = $capital;
    }


    /**
     * @Route("/master", name="master")
     */
    public function index(): Response
    {
        return $this->render('master/index.html.twig', [
            'controller_name' => 'MasterController',
        ]);
    }

    /**
     * @Route("/", name="master")
     */
    public function input(): response
    {
        $message = $this->session->get('message', 'Unknown');
        $form = $this->createFormBuilder(null, [
            'action' => '/change',
            'method' => 'POST',
        ])
            ->add('message', TextType::class)
            ->getForm();
        $this->master->logString($message);

        $message = $this->capital->transform($message);
        $message = $this->space->transform($message);

        return $this->render('master/master.html.twig', [
            'form' => $form->createView(),
            'message' => $message,
        ]);
    }

    /**
     * @Route("/change", name="change", methods={"POST"})
     */
    public function changeMessage()
    {
        $this->session->set('message', $_POST['form']['message']);
        return $this->redirectToRoute('master');
    }
}
