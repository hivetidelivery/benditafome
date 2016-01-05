<?php

namespace BenditaFome\Http\Controllers\API\Client;

use BenditaFome\Repositories\OrderRepository;
use BenditaFome\Repositories\UserRepository;
use BenditaFome\Services\OrderService;
use Illuminate\Http\Request;

use BenditaFome\Http\Requests;
use BenditaFome\Http\Controllers\Controller;
use LucaDegasperi\OAuth2Server\Authorizer;

class ClientCheckoutController extends Controller
{
    /**
     * @var Authorizer
     */
    private $authorizer;
    /**
     * @var OrderRepository
     */
    private $orderRepository;
    /**
     * @var OrderService
     */
    private $orderService;
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * @param Authorizer      $authorizer
     * @param OrderRepository $orderRepository
     * @param OrderService    $orderService
     * @param UserRepository  $userRepository
     */
    public function __construct(
        Authorizer $authorizer,
        OrderRepository $orderRepository,
        OrderService $orderService,
        UserRepository $userRepository
    )
    {
        $this->authorizer      = $authorizer;
        $this->orderRepository = $orderRepository;
        $this->orderService    = $orderService;
        $this->userRepository  = $userRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = $this->authorizer->getResourceOwnerId();

        return $this->orderRepository->with('items')
            ->scopeQuery(function ($query) use ($id) {

                return $query->where('client_id', '=', $id);

            })->paginate(5);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data              = $request->all();
        $userId            = $this->authorizer->getResourceOwnerId();
        $data['client_id'] = $this->userRepository
            ->find($userId)
            ->client
            ->id;

        $order = $this->orderService->create($data);

        return $this->orderRepository
            ->with('items')
            ->find($order->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->orderRepository
            ->with(['coupon', 'items.product.category'])
            ->find($id);
    }
}
