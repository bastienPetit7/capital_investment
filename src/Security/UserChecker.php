<?php

namespace App\Security;



use App\Dictionary\AvailableRoles;
use App\Dictionary\AvailableStatusMode;
use App\Entity\User;
use App\Exception\MyDisabledException;
use Symfony\Component\Security\Core\User\UserCheckerInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class UserChecker implements UserCheckerInterface
{

    public function checkPreAuth(UserInterface $user)
    {
        if(!$user instanceof User)
        {
            return;
        }

        if($user->getRoles()[0] === AvailableRoles::ROLE_INVESTOR)
        {
            $investorProfile = $user->getInvestor();

            // if($investorProfile->getStatus() === AvailableStatusMode::GHOST)
            // {
            //     $exception = new MyDisabledException();
            //     return $exception->getMessageKey();
            // }
        }
    }

    public function checkPostAuth(UserInterface $user)
    {
        // TODO: Implement checkPostAuth() method.
    }
}