<?php

namespace App\Repositories;

use App\Models\Setting;
use Arr;
use Carbon\Carbon;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;

class SettingRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'app_name',
        'app_logo',
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
        return Setting::class;
    }

    public function getSyncList()
    {
        return Setting::pluck('value', 'key')->toArray();
    }

    /**
     * @param $input
     * @return void
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function updateSetting($input)
    {
        if (isset($input['app_logo']) && !empty($input['app_logo'])) {
            /** @var Setting $setting */
            $setting = Setting::where('key', '=', 'app_logo')->first();
            $setting->clearMediaCollection(Setting::PATH);
            $setting->addMedia($input['app_logo'])->toMediaCollection(Setting::PATH, config('app.media_disc'));
            $setting = $setting->refresh();
            $setting->update(['value' => $setting->logo_url]);
        }

        $settingInputArray = Arr::only($input, [
            'app_name', 'email', 'phone', 'address', 'city', 'state', 'country'
        ]);
        foreach ($settingInputArray as $key => $value) {
            Setting::where('key', '=', $key)->first()->update(['value' => $value]);
        }
    }
}
