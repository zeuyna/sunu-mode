
<?php

namespace App\Security\Voter;

use App\Entity\Article;

use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;

class DepositVoter extends Voter{

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

        switch ($attribute) {
            case 'POST':
                return ;
            break;

            case 'PUT':
                return ;
            break;

            case 'DELETE':
                return ;
            break;
            
            default:
                return false;

            break;
        }
    }
}