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
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
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
     *
     * @return Application|Factory|\Illuminate\Foundation\Application|View
     */
    public function profileUpdate()
    {
        $user = getLoggedInUser();

        return view('profile.edit',compact('user'));
    }

    /**
     * @param  Request  $request
     *
     * @return JsonResponse
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
            DB::commit();

            if ($input['front_side'] === 'front-site'){
                Flash::success('Your account has been created successfully.');
                return redirect(route('login'));
            }

            Flash::success('User added successfully.');

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

        if ($input['front_side'] === 'front-site'){
            Flash::success('Your account has been updated successfully.');
            return redirect(route('front.user-profile'));
        }

        if ($input['front_side'] === 'admin-site'){
            Flash::success('Your account has been updated successfully.');
            return redirect(route('profile.edit'));
        }

        Flash::success('User updated successfully.');

        return redirect(route('users.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  User  $user
     * @return JsonResponse
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
     * @return JsonResponse
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
     * @return JsonResponse
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
     * @return JsonResponse
     */
    public function isVerified($id)
    {
        $user = User::findOrFail($id);
        $user->email_verified_at = $user->email_verified_at == null ? Carbon::now() : $user->email_verified_at;
        $user->save();

        return $this->sendSuccess('User Email verified successfully.');
    }

    public function changePassword(Request $request)
    {
        $this->validate($request, [
            'current_password' => 'required|string',
            'new_password' => 'required|confirmed|min:8|string'
        ]);
        $auth = Auth::user();

        // The passwords matches
        if (!Hash::check($request->get('current_password'), $auth->password))
        {
            return back()->with('error', "Current Password is Invalid");
        }

// Current password and new password same
        if (strcmp($request->get('current_password'), $request->new_password) == 0)
        {
            return redirect()->back()->with("error", "New Password cannot be same as your current password.");
        }

        $user =  User::find($auth->id);
        $user->password =  Hash::make($request->new_password);
        $user->save();
        return back()->with('success', "Password Changed Successfully");
    }
}
