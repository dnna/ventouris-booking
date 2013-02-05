<?php

namespace Cuaround\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class CuaroundUserBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
