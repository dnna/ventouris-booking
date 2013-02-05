<?php

/*
 * This file is part of the FOSUserBundle package.
 *
 * (c) FriendsOfSymfony <http://friendsofsymfony.github.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Ventouris\UserBundle\Extension;

use FOS\UserBundle\Entity\UserManager;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;


class MyUserManager extends UserManager
{

    /**
     * Loads a user by username
     *
     * It is strongly discouraged to call this method manually as it bypasses
     * all ACL checks.
     *
     * @param string $username
     * @return UserInterface
     */
    public function loadUserByUsername($username)
    {
        $user = $this->findUserByUsernameOrEmail($username);

        if (!$user) {
            throw new UsernameNotFoundException(sprintf('No user with name "%s" was found.', $username));
        }

        return $user;
    }

}
