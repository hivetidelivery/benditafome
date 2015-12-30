<?php

namespace BenditaFome\Http\Controllers\Costumer;

use BenditaFome\Http\Controllers\Controller;
use BenditaFome\Http\Requests\CostumerCheckoutRequest;
use BenditaFome\Models\Client;
use BenditaFome\Repositories\OrderRepository;
use BenditaFome\Repositories\ProductRepository;
use BenditaFome\Repositories\UserRepository;
use BenditaFome\Services\OrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Class CheckoutController
 * @package BenditaFome\Http\Controllers
 */
class CheckoutController extends Controller
{
    /**
     * @var OrderRepository
     */
    private $orderRepository;
    /**
     * @var ProductRepository
     */
    private $productRepository;
    /**
     * @var UserRepository
     */
    private $userRepository;
    /**
     * @var OrderService
     */
    private $orderService;

    /**
     * @param OrderRepository   $orderRepository
     * @param UserRepository    $userRepository
     * @param ProductRepository $productRepository
     * @param OrderService      $orderService
     */
    public function __construct(
        OrderRepository $orderRepository,
        UserRepository $userRepository,
        ProductRepository $productRepository,
        OrderService $orderService
    )
    {
        $this->orderRepository   = $orderRepository;
        $this->productRepository = $productRepository;
        $this->userRepository    = $userRepository;
        $this->orderService      = $orderService;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $clientId = $this->userRepository
            ->find(Auth::user()->id)
            ->client
            ->id;

        return view('costumer.orders.index', [
            'orders'      => $this->orderRepository->scopeQuery(function ($q) use ($clientId) {
                return $q->where('client_id', '=', $clientId);
            })->paginate(5),

            'list_status' => ['Pendente', 'A caminho', 'Entregue'],
            'row_class'   => ['danger', 'warning', 'success'],
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('costumer.orders.create', [
            'products' => $this->productRepository->lists(),
        ]);
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function store(Request $request)
    {
        $data              = $request->all();
        $data['client_id'] = $this->userRepository
            ->find(Auth::user()->id)
            ->client
            ->id;

        $this->orderService->create($data);

        return redirect()->route('costumer.order.index');
    }
}
