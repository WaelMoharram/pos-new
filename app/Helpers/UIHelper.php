<?php

if (!function_exists('is_active')) {
    function is_active($name)
    {
        return request()->routeIs($name) ? 'active' : '';
    }
}

if (!function_exists('show_collapsed')) {
    function show_collapsed($name)
    {
        return is_active($name) ? 'show' : '';
    }
}

if (!function_exists('area_expand')) {
    function area_expand($name)
    {
        return request()->routeIs($name) ? 'true' : '';
    }
}

if (!function_exists('has_error')) {
    function has_error($errors, $input)
    {
        if ($errors->any()) {
            return $errors->has($input) ? 'has-danger' : 'has-success';
        }
    }
}

if (!function_exists('is_invalid')) {
    function is_invalid($errors, $input)
    {
        if ($errors->any()) {
            return $errors->has($input) ? 'is-invalid' : 'is-valid';
        }
    }
}

if (!function_exists('input_error')) {
    function input_error($errors, $input)
    {
        if ($errors->has($input)) {
            echo '<label id="' . $input . '-error" class="invalid-feedback" style="display:block !important" for="' . $input . '">Error ! ' . $errors->first($input) . '</label>';
        } else {
            echo '<label id="' . $input . '-error" class="valid-feedback" for="' . $input . '">Good !</label>';
        }
    }
}

if (!function_exists('tooltip')) {
    function tooltip($title)
    {
        echo 'data-toggle="tooltip" data-placement="top" title="' . $title . '"';
    }
}

if (!function_exists('select_input_val')) {
    function select_input_val($value, $old = null, $exist = null)
    {
        if ($old) {
            echo $old == $value ? 'selected' : null;
        } else {
            echo $exist == $value ? 'selected' : null;
        }
    }
}

if (!function_exists('select_array_input_val')) {
    function select_array_input_val($value, $old = [], $exist = [])
    {
        if ($old) {
            echo in_array($value, $old) ? 'selected' : null;
        } else {
            echo in_array($value, $exist) ? 'selected' : null;
        }
    }
}

if (!function_exists('checkbox_input_val')) {
    function checkbox_input_val($value, $old = [], $exist = [])
    {
        if ($old) {
            echo in_array($value, $old) ? 'checked' : null;
        } else {
            echo in_array($value, $exist) ? 'checked' : null;
        }
    }
}


//if (!function_exists('inputVal')) {
//    function inputVal($input, $variable = null, $columnName = null)
//    {
//        $columnName ?? $columnName = $input;
//
//        if (old($input)) {
//            echo old($input);
//        } else {
//            if ($variable) echo $variable->$columnName;
//        }
//    }
//}


if (!function_exists('hidden_on_create')) {
    function hidden_on_create()
    {
        return strpos(\Request::route()->getName(), '.create') ? 'd-none' : null;
    }
}


if (!function_exists('hidden_on_show')) {
    function hidden_on_show()
    {
        return strpos(\Request::route()->getName(), '.show') ? 'd-none' : null;
    }
}


if (!function_exists('hidden_on_edit')) {
    function hidden_on_edit()
    {
        return strpos(\Request::route()->getName(), '.edit') ? 'd-none' : null;
    }
}


if (!function_exists('readonly_on_create')) {
    function readonly_on_create()
    {
        return strpos(\Request::route()->getName(), '.create') ? 'readonly' : '';
    }
}


if (!function_exists('readonly_on_show')) {
    function readonly_on_show()
    {
        return strpos(\Request::route()->getName(), '.show') ? 'readonly' : '';
    }
}


if (!function_exists('readonly_on_edit')) {
    function readonly_on_edit()
    {
        return strpos(\Request::route()->getName(), '.edit') ? 'readonly' : '';
    }
}


if (!function_exists('disable_on_create')) {
    function disable_on_create()
    {
        return strpos(\Request::route()->getName(), '.create') ? 'disabled' : '';
    }
}


if (!function_exists('disable_on_show')) {
    function disable_on_show()
    {
        return strpos(\Request::route()->getName(), '.show') ? 'disabled' : '';
    }
}


if (!function_exists('disable_on_edit')) {
    function disable_on_edit()
    {
        return strpos(\Request::route()->getName(), '.edit') ? 'disabled' : '';
    }
}
