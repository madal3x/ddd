<?php

namespace idaccess\domain\model;

use common\domain\model\DomainEventPublisher;
use idaccess\domain\model\event\UserAuthorizationFailed;
use idaccess\domain\model\event\UserAuthorizationSucceeded;

class AuthorizationService {
    private $userRepository;
    private $roleRepository;
    private $encryptionService;
    private $authorizationTokenService;
    private $domainEventPublisher;

    public function __construct(UserRepository $userRepository, RoleRepository $roleRepository, EncryptionService $encryptionService, AuthorizationTokenService $authorizationTokenService, DomainEventPublisher $domainEventPublisher) {
        $this->userRepository = $userRepository;
        $this->roleRepository = $roleRepository;
        $this->encryptionService = $encryptionService;
        $this->authorizationTokenService = $authorizationTokenService;
        $this->domainEventPublisher = $domainEventPublisher;
    }

    public function authorize($username, $password, $roleName) {
        $encryptedPassword = $this->encryptionService->encrypt($password);
        $user = $this->userRepository->getByUsernameAndPassword($username, $encryptedPassword);
        if ($user) {
            if ($this->roleRepository->getByUserIdAndRoleName($user->id(), $roleName)) {
                $token = $this->authorizationTokenService->generate();

                $this->domainEventPublisher->publish(new UserAuthorizationSucceeded($username, $roleName, $token));

                return true;
            }
        }

        $this->domainEventPublisher->publish(new UserAuthorizationFailed($username, $roleName));

        return false;
    }
}