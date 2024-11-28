<?php

namespace App\Services;

use App\Models\Language;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class LanguageService
{
    // For Translation
    public function trans($val)
    {
        //$lang = Language::where('app', 'WEB')->where('key', $val)->first();

        $response = Http::get(
            env('SERVER_PC') . 'get_langs',
            [
                'key' => $val,
            ]
        );

        $object = json_decode($response->body());

        if ($object && $object->success == true) {
            $lang = null;
            if (!empty($object->data->languages[0])) $lang = $object->data->languages[0];
            if ($lang) {
                switch (session()->get('locale')) {
                    case 'fr':
                        $val = $lang->fr;
                        break;
                    case 'en':
                        $val = $lang->en;
                        break;
                    default:
                        $val = $lang->fr;
                        break;
                }
            }
        }

        return $val;
    }
}
