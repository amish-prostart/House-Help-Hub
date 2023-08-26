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

function getPhone()
{
    static $phone;

    if (empty($phone)) {
        $phone = Setting::where('key', '=', 'phone')->first()->value;
    }

    return '+91 '. $phone;
}

function getEmail()
{
    static $getEmail;

    if (empty($getEmail)) {
        $getEmail = Setting::where('key', '=', 'email')->first()->value;
    }

    return $getEmail;
}

function getAddress()
{
    static $getAddress;

    if (empty($getAddress)) {
        $getAddress = Setting::where('key', '=', 'address')->first()->value;
    }

    return $getAddress;
}

function getCity()
{
    static $getCity;

    if (empty($getCity)) {
        $getCity = Setting::where('key', '=', 'city')->first()->value;
    }

    return $getCity;
}

function getState()
{
    static $getState;

    if (empty($getState)) {
        $getState = Setting::where('key', '=', 'state')->first()->value;
    }

    return $getState;
}

function getCountry()
{
    static $getCountry;

    if (empty($getCountry)) {
        $getCountry = Setting::where('key', '=', 'country')->first()->value;
    }

    return $getCountry;
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

    if ($user->role === 'Admin') {
        return 'admin/dashboard';
    }
    else {
        return '/';
    }
}

/**
 * @return bool
 */
function isAuth()
{
    return Auth::check() ? true : false;
}
