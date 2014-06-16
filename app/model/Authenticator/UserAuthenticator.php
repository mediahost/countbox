<?php

namespace App\Model\Authenticator;

use Nette;

/**
 * Users Authenticator.
 */
class UserAuthenticator extends Nette\Object implements Nette\Security\IAuthenticator
{

    /** @var \App\Model\Facade\UserFacade */
    private $userFacade;

    public function __construct(\App\Model\Facade\UserFacade $userFacade)
    {
        $this->userFacade = $userFacade;
    }

    /**
     * Performs an authentication.
     * @return Nette\Security\Identity
     * @throws Nette\Security\AuthenticationException
     */
    public function authenticate(array $credentials)
    {
        list($username, $password) = $credentials;

        $user = $this->userFacade->findByUsername($username);

        if (!$user) {
            throw new Nette\Security\AuthenticationException('The username is incorrect.', self::IDENTITY_NOT_FOUND);
        } elseif (!$user->verifyPassword($password)) {
            throw new Nette\Security\AuthenticationException('The password is incorrect.', self::INVALID_CREDENTIAL);
        } elseif ($user->needsRehash()) {
            $user->setPassword($password);
            $this->userFacade->save($user);
        }
        
        $arr = $user->toArray();
        return new Nette\Security\Identity($user->getUsername(), $user->getRolesArray(), $arr);
    }

}
