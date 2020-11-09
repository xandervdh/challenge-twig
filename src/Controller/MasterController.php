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

    /**
     * MasterController constructor.
     * @param Master $master
     */
    public function __construct(Logger $logger, SessionInterface $session, Capitalize $transform)
    {
        if (!isset($this->master)){
            $this->master = new Master($logger, $transform);
        }
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
    public function input(Logger $logger): response
    {
        $message = $this->session->get('message', 'Unknown');
        $transformation = $this->session->get('transformation');
        if ($transformation == 'capital'){
            $transform = new Capitalize();
        } else {
            $transform = new SpaceToDashes();
        }
        $this->master = new Master($logger, $transform);
        $form = $this->createFormBuilder(null, [
            'action' => '/change',
            'method' => 'POST',
        ])
            ->add('message', TextType::class)
            ->getForm();
        $message = $this->master->logString($message);

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
        $this->session->set('transformation', $_POST['transformation']);
        $this->session->set('message', $_POST['form']['message']);
        return $this->redirectToRoute('master');
    }
}
