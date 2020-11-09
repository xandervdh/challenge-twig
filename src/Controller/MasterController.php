<?php

namespace App\Controller;

use App\services\Master;
use Doctrine\DBAL\Connection;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;


class MasterController extends AbstractController
{
    private Master $master;
    private SessionInterface $session;
    /*private SpaceToDashes $space;
    private Capitalize $capital;*/

    /**
     * MasterController constructor.
     * @param Master $master
     */
    public function __construct(Logger $logger, SessionInterface $session)
    {
        if ($_POST['form']['transformation'] == 'capital'){
            $transform = new Capitalize();
        } else {
            $transform = new SpaceToDashes();
        }
        $this->master = new Master($logger, $transform);
        $this->session = $session;
        /*$this->space = $space;
        $this->capital = $capital;*/
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
        $message = $this->master->logString($message);

        //$message = $this->space->transform($message);*/

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
        if ($_POST['form']['transformation'] == 'capital'){
            $transform = new Capitalize();
        } else {
            $transform = new SpaceToDashes();
        }
        $this->session->set('message', $_POST['form']['message']);
        return $this->redirectToRoute('master');
    }
}
