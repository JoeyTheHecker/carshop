<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    const PENDING = 0;
    const APPROVED = 1;

    public function countBidder($status){

        if($status == 0){
            $result = self::where('customer_status', (int)$status)->count();
        }else{
            $result = self::where('customer_status', (int)$status)->count();
        }

        if($result){
            return $result;
        }

        return 0;
    }

    public function isStatusBidder()
    {
        if($this->customer_status == self::PENDING){
            return 'Pending';
        }elseif($this->customer_status == self::APPROVED){
            return 'Approved';
        }else{
            return 'None';
        }
    }

}
