<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use App\Repositories\CategoryRepository;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CategoryController extends AppBaseController
{
    /** @var CategoryRepository */
    private $categoryRepository;

    public function __construct(CategoryRepository $categoryRepo)
    {
        $this->categoryRepository = $categoryRepo;
    }

    /**
     * @throws \Exception
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of(Category::all())
                ->addIndexColumn()
                ->addColumn('action','categories.action')
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('categories.index');
    }

    /**
     * Store a newly created Category in storage.
     *
     * @param  CreateCategoryRequest  $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $input['status'] = ! isset($input['status']) ? false : true;
        $category = $this->categoryRepository->create($input);

        if (isset($input['image']) && ! empty($input['image'])) {
            $fileExtension = getFileName('Category', $input['image']);
            $category->addMedia($input['image'])->usingFileName($fileExtension)->toMediaCollection(Category::COLLECTION_CATEGORY_PICTURES,
                config('app.media_disc'));
        }

        return response()->json(['success' => 'Category saved successfully.']);
    }

    /**
     * Show the form for editing the specified Category.
     *
     * @param  Category  $category
     *
     * @return JsonResponse
     */
    public function edit(Category $category)
    {
        return $this->sendResponse($category, __('messages.flash.medicine_category_retrieved'));
    }

    /**
     * Update the specified Category in storage.
     *
     * @param  Category  $category
     * @param  UpdateCategoryRequest  $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Category $category, Request $request)
    {
        $input = $request->all();
        $input['status'] = ! isset($input['status']) ? false : true;
        $category = $this->categoryRepository->update($input, $category->id);

        if (isset($input['image']) && !empty($input['image'])) {
            $category->clearMediaCollection(Category::COLLECTION_CATEGORY_PICTURES);
            $fileExtension = getFileName('Category', $input['image']);
            $category->addMedia($input['image'])->usingFileName($fileExtension)->toMediaCollection(Category::COLLECTION_CATEGORY_PICTURES,
                config('app.media_disc'));
        }

        return $this->sendSuccess('Category updated succecssfully.');
    }

    /**
     * Remove the specified Category from storage.
     *
     * @param  Category  $category
     * @return \Illuminate\Http\JsonResponse
     * @throws Exception
     *
     */
    public function destroy(Category $category)
    {
        $this->categoryRepository->delete($category->id);

        return response()->json(['success' => true]);
    }

    /**
     * @param  int  $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function activeDeActiveCategory($id)
    {
        $category = Category::findOrFail($id);
        $category->status = ! $category->status;
        $category->save();

        return $this->sendSuccess('Category updated successfully.');
    }
}
