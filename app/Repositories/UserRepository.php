<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

/**
 * Class UserRepository
 * @version January 11, 2020, 11:09 am UTC
 */
class UserRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'email',
        'phone',
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return User::class;
    }

    /**
     * @param  array  $input
     *
     * @return bool
     */
    public function profileUpdate($input)
    {
        /** @var User $user */
        $user = $this->find(Auth::id());
        try {
            if (isset($input['image']) && !empty($input['image'])) {
                $mediaId = updateProfileImage($user, $input['image']);
            }
            if (empty($input['image']) && $input['avatar_remove'] == 1 && isset($input['avatar_remove']) && !empty($input['avatar_remove'])) {
                removeFile($user, User::COLLECTION_PROFILE_PICTURES);
            }

            $user->update($input);

            return true;
        } catch (Exception $e) {
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }

    /**
     * @param  array  $input
     *
     * @return bool
     */
    public function changePassword($input)
    {
        try {
            /** @var User $user */
            $user = Auth::user();
            if (! Hash::check($input['password_current'], $user->password)) {
                throw new UnprocessableEntityHttpException('Current password is invalid.');
            }
            $input['password'] = Hash::make($input['password']);
            $user->update($input);

            return true;
        } catch (Exception $e) {
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }

    /**
     * @param $input
     *
     * @return bool
     */
    public function store($input)
    {
        try {
            $input['password'] = Hash::make($input['password']);
            $input['category_id'] = ($input['role'] === 'Provider') ? $input['category_id'] : null;
            $input['old_price'] = ($input['role'] === 'Provider') ? $input['old_price'] : null;
            $input['new_price'] = ($input['role'] === 'Provider') ? $input['new_price'] : null;
            $input['work_description'] = ($input['role'] === 'Provider') ? $input['work_description'] : null;

            $user = User::create($input);

            if (isset($input['image']) && ! empty($input['image'])) {
                $fileExtension = getFileName('User', $input['image']);
                $user->addMedia($input['image'])->usingFileName($fileExtension)->toMediaCollection(User::COLLECTION_PROFILE_PICTURES,
                    config('app.media_disc'));
            }
            
//            $user->sendEmailVerificationNotification();
;
        } catch (Exception $e) {
            throw new UnprocessableEntityHttpException($e->getMessage());
        }

        return true;
    }

    /**
     * @param $input
     * @param $userId
     *
     * @return bool
     */
    public function updateUser($input, $user)
    {
        try {
            /**
             * @var User $user
             */
            $input['category_id'] = ($input['role'] === 'Provider') ? $input['category_id'] : null;
            $input['old_price'] = ($input['role'] === 'Provider') ? $input['old_price'] : null;
            $input['new_price'] = ($input['role'] === 'Provider') ? $input['new_price'] : null;
            $input['work_description'] = ($input['role'] === 'Provider') ? $input['work_description'] : null;

            $user = $this->update($input, $user->id);
            if (isset($input['image']) && !empty($input['image'])) {
                $user->clearMediaCollection(User::COLLECTION_PROFILE_PICTURES);
                $fileExtension = getFileName('User', $input['image']);
                $user->addMedia($input['image'])->usingFileName($fileExtension)->toMediaCollection(User::COLLECTION_PROFILE_PICTURES,
                    config('app.media_disc'));
            }

            return true;
        } catch (Exception $e) {
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }

    /**
     * @param $userId
     **/
    public function deleteUser($userId)
    {
        try {
            /**
             * @var User $user
             */
            $user = $this->find($userId);
            $user->clearMediaCollection(User::COLLECTION_PROFILE_PICTURES);
            $this->delete($userId);
        } catch (Exception $e) {
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }
}
