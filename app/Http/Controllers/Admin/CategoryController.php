<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * @var Category
     */
    private $repository;

    /**
     * CategoryController constructor.
     */
    public function __construct(Category $category)
    {
        $this->repository = $category;
        $this->middleware('can:categories');
    }

    public function index()
    {
        $categories = $this->repository->latest()->paginate();
        return view('admin.pages.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.categories.create');
    }


    public function store(StoreUpdateCategoryRequest $request)
    {
        $this->repository->create($request->all());
        return redirect()->route('categories.index');
    }


    public function show($id)
    {
        if (!$category = $this->repository->find($id)) {
            return redirect()->back();
        }
        return view('admin.pages.categories.show', compact('category'));
    }


    public function edit($id)
    {
        if (!$category = $this->repository->find($id)) {
            return redirect()->back();
        }

        return view('admin.pages.categories.edit', compact('category'));
    }


    public function update(StoreUpdateCategoryRequest $request, $id)
    {
        if (!$category = $this->repository->find($id)) {
            return redirect()->back();
        }

        $category->update($request->all());

        return redirect()->route('categories.index');
    }


    public function destroy($id)
    {
        if (!$category = $this->repository->find($id)) {
            return redirect()->back();
        }

        $category->delete();

        return redirect()->route('categories.index');
    }

    public function search(Request $request)
    {
        $filters = $request->only('filter');

        $categories = $this->repository
            ->where(function ($query) use ($request) {
                if ($request->filter) {
                    $query->orWhere('description', 'LIKE', "%{$request->filter}%");
                    $query->orWhere('name', $request->filter);
                }
            })
            ->latest()
            ->paginate();

        return view('admin.pages.categories.index', compact('categories', 'filters'));
    }

}
