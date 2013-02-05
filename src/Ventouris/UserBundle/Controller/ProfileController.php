<?php

namespace Cuaround\UserBundle\Controller;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use FOS\UserBundle\Model\UserInterface;
use FOS\UserBundle\Controller\ProfileController as BaseController;
use Symfony\Component\HttpFoundation\Request;

/**
 * Controller managing the user profile
 *
 * @author Christophe Coevoet <stof@notk.org>
 */
class ProfileController extends BaseController {

    /**
     * Edit the user
     */
    public function editAction() {
        $user = $this->container->get('security.context')->getToken()->getUser();

        $formHandler = $this->container->get('fos_user.profile.form.handler');

        $process = $formHandler->process($user);

        if ($process) {
            $this->setFlash('fos_user_success', 'profile.flash.updated');
            /* if($user->getUnderReview() == true && $user->getUnderReviewDate() == null) {
              $user->setUnderReviewDate(new \DateTime());
              $this->container->get('doctrine')->getEntityManager()->flush();
              }
              $this->authenticateUser($user); */

            return new RedirectResponse($this->route('fos_user_profile_show'));
        }

        $uform = $this->container->get('fos_user.profile.form');
        //$pform = $this->container->get('fos_user.change_password.form');
        $theme = 'fos_user_theme';
        //var_dump($uform->createView()); die();

        return $this->container->get('templating')->renderResponse('CuaroundUserBundle:Profile:edit.html.twig', array(
                    'form' => $uform->createView(),
                    //'password_form' => $pform->createView(),
                    'theme' => $theme,
                ));
    }

}