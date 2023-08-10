<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCategoryRequest;
use App\Models\Category;
use App\Repositories\CategoryRepository;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CategoryController extends Controller
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
            $data = Category::all();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){

                    $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">View</a>';

                    return $btn;
                })
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
    public function store(CreateCategoryRequest $request)
    {
        $input = $request->all();
        $input['is_active'] = ! isset($input['is_active']) ? false : true;
        $this->categoryRepository->create($input);

        return response()->json(['success' => true]);
    }

    /**
     * @param  int  $id
     *
     * @return Application|Factory|RedirectResponse|Redirector|View
     */
    public function show($id)
    {
        $category = Category::find($id);
        if (empty($category)) {
            Flash::error(__('messages.flash.medicine_category_not_found'));

            return redirect(route('categories.index'));
        }
        $medicines = $category->medicines;

        return view('categories.show', compact('medicines', 'category'));
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
     * @return JsonResponse
     */
    public function update(Category $category, UpdateCategoryRequest $request)
    {
        $input = $request->all();
        $input['is_active'] = ! isset($input['is_active']) ? false : true;
        $this->categoryRepository->update($input, $category->id);

        return $this->sendSuccess(__('messages.flash.medicine_category_retrieved'));
    }

    /**
     * Remove the specified Category from storage.
     *
     * @param  Category  $category
     * @throws Exception
     *
     * @return JsonResponse
     */
    public function destroy(Category $category)
    {
        $medicineCategoryModel = [
            Medicine::class,
        ];
        $result = canDelete($medicineCategoryModel, 'category_id', $category->id);
        if ($result) {
            return $this->sendError(__('messages.flash.medicine_category_cant_deleted'));
        }
        $this->categoryRepository->delete($category->id);

        return $this->sendSuccess(__('messages.flash.medicine_category_deleted'));
    }

    /**
     * @param  int  $id
     *
     * @return JsonResponse
     */
    public function activeDeActiveCategory($id)
    {
        $category = Category::findOrFail($id);
        $category->is_active = ! $category->is_active;
        $category->save();

        return $this->sendSuccess(__('messages.flash.medicine_category_updated'));
    }
}
