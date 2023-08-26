<?php

use App\Models\BloodBank;
use App\Models\CurrencySetting;
use App\Models\Department;
use App\Models\DoctorDepartment;
use App\Models\FrontSetting;
use App\Models\Invoice;
use App\Models\Module;
use App\Models\Notification;
use App\Models\Patient;
use App\Models\PatientAdmission;
use App\Models\PatientCase;
use App\Models\Setting;
use App\Models\Subscription;
use App\Models\SubscriptionPlan;
use App\Models\SuperAdminCurrencySetting;
use App\Models\SuperAdminSetting;
use App\Models\User;
use App\Models\VaccinatedPatients;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\DiskDoesNotExist;
use Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileDoesNotExist;
use Spatie\MediaLibrary\Exceptions\FileCannotBeAdded\FileIsTooBig;
use Stripe\Stripe;

/**
 * @return int
 */
function getLoggedInUserId()
{
    return Auth::id();
}

/**
 * @return User
 */
function getLoggedInUser()
{
    return Auth::user();
}

/**
 * @param $number
 *
 * @return string|string[]
 */
function removeCommaFromNumbers($number)
{
    return (gettype($number) == 'string' && !empty($number)) ? str_replace(',', '', $number) : $number;
}

/**
 * @param User $user
 * @param string $image
 *
 * @throws DiskDoesNotExist
 * @throws FileDoesNotExist
 * @throws FileIsTooBig
 *
 * @return mixed
 */
function storeProfileImage($user, $image)
{
    $mediaId = $user->addMedia($image)
        ->toMediaCollection(User::COLLECTION_PROFILE_PICTURES, config('app.media_disc'))->id;

    return $mediaId;
}

/**
 * @param User $user
 * @param string $image
 *
 * @throws DiskDoesNotExist
 * @throws FileDoesNotExist
 * @throws FileIsTooBig
 *
 * @return mixed
 */
function updateProfileImage($user, $image)
{
    $user->clearMediaCollection(User::COLLECTION_PROFILE_PICTURES);
    $mediaId = $user->addMedia($image)
        ->toMediaCollection(User::COLLECTION_PROFILE_PICTURES, config('app.media_disc'))->id;

    return $mediaId;
}

function getLogoUrl()
{
    static $appLogo;

    if (empty($appLogo)) {
        $appLogo = Setting::where('key', '=', 'app_logo')->first();
    }

    return $appLogo->logo_url;
}

/**
 * @return mixed
 */
function getAppName()
{
    static $appName;

    if (empty($appName)) {
        $appName = Setting::where('key', '=', 'app_name')->first()->value;
    }

    return $appName;
}

/**
 * @param array $models
 * @param string $columnName
 * @param int $id
 *
 * @return bool
 */
function canDelete($models, $columnName, $id)
{
    foreach ($models as $model) {
        $result = $model::where($columnName, $id)->exists();
        if ($result) {
            return true;
        }
    }

    return false;
}

/**
 * @param array $input
 * @param string $key
 *
 * @return string|null
 */
function preparePhoneNumber($input, $key)
{
    return (!empty($input[$key])) ? '+91'.$input[$key] : null;
}

/**
 *
 * @return array
 */
function getSettingValue()
{
    return Setting::all()->keyBy('key');
}

/**
 * @param $type
 *
 * @param $key
 *
 * @return mixed
 */
function getFrontSettingValue($type, $key)
{
    return FrontSetting::whereType($type)->where('key', $key)->value('value');
}

function setStripeApiKey($tenantId)
{
    $stripeKey = Setting::whereTenantId($tenantId)->where('key', '=', 'stripe_secret')->first();
    $stripe = Stripe::setApiKey($stripeKey->value);

    return $stripe;
}

/**
 * @param $fileName
 * @param $attachment
 *
 * @return string
 */
function getFileName($fileName, $attachment)
{
    $fileNameExtension = $attachment->getClientOriginalExtension();

    $newName = $fileName.'-'.time();

    return $newName.'.'.$fileNameExtension;
}

/**
 * @param array $data
 */
function addNotification($data)
{
    $notificationRecord = [
        'type'             => $data[0],
        'user_id'          => $data[1],
        'notification_for' => $data[2],
        'title'            => $data[3],
    ];

    if ($user = User::find($data[1])) {
        Notification::create($notificationRecord);
    }
}

/**
 * @param array $role
 *
 * @return Notification[]|Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Query\Builder[]|Collection
 */
function getNotification($role)
{
    return Notification::whereUserId(Auth::id())->whereNotificationFor(Notification::NOTIFICATION_FOR[$role])->where('read_at',
        null)->orderByDesc('created_at')->toBase()->get();
}

/**
 * @param array $data
 *
 * @return array
 */
function getAllNotificationUser($data)
{
    return array_filter($data, function ($key) {
        return $key != getLoggedInUserId();
    }, ARRAY_FILTER_USE_KEY);
}

/**
 * @param array $notificationFor
 *
 * @return string
 */
function getNotificationIcon($notificationFor)
{
    switch ($notificationFor) {
        case 1:
            return 'fas fa-calendar-check';
        case 2:
            return 'fas fa-file-invoice';
        case 3:
            return 'fa fa-rupee-sign';
        case 7:
        case 4:
            return 'fas fa-notes-medical';
        case 5:
            return 'fas fa-stethoscope';
        case 8:
        case 6:
            return 'fas fa-prescription';
        case 9:
            return 'fas fa-diagnoses';
        case 10:
            return 'fas fa-chart-pie';
        case 11:
            return 'fas fa-money-bill-wave';
        case 12:
            return 'fas fa-user-injured';
        case 13:
            return 'fa fa-briefcase-medical';
        case 14:
            return 'fa fa-users';
        case 15:
            return 'fa fa-clipboard';
        case 16:
            return 'fas fa-user-plus';
        case 17:
            return 'fas fa-ambulance';
        case 18:
            return 'fas fa-box';
        case 19:
            return 'fas fa-wallet';
        case 20:
            return 'fas fa-money-check';
        case 21:
            return 'fa fa-video';
        case 22:
            return 'fa fa-file-video';
        default:
            return 'fa fa-inbox';
    }
}

/**
 * @param $model
 *
 * @param $mediaCollection
 */
function removeFile($model, $mediaCollection)
{
    $model->clearMediaCollection($mediaCollection);
}

function redirectToDashboard(): string
{
    $user = Auth::user();
    if ($user->hasRole('Super Admin')) {
        return 'super-admin/dashboard';
    } else {
        if ($user->hasRole('Admin')) {
            return 'dashboard';
        } elseif ($user->hasRole(['Receptionist'])) {
            $module = Module::whereNotIn('name',
                Module::Receptionist)->whereIsActive(1)->whereTenantId(getLoggedInUser()->tenant_id)->first();
            if ($module) {
                return route($module->route);
            }

            return 'appointments';
        }  else {
            return 'employee/notice-board';
        }
    }
}

/**
 * @return bool
 */
function isAuth()
{
    return Auth::check() ? true : false;
}
