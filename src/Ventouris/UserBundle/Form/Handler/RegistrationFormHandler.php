<?php

/*
 * This file is part of the FOSUserBundle package.
 *
 * (c) FriendsOfSymfony <http://friendsofsymfony.github.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ventouris\UserBundle\Form\Handler;

use FOS\UserBundle\Form\Handler\RegistrationFormHandler as BaseHandler;

class RegistrationFormHandler extends BaseHandler {

    public function process($confirmation = false) {
        $user = $this->userManager->createUser();
        $this->form->setData($user);

        if ('POST' == $this->request->getMethod()) {

            $user->setUsername($this->randomString());
            $list = new \Ventouris\UserBundle\Entity\IgnoreMailList;
            $list->setUser($user);
            $user->setIgnoreMailList($list);

            $this->form->bindRequest($this->request);
            if ($this->form->isValid()) {
                $user = $this->form->getData();
                if($user->getName() === 'Name' || strlen($user->getName()) < 3) {
                    throw new \Exception('Name too short');
                }
                if($user->getName() === 'Surname' || strlen($user->getName()) < 3) {
                    throw new \Exception('Surname too short');
                }
                $this->onSuccess($user, $confirmation);
                return true;
            }
        }

        return false;
    }

    private function randomString() {

        $len = 16;
        $base = 'ABCDEFGHKLMNOPQRSTWXYZabcdefghjkmnpqrstwxyz123456789';
        $max = strlen($base) - 1;
        $activatecode = '';
        mt_srand((double) microtime() * 1000000);
        while (strlen($activatecode) < $len + 1)
            $activatecode.=$base{mt_rand(0, $max)};

        return $activatecode;
    }

}
