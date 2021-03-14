<?php

use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Crypt;
use Hashids\Hashids;
use App\Label;

function sendSuccess($message, $data = '') {
    return Response::json(array('status' => 200, 'successMessage' => $message, 'successData' => $data), 200, [], JSON_NUMERIC_CHECK);
}

function sendError($error_message, $code = '') {
    return Response::json(array('status' => 400, 'errorMessage' => $error_message), 400);
}

function addFile($file, $path) {
    if ($file) {
        if ($file->getClientOriginalExtension() != 'exe') {
            $type = $file->getClientMimeType();
            if ($type == 'image/jpg' || $type == 'image/jpeg' || $type == 'image/png' || $type == 'image/bmp') {
//                $destination_path = 'public/images/' . $path; 
                $destination_path = $path;
                $extension = $file->getClientOriginalExtension();
                $fileName = 'image_' . Str::random(15) . '.' . $extension;
                $file->move('public/'.$destination_path, $fileName);
                $file_path = $destination_path . $fileName;
                return $file_path;
            } else {
                return FALSE;
            }
        } else {
            return FALSE;
        }
    } else {
        return FALSE;
    }
}

function claimedContentsCount() {
    return Label::where(['user_id' => Auth::user()->id])->count();
}

function encodeId($id) {
    $hashids = new Hashids();
    return $hashids->encode($id);
}

function decodeId($id) {
    $hashids = new Hashids();
    return $hashids->decode($id);
}

function image_fix_orientation($filename) {
    $exif = @exif_read_data($filename);
    if (!empty($exif['Orientation'])) {
        $image = imagecreatefromjpeg($filename);
        
        switch ($exif['Orientation']) {
            case 3:
                $image = imagerotate($image, 180, 0);
                break;
            case 6:
                $image = imagerotate($image, -90, 0);
                break;
            case 8:
                $image = imagerotate($image, 90, 0);
                break;
        }
        imagejpeg($image, $filename, 90);
    }
    return $filename;
}