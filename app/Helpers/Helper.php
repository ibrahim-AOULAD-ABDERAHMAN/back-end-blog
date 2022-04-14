<?php
namespace App\Helpers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
class Helper
{
    // // Constants
    const pagination        = 15;

   // Roles
    const ADMIN_ROLE        = 'Admin';
    const USER_ROLE         = 'User';


    // Functions
    // public static function isIntegrator()
    // {
    //     $user = auth::user();
    //     return $user->role->role == Helper::INTEGRATOR_ROLE;
    // }

    // public static function isAdmin()
    // {
    //     $user = auth::user();
    //     return $user->role->role == Helper::ADMIN_ROLE;
    // }

    // public static function isUser()
    // {
    //     $user = auth::user();
    //     return $user->role->role == Helper::USER_ROLE;
    // }

    public static function saveFile($image, $folder_name){
        if(isset($image) && $image->isValid()){
            $image      = $image;
            $imageName  = time() . Str::random(5) . '.' . $image->getClientOriginalExtension();
            if(!file_exists('images/'. $folder_name .'/')){
                mkdir('images/'. $folder_name .'/');
            }
            $destinationPath = public_path('images/'. $folder_name .'/');
            $image->move($destinationPath, $imageName);
            return $imageName;
        }
        return null;
    }

}
