<?php

use App\Models\Company;
use Illuminate\Support\Str;

if (!function_exists('json_response')) {
    function json_response($data = null, $message = null, $code = 200)
    {
        $array = [
            'status' => in_array($code, success_response()) ? true : false,
            'code' => $code,
            'data' => $data,
            'message' => $message,
        ];
        return response()->json($array);
    }

    function success_response()
    {
        return [
            200,   //OK. The standard success code and default option.
            201,   //Object created. Useful for the store actions.
            202,   //The request has been accepted for processing, but the processing has not been completed.
            204,   //No content. When an action was executed successfully, but there is no content to return.
            206,    //Partial content. Useful when you have to return a paginated list of resources.
        ];
    }

    /************** another http request codes **************/
    /* *
    *  400: Bad request. The standard option for requests that fail to pass validation.
    *  401: Unauthorized. The user needs to be authenticated.
    *  403: Forbidden. The user is authenticated, but does not have the permissions to perform an action.
    *  404: Not found. This will be returned automatically by Laravel when the resource is not found.
    *  405: Method Not Allowed.
    *  419: Authentication Timeout.
    *  422: Unprocessable Entity. validation failed.
    *  500: Internal server error. Ideally you're not going to be explicitly returning this, but if something unexpected breaks, this is what your user is going to receive.
    *  503: Service unavailable. Pretty self explanatory, but also another code that is not going to be returned explicitly by the application.
    * */

}

if (!function_exists('str_limit')) {
    function str_limit(string $text = null, int $limit = 70)
    {
        return !empty($text) ? Str::limit($text, $limit) : null;
    }
}

if (!function_exists('status_value')) {
    function status_value($object)
    {
        $modelClass = get_class($object);
        $statusArray = $modelClass::selectStatusList();
        return $statusArray[$object->status];
    }
}

if (!function_exists('status_trans')) {
    function status_trans($object,$value)
    {
        $modelClass = get_class($object);
        $statusArray = $modelClass::selectStatusList();
        return $statusArray[$value];
    }
}


if (!function_exists('array_to_string')) {
    function array_to_string($array)
    {
        return implode(",", $array);
    }
}

if (!function_exists('user_id')) {
    function user_id()
    {
        return \Illuminate\Support\Facades\Auth::id() ?? null;
    }
}


if (!function_exists('is_create')) {
    function is_create()
    {
        return strpos(\Request::route()->getName(), '.create') ? true : false;
    }
}


if (!function_exists('is_show')) {
    function is_show()
    {
        return strpos(\Request::route()->getName(), '.show') ? true : false;
    }
}

if (!function_exists('is_edit')) {
    function is_edit()
    {
        return strpos(\Request::route()->getName(), '.edit') ? true : false;
    }
}
//
//if (!function_exists('setting_value')) {
//    function setting_value($key)
//    {
//        $setting = \App\Models\Setting::get()->keyBy('key');
//        $value = null;
//        if (isset($setting[$key])) {
//            if (in_array($key, ['logo', 'fav_icon'])) {
//                if ($setting[$key]->value != null) {
//                    $value = asset('storage/settings/' . $setting[$key]->value);
//                } else {
//                    $value = asset('admin/img/logo.png');
//                }
//            } else {
//                $value = $setting[$key]->value;
//
//                if ($key == 'nexmo_key' && $setting[$key]->value == null) $value = 'c8cc7ddc';
//
//                if ($key == 'nexmo_api_secret' && $setting[$key]->value == null) $value = 'CX5s7KyzP6Kkpp7B ';
//
//                if ($key == 'default_message_from' && $setting[$key]->value == null) $value = 'ROQAY';
//
//                if ($key == 'default_mail_from' && $setting[$key]->value == null) $value = 'no-reply@sent.center';
//            }
//        }
//
//        return $value;
//    }
//}

function saveImage($file, $folder = '/')
{
    request()->files->remove('link');

    $fileName = time() . rand(10,99).$file->getClientOriginalName();
    $dest = public_path('/uploads/' . $folder);
    $file->move($dest, $fileName);

    $uploaded_file = 'uploads/' . $folder . '/' . $fileName;
    return $uploaded_file;
}
function checkEvenOdd($number)
{

    // One
    $one = 1;

    // Bitwise AND
    $bitwiseAnd = $number & $one;

    if($bitwiseAnd == 1)
    {
        return "Odd";
    }
    else{
        return "Even";
    }
}

function getRound($n){
return (is_int($n);
    if (is_int($n) ==1){
        return $n;
    }
    if ($n > 0){
        return floor($n);

    }else{
        return round($n);

    }
}
function getFrachtion($n){
    if ($n >0){
        $whole =  floor($n);

    }else{
        $whole =  round($n);

    }
    return  $n - $whole;
}
