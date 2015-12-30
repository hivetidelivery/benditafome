<?php

namespace BenditaFome\Http\Controllers\Admin;

use BenditaFome\Http\Controllers\Controller;
use BenditaFome\Http\Requests;

/**
 * Class HomeController
 * @package BenditaFome\Http\Controllers\Admin
 */
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function index()
    {
        return view('home');
    }
}
