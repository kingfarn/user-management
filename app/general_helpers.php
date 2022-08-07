
<?php

if (!function_exists('access_only_admin')) {
    function access_only_admin()
    {
        if (!auth()->user()->hasRole('Super Admin')) {
            abort(403, 'Unauthorized action.');
        }
    }
}

if (!function_exists('check_user_permission')) {
    function check_user_permission($per)
    {
        if (!auth()->user()->can($per)) {
            abort(403, 'Unauthorized action.');
        }
    }
}

if (!function_exists('is_user_admin')) {
    function is_user_admin()
    {
        return auth()->user()->hasRole('admin');
    }
}



if (!function_exists('user_can')) {
    function user_can($per)
    {
        return auth()->user()->can($per);
    }
}
