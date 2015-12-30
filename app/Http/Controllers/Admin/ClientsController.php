<?php

namespace BenditaFome\Http\Controllers\Admin;

use BenditaFome\Http\Controllers\Controller;
use BenditaFome\Http\Requests;
use BenditaFome\Repositories\ClientRepository as Client;
use BenditaFome\Services\ClientService;
use BenditaFome\Http\Requests\AdminClientRequest;

/**
 * Class ClientsController
 * @package BenditaFome\Http\Controllers\Admin
 */
class ClientsController extends Controller
{
    private $repository;
    private $clientService;

    /**
     * @param Client        $repository
     * @param ClientService $clientService
     */
    public function __construct(Client $repository, ClientService $clientService)
    {
        $this->repository    = $repository;
        $this->clientService = $clientService;
    }

    /**
     * List item
     * @return mixed
     */
    public function index()
    {
        return view('admin.clients.index', [
            'clients' => $this->repository->paginate(5),
        ]);
    }

    /**
     * Form from create item
     * @return mixed
     */
    public function create()
    {
        return view('admin.clients.create');
    }

    /**
     * @param AdminClientRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(AdminClientRequest $request)
    {
        $this->clientService->store($request->all());

        return redirect()->route('admin.clients.index');
    }

    /**
     * Form view item
     *
     * @param $id
     *
     * @return mixed
     */
    public function edit($id)
    {
        return view('admin.clients.edit', [
            'client' => $this->repository->find($id),
        ]);
    }

    /**
     * @param AdminClientRequest $request
     * @param                    $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(AdminClientRequest $request, $id)
    {
        $this->clientService->update($request->all(), $id);

        return redirect()->route('admin.clients.index');
    }
}
