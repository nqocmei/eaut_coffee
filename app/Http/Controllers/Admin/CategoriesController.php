<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Repositories\Categories\CategoriesInterface;

class CategoriesController extends Controller
{

    private $CategoriesRepository;

    public function __construct(CategoriesInterface $CategoriesRepository)
    {
        $this->CategoriesRepository = $CategoriesRepository;
    }

    public function index()
    {
        $categories = $this->CategoriesRepository->getAllCategories();

        return view('admin.categories.index', ['categories' => $categories]);
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'name' => 'required',
            'is_show_in_nav' => 'required',
            'path' => 'nullable|starts_with:/',
        ]);

        $this->CategoriesRepository->storeCategories($validatedData);

        return redirect()->route('category.index');
    }

    public function edit($id)
    {
        $category = $this->CategoriesRepository->findCategoriesById($id);
        return view('admin.categories.edit', ['category' => $category]);
    }

    public function update($id, Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'is_show_in_nav' => 'required',
            'path' => 'nullable|starts_with:/',
        ]);

        $this->CategoriesRepository->updateCategories($validatedData, $id);

        return redirect()->route('category.index')->with('success', 'Cập nhập danh mục thành công');
    }

    public function destroy($id)
    {
        $this->CategoriesRepository->deleteCategories($id);

        return redirect()->route('category.index')->with('success', 'Xóa danh mục thành công');
    }

}
