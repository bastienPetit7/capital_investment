<?php

namespace App\Exception;

use Symfony\Component\Security\Core\Exception\AccountStatusException;
use Symfony\Component\Security\Core\Exception\AuthenticationException;

class MyDisabledException extends AccountStatusException
{
    public function getMessageKey()
    {
       throw new AuthenticationException("Your account is disabled, please contact support for more infos.");
    }
}