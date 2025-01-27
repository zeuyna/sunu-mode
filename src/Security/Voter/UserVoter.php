<?php

namespace App\Security\Voter;

use App\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;

class UserVoter extends Voter {

    protected function supports(string $attribute, $subject)
    {
        return in_array($attribute, ['PUT', 'DELETE']) && $subject instanceof User;
    }

    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
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
                    return $user === $subject;
                break;

                case 'DELETE':
                    return $user->getRoles()[0] === "ROLE_ADMIN" && ($subject->getRoles()[0] === "ROLE_CLIENT");
                break;
            }
        }
    }
}