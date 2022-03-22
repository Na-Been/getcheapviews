<?php

use App\Models\Setting;

function modeSelector()
{
    try {
        $setting = Setting::first();
        if ($setting == null) {
            return 0;
        } else {
            return $setting->mode_status;
        }
    } catch (Exception $exception) {
        return with('failed','Cannot Change The Mode Please Add Setting First');
    }
}

function createOrUpdateImage($request)
{

    return $request->image->store('public/images');


}


?>
