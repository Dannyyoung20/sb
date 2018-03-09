<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\Resource;

class UserResoruce extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'firstname' => $this->firstname,
            'lastname' => $this->lastname,
            'phone' => $this->phone,
            'email' => $this->email,
            'role'  => $this->userRole($request->role_id)
        ];
    }

    protected function userRole(Request $request) {
        if($this->role_id == 1)
            { 
                return 'User'; 
            }
        elseif($this->role_id == 2) 
            { 
                return 'Tutor';
            }
        else{
            return 'Admin';
            }
    
    }
}
