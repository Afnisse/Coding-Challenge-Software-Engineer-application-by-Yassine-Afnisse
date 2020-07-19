<?php
/**
 * User: Yassine AFNISSE
 * Email: yassine@afnisse.com
 * Date: 7/18/20
 */


use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

if (!function_exists('uploadImage')) {
    function uploadImage($path): string
    {
        $db_path = '/img/'.basename(trim($path));
        $public_path = 'public'.$db_path;

        try {
            Storage::put($public_path, File::get(trim($path)));
            return ($db_path);
        } catch (\Exception $exception) {}

        return null;
    }
}
