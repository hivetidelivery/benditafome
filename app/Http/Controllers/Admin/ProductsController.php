<?php

namespace BenditaFome\Http\Controllers\Admin;

use BenditaFome\Http\Controllers\Controller;
use BenditaFome\Repositories\CategoryRepository as Category;
use BenditaFome\Repositories\ProductRepository as Product;
use BenditaFome\Http\Requests\AdminProductRequest;
use BenditaFome\Http\Requests;

/**
 * Class productsController
 * @package BenditaFome\Http\Controllers
 */
class ProductsController extends Controller
{
    /**
     * @var Product
     */
    private $repository;

    /**
     * @var Category
     */
    private $categoryRepository;

    /**
     * @param Product  $repository
     * @param Category $categoryRepository
     */
    public function __construct(Product $repository, Category $categoryRepository)
    {
        $this->repository         = $repository;
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('admin.products.index', [
            'products' => $this->repository->paginate(5),
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.products.create', [
            'categories' => $this->categoryRepository->lists(),
        ]);
    }

    /**
     * @param AdminProductRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(AdminProductRequest $request)
    {
        $this->repository->create($request->all());

        return redirect()->route('admin.products.index');
    }

    /**
     * @param $id
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        return view('admin.products.edit', [
            'product'    => $this->repository->find($id),
            'categories' => $this->categoryRepository->lists(),
        ]);
    }

    /**
     * @param AdminProductRequest  $request
     * @param                      $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(AdminProductRequest $request, $id)
    {
        $this->repository->update($request->all(), $id);

        return redirect()->route('admin.products.index');
    }

    /**
     * @param $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $this->repository->delete($id);

        return redirect()->route('admin.products.index');
    }
}
