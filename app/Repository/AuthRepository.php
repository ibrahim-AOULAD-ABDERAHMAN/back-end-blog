<?php

namespace App\Repository;

use App\Helpers\Helper;
use App\Repository\RepositoryInterface;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthRepository
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function register($data)
    {
        $user               = new User();
        $user->email        = $data['email'];
        $user->phone_number = $data['phone_number'];
        $user->is_active    = 1;
        $user->id_role      = 3;
        $user->password     = Hash::make($data['confirm_password']);
        $user->save();

        $token = $user->createToken($data['phone_number'])->plainTextToken;
        return [
            'first_name'   => $user->first_name,
            'last_name'    => $user->last_name,
            'image'        => $user->image,
            'email'        => $user->email,
            'phone_number' => $user->phone_number,
            'id_role'      => $user->id_role,
            'role'         => $user->role->role ?? null,
            'token'        => $token
            ];
    }

    public function login($data){

        $user = $this->user->where('email', $data['email'])->first();
        if(!$user || !Hash::check($data['password'], $user->password)){
            return false;
        }
        $user->tokens()->delete();
        $token = $user->createToken($data['email'])->plainTextToken;
        return [
                'first_name'   => $user->first_name,
                'last_name'    => $user->last_name,
                'email'        => $user->email,
                'id_role'      => $user->id_role,
                'role'         => $user->role->role ?? null,
                'token'        => $token
                ];
    }
}
