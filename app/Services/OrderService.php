<?php

namespace BenditaFome\Services;

use BenditaFome\Models\Order;
use BenditaFome\Repositories\CouponRepository;
use BenditaFome\Repositories\OrderRepository;
use BenditaFome\Repositories\ProductRepository;
use Illuminate\Http\Request;
use Mockery\Exception;

/**
 * Class OrderService
 * @package BenditaFome\Services
 */
class OrderService
{
    /**
     * @var OrderRepository
     */
    private $orderRepository;
    /**
     * @var CouponRepository
     */
    private $couponRepository;
    /**
     * @var ProductRepository
     */
    private $productRepository;

    /**
     * @param OrderRepository   $orderRepository
     * @param CouponRepository  $couponRepository
     * @param ProductRepository $productRepository
     */
    public function __construct(
        OrderRepository $orderRepository,
        CouponRepository $couponRepository,
        ProductRepository $productRepository
    )
    {
        $this->orderRepository   = $orderRepository;
        $this->couponRepository  = $couponRepository;
        $this->productRepository = $productRepository;
    }

    /**
     * @param array $data
     *
     * @throws \Exception
     */
    public function create(array $data)
    {
        \DB::beginTransaction();
        try {
            $data['status'] = 0;
            if (isset($data['coupon_code'])) {
                $coupon = $this->couponRepository
                    ->findByField('code', $data['coupon_code'])
                    ->first();

                $data['coupon_id'] = $coupon->id;
                $coupon->used      = 1;
                $coupon->save();

                unset($data['coupon_code']);
            }

            $items = $data['items'];
            unset($data['items']);

            $order = $this->orderRepository->create($data);
            $total = 0;

            foreach ($items as $item) {
                $item['price'] = $this->productRepository->find($item['product_id'])->price;
                $order->items()->create($item);
                $total += $item['price'] * $item['quantity'];
            }

            $order->total = $total;
            if (isset($coupon))
                $order->total = $total - $coupon->value;

            $order->save();

            \DB::commit();

            return $order;
        } catch (\Exception $e) {
            \DB::rollback();
            throw $e;
        }
    }

    /**
     * @param array   $where
     * @param Request $request
     *
     * @return bool|string
     */
    public function update(array $where, Request $request)
    {
        try {
            if ($request->method() === 'PATCH') {
                $dataRequest = $request->all();
                $key         = array_keys($dataRequest)[0];
                $value       = $dataRequest[ $key ];
                $order       = $this->orderRepository->findWhere($where)->first();

                return $order ? $order->update([$key => $value]) : false;
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }

        return false;
    }

}