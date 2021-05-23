<?php


namespace App\Repositories;


use App\Models\Client;
use App\Repositories\Contracts\ClientRepositoryInterface;

class ClientRepository implements ClientRepositoryInterface
{
    /**
     * @var Client
     */
    private $entity;

    /**
     * ClientRepository constructor.
     */
    public function __construct(Client $client)
    {
        $this->entity = $client;
    }


    public function createNewClient(array $data)
    {
        $data['password'] = bcrypt($data['password']);
        return $this->entity->create($data);
    }

    public function getClient(int $id)
    {
        // TODO: Implement getClient() method.
    }
}
