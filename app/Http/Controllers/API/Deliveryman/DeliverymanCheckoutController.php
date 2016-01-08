<?php

namespace BenditaFome\Http\Controllers\API\Deliveryman;

use BenditaFome\Repositories\OrderRepository;
use BenditaFome\Repositories\UserRepository;
use BenditaFome\Services\OrderService;
use Illuminate\Http\Request;

use BenditaFome\Http\Requests;
use BenditaFome\Http\Controllers\Controller;
use Illuminate\Http\Response;
use LucaDegasperi\OAuth2Server\Authorizer;

class DeliverymanCheckoutController extends Controller
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
        $deliverymanId = $this->authorizer->getResourceOwnerId();

        return $this->orderRepository
            ->with(['coupon', 'client', 'items.product.category'])
            ->findWhere(['user_deliveryman_id' => $deliverymanId]);
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
     * @param $orderId
     *
     * @return mixed
     */
    public function show($orderId)
    {
        $deliverymanId = $this->authorizer->getResourceOwnerId();

        return $this->orderRepository
            ->with(['coupon', 'client', 'items.product.category'])
            ->findWhere(['id' => $orderId, 'user_deliveryman_id' => $deliverymanId]);
    }

    public function update(Request $request, $id)
    {
        $deliverymanId = $this->authorizer->getResourceOwnerId();

        if ($this->orderService->update([
            'id'                  => $id,
            'user_deliveryman_id' => $deliverymanId,
        ], $request)
        ) {
            $type = ['type' => 'success'];
            $code = Response::HTTP_OK;
        }

        $type = (! $type) ? ['type' => 'not found'] : $type;
        $code = (! $code) ? Response::HTTP_NOT_FOUND : $code;

        return response($type, $code)
            ->header('Content-Type', 'application/json');
    }
}
