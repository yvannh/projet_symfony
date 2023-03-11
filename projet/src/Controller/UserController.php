<?php

namespace App\Controller;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Twig\Environment;
use App\Entity\User;
use App\Entity\Contact;
use App\Form\UserFormType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UserController extends AbstractController
{

    public function show(Environment $twig, Request $request, EntityManagerInterface $entityManager) {
        $user = new User();
    
        $form = $this->createForm(UserFormType::class, $user);

        $form->handleRequest($request);

        $error = "";
        if($form->isSubmitted() && $form->isValid()) {

            $valid = $entityManager->getRepository(User::class)->findOneBy([
                'login' => $form["login"]->getData(),
                'password' => $form["password"]->getData()
            ]);
            
            if(is_null($valid)) {
                $error = "Le compte n'existe pas, vérifiez les identifiants";
            } else {
                
                $contacts = $entityManager->getRepository(Contact::class)->findBy([
                    'user' => $valid->getId()
                ]);

                $liste = array();
                
                foreach ($contacts as $val) {
                    $cont = $entityManager->getRepository(User::class)->findBy(
                        ['id' => $val->getContact()
                    ]);

                    array_push($liste, $cont[0]);
                    //var_dump($val);
                }
                
                return new Response($twig->render('user/logged.html.twig', [
                    'login' => $form["login"]->getData(),
                    'contacts' => $liste
                ]));
            }
        }

        return new Response($twig->render('user/show.html.twig', [
            'user_form' => $form->createView(),
            'error' => $error
        ]));
    }
}
?>