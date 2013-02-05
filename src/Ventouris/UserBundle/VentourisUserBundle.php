<?php

namespace Ventouris\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class VentourisUserBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
