<?php

namespace BenditaFome\Http\Controllers\Admin;

use BenditaFome\Http\Controllers\Controller;
use BenditaFome\Http\Requests\AdminCouponRequest;
use BenditaFome\Repositories\CouponRepository;
use BenditaFome\Http\Requests;

/**
 * Class CouponsController
 * @package BenditaFome\Http\Controllers
 */
class CouponsController extends Controller
{
    /**
     * @var CouponRepository
     */
    private $couponRepository;

    /**
     * @param CouponRepository $couponRepository
     */
    public function __construct(CouponRepository $couponRepository)
    {
        $this->couponRepository = $couponRepository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('admin.coupons.index', [
            'coupons' => $this->couponRepository->paginate(5),
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.coupons.create');
    }

    /**
     * @param AdminCouponRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(AdminCouponRequest $request)
    {
        $this->couponRepository->create($request->all());

        return redirect()->route('admin.coupons.index');
    }

    /**
     * @param $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $this->couponRepository->delete($id);

        return redirect()->route('admin.coupons.index');
    }
}
