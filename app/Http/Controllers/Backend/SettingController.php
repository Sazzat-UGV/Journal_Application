<?php

namespace App\Http\Controllers\Backend;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\MailSettingRequest;

class SettingController extends Controller
{

    public function mailSettingPage()
    {
        Gate::authorize('mail-setting');
        return view('Backend.pages.settings.mail_setting');
    }


    public function mailSetting(MailSettingRequest $request)
    {
        Gate::authorize('mail-setting');

        Setting::updateOrCreate(
            ['name'=>'mail_mailer'],
            ['value'=>$request->mail_mailer]
        );
        Setting::updateOrCreate(
            ['name'=>'mail_host'],
            ['value'=>$request->mail_host]
        );
        Setting::updateOrCreate(
            ['name'=>'mail_port'],
            ['value'=>$request->mail_port]
        );
        Setting::updateOrCreate(
            ['name'=>'mail_username'],
            ['value'=>$request->mail_username]
        );
        Setting::updateOrCreate(
            ['name'=>'mail_password'],
            ['value'=>$request->mail_password]
        );
        Setting::updateOrCreate(
            ['name'=>'mail_encryption'],
            ['value'=>$request->mail_encryption]
        );
        Setting::updateOrCreate(
            ['name'=>'mail_from_address'],
            ['value'=>$request->mail_from_address]
        );


        $this->setEnvValue('MAIL_MAILER',$request->mail_mailer);
        $this->setEnvValue('MAIL_HOST',$request->mail_host);
        $this->setEnvValue('MAIL_PORT',$request->mail_port);
        $this->setEnvValue('MAIL_USERNAME',$request->mail_username);
        $this->setEnvValue('MAIL_PASSWORD',$request->mail_password);
        $this->setEnvValue('MAIL_ENCRYPTION',$request->mail_encryption);
        $this->setEnvValue('MAIL_FROM_ADDRESS',$request->mail_from_address);
        Toastr::success('Setting Updated Successfully!!!');
        return back();
    }


    protected function setEnvValue(string $key, string $value)
    {
        $path = app()->environmentFilePath();
        $env = file_get_contents($path);

        $old_value = env($key);

        if (!str_contains($env, $key.'=')) {
            $env .= sprintf("%s=%s\n", $key, $value);
        } else if ($old_value) {
            $env = str_replace(sprintf('%s=%s', $key, $old_value), sprintf('%s=%s', $key, $value), $env);
        } else {
            $env = str_replace(sprintf('%s=', $key), sprintf('%s=%s',$key, $value), $env);
        }

        file_put_contents($path, $env);
    }
}
