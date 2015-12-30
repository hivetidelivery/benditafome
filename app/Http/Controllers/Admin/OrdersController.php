<?php

namespace BenditaFome\Http\Controllers\Admin;

use BenditaFome\Http\Controllers\Controller;
use BenditaFome\Repositories\OrderRepository;
use BenditaFome\Repositories\UserRepository;
use Illuminate\Http\Request;

/**
 * Class OrdersController
 * @package BenditaFome\Http\Controllers
 */
class OrdersController extends Controller
{
    /**
     * @var OrderRepository
     */
    private $orderRepository;

    /**
     * @param OrderRepository $orderRepository
     */
    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('admin.orders.index', [
            'orders'      => $this->orderRepository->paginate(5),
            'list_status' => ['Pendente', 'A caminho', 'Entregue'],
            'row_class'   => ['danger', 'warning', 'success'],
        ]);
    }

    /**
     * @param                $id
     * @param UserRepository $userRepository
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id, UserRepository $userRepository)
    {
        return view('admin.orders.edit', [
            'order'       => $this->orderRepository->find($id),
            'list_status' => ['Pendente', 'A caminho', 'Entregue'],
            'deliveryman' => $userRepository->allDeliveryman(),
        ]);
    }

    /**
     * @param Request $request
     * @param         $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        try {
            $this->orderRepository->update($request->all(), $id);
        } catch (\Exception $e) {
            die($e->getMessage());
        }

        return redirect()->route('admin.orders.index');
    }

}
