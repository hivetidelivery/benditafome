<?php

namespace BenditaFome\Services;

use BenditaFome\Repositories\ClientRepository as Client;
use BenditaFome\Repositories\UserRepository as User;
use Illuminate\Support\Facades\DB;

/**
 * Class ClientService
 * @package BenditaFome\Services
 */
class ClientService
{
    /**
     * Define a password pattern on create clients
     */
    const PASSWORD_PATTERN = 123456;

    private $user;

    /**
     * @var Client
     */
    private $clientRepository;
    /**
     * @var User
     */
    private $userRepository;

    /**
     * @param Client $clientRepository
     * @param User   $userRepository
     */
    public function __construct(Client $clientRepository, User $userRepository)
    {
        $this->clientRepository = $clientRepository;
        $this->userRepository   = $userRepository;
    }

    /**
     * @param array $data
     * @param       $id
     */
    public function update(array $data, $id)
    {
        $this->clientRepository->update($data, $id);
        $this->userRepository->update($data['user'], $this->clientRepository->find($id)->user->id);
    }

    /**
     * @param $data
     */
    public function store($data)
    {
        $data['user']['role']     = 'client';
        $data['user']['password'] = bcrypt(self::PASSWORD_PATTERN);
        $user                     = $this->userRepository->create($data['user']);

        $data['user_id'] = $user->id;

        $this->clientRepository->create($data);
    }

}