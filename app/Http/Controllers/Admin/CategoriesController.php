<?php

namespace BenditaFome\Http\Controllers\Admin;

use BenditaFome\Http\Controllers\Controller;
use BenditaFome\Repositories\CategoryRepository as Category;
use BenditaFome\Http\Requests\AdminCategoryRequest;
use BenditaFome\Http\Requests;

/**
 * Class CategoriesController
 * @package BenditaFome\Http\Controllers
 */
class CategoriesController extends Controller
{
    /**
     * @var Category
     */
    private $repository;

    /**
     * @param Category $repository
     */
    public function __construct(Category $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('admin.categories.index', [
            'categories' => $this->repository->paginate(5),
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * @param AdminCategoryRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(AdminCategoryRequest $request)
    {
        $this->repository->create($request->all());

        return redirect()->route('admin.categories.index');
    }

    /**
     * @param $id
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        return view('admin.categories.edit', [
            'category' => $this->repository->find($id),
        ]);
    }

    /**
     * @param AdminCategoryRequest $request
     * @param                      $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(AdminCategoryRequest $request, $id)
    {
        $this->repository->update($request->all(), $id);

        return redirect()->route('admin.categories.index');
    }

    /**
     * @param $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $this->repository->delete($id);

        return redirect()->route('admin.categories.index');
    }
}
