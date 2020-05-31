<?php

namespace App\Security\Voter;

use App\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;

class UserVoter extends Voter{

    protected function supports($attribute, $subject) {
        return in_array($attribute, ['POST', 'PUT', 'DELETE']) && $subject instanceof User;
    }

    protected function voteOnAttribute($attribute, $subject, TokenInterface $token) {
        $user = $token->getUser();

        if (!$user instanceof UserInterface) {
            return false;
        }

        if ($user->getRoles()[0] === "ROLE_SUPER_ADMIN") {
            return true;
        }

        if($subject instanceof User) {
            switch ($attribute) {
                case 'PUT':
                    return $user->getRoles()[0] === "ROLE_ADMIN" && ($subject->getRoles()[0] === "ROLE_CASHIER" || $subject->getRoles()[0] === "ROLE_PARTENAIRE");
                break;
                case 'POST':
                    return $user->getRoles()[0] === "ROLE_ADMIN" && ($subject->getRoles()[0] === "ROLE_CASHIER" || $subject->getRoles()[0] === "ROLE_PARTENAIRE");
                break;

                case 'DELETE':
                    return $user->getRoles()[0] === "ROLE_ADMIN" && ($subject->getRoles()[0] === "ROLE_CASHIER" || $subject->getRoles()[0] === "ROLE_PARTENAIRE");
                break;
                default:
                    return false;
                break;
            }
        }
    }
}