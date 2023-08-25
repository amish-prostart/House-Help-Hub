<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\UpdateUserProfileRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Category;
use App\Models\Department;
use App\Models\DoctorDepartment;
use App\Models\User;
use App\Repositories\UserRepository;
use Carbon\Carbon;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Laracasts\Flash\Flash;
use Spatie\Permission\Models\Role;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;
use Yajra\DataTables\DataTables;

class UserController extends AppBaseController
{
    /** @var UserRepository */
    private $userRepository;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepository = $userRepo;
    }

    /**
     * @param  ChangePasswordRequest  $request
     *
     * @return JsonResponse
     */
    public function changePassword(ChangePasswordRequest $request)
    {
        $input = $request->all();

        try {
            $user = $this->userRepository->changePassword($input);

            return $this->sendSuccess( __('messages.flash.password_update'));
        } catch (Exception $e) {
            return $this->sendError($e->getMessage(), 422);
        }
    }

    /**
     * @param  UpdateUserProfileRequest  $request
     *
     * @return JsonResponse
     */
    public function profileUpdate(UpdateUserProfileRequest $request)
    {
        $input = $request->all();

        try {
            $user = $this->userRepository->profileUpdate($input);

            return $this->sendResponse($user,  __('messages.flash.profile_update'));
        } catch (Exception $e) {
            return $this->sendError($e->getMessage(), 422);
        }
    }

    /**
     * Show the form for editing the specified User.
     *
     * @return JsonResponse
     */
    public function editProfile()
    {
        $user = getLoggedInUser()->append('image_url');

        return $this->sendResponse($user, __('messages.flash.user_retrieved'));
    }

    /**
     * @param  Request  $request
     *
     * @return JsonResponse
     */
    public function updateLanguage(Request $request)
    {
        $language = $request->get('language');

        /** @var User $user */
        $user = $request->user();
        $user->update(['language' => $language]);

        return $this->sendSuccess( __('messages.flash.language_update'));
    }

    /**
     * @param  Request  $request
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws Exception
     *
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return Datatables::of(User::all())
                ->addIndexColumn()
                ->addColumn('action','users.action')
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('users.index');
    }

    public function create()
    {
        $categories = Category::where('status',1)->pluck('name','id');
        $roles = User::ROLES;

        return view('users.create',compact('categories','roles'));
    }

    /**
     * Store a newly created User in storage.
     *
     * @param  CreateUSerRequest  $request
     *
     * @return Application|\Illuminate\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws Throwable
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $input = $request->all();
            $input['status'] = isset($input['status']) ? 1 : 0;
            $input['is_active'] = isset($input['is_active']) ? 1 : 0;
            $this->userRepository->store($input);
            Flash::success('User added successfully.');
            DB::commit();

            return redirect(route('users.index'));
        } catch (Exception $e) {
            DB::rollBack();

            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }

    /**
     * @param $user
     * @return Application|Factory|View
     */
    public function show(User $user)
    {
        $user = $user->load('category');

        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified User.
     *
     * @param  User  $user
     *
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function edit(User $user)
    {
        $categories = Category::where('status',1)->pluck('name','id');
        $roles = User::ROLES;

        return view('users.edit', compact( 'user','categories','roles'));
    }

    /**
     * Update the specified User in storage.
     *
     * @param  UpdateUserRequest  $request
     *
     * @param  User  $user
     * @return Application|RedirectResponse|Redirector
     */
    public function update(Request $request, User $user)
    {
        $input = $request->all();
        $input['status'] = isset($input['status']) ? 1 : 0;
        $input['is_active'] = isset($input['is_active']) ? 1 : 0;
        $this->userRepository->updateUser($input, $user);
        Flash::success('User updated successfully.');

        return redirect(route('users.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  User  $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(User $user)
    {
        if ($user->id === 1) {
            return $this->sendError('Default Admin can\'t be deleted.');
        }

        $this->userRepository->deleteUser($user->id);

        return $this->sendSuccess('User deleted successfully.');
    }

    /**
     * @param int $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function activeDeactiveUserStatus($id)
    {
        $category = User::findOrFail($id);
        $category->status = ! $category->status;
        $category->save();

        return $this->sendSuccess('User updated successfully.');
    }

    /**
     * @param $id
     *
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function activeDeactiveStatus($id)
    {
        $user = User::findOrFail($id);

        if ($user->is_active == User::INACTIVE) {
            $user->update(['is_active' => User::ACTIVE]);
        } else {
            $user->update(['is_active' => User::INACTIVE]);
        }

        return $this->sendSuccess('User updated successfully.');
    }

    /**
     * @param  int  $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function isVerified($id)
    {
        $user = User::findOrFail($id);
        $user->email_verified_at = $user->email_verified_at == null ? Carbon::now() : $user->email_verified_at;
        $user->save();

        return $this->sendSuccess('User Email verified successfully.');
    }
}
