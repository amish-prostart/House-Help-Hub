<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateSettingRequest;
use App\Repositories\SettingRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Laracasts\Flash\Flash;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;

class SettingController extends AppBaseController
{
    /** @var SettingRepository */
    private $settingRepository;

    public function __construct(SettingRepository $settingRepo)
    {
        $this->settingRepository = $settingRepo;
    }

    /**
     * Show the form for editing the specified Setting.
     *
     * @param  Request  $request
     *
     * @return Application|Factory|View|\Illuminate\Foundation\Application
     */
    public function edit(Request $request)
    {
        $settings = $this->settingRepository->getSyncList();

        return view('settings.index', compact('settings'));
    }

    /**
     * @param UpdateSettingRequest $request
     * @return Application|\Illuminate\Foundation\Application|RedirectResponse|Redirector
     * @throws FileDoesNotExist
     * @throws FileIsTooBig
     */
    public function update(UpdateSettingRequest $request)
    {
        $this->settingRepository->updateSetting($request->all());

        Flash::success('Settings updated successfully.');

        return redirect(route('settings.edit'));
    }
}
