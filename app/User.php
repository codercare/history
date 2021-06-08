<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Carbon\Carbon;

class User extends Authenticatable
{
    use Notifiable,HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email','mobile','username','password','statuss'
    ];
    
    protected $appends=['published'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

   
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function scopeOfSearch($query, $q ='')
    {
        if ( $q ) {
            $query->orWhere('name', 'LIKE', '%' . $q . '%')
                    ->orWhere('email', 'LIKE', '%' . $q . '%')
                    ->orWhere('created_at', 'LIKE', '%' . $q . '%');
        }

        return $query;
    }
    
    public function getPublishedAttribute(){
        
        return Carbon::createFromTimeStamp(strtotime($this->attributes['created_at']) )->diffForHumans();
    }


    public function scopeOfIDSearch($query, $q)
    {
        if ( $q ) {
            $query->orWhere('id','=',$q);
        }
        return $query;
    }

    public function scopeOfNameSearch($query, $q)
    {
        if ( $q ) {
            $query->orWhere('name', 'LIKE', '%' . $q . '%');
        }
        return $query;
    }
    public function scopeOfEmailSearch($query, $q)
    {
        if ( $q ) {
            $query->orWhere('email', 'LIKE', '%' . $q . '%');
        }
        return $query;
    }
    public function scopeOfMobileSearch($query, $q)
    {
        if ( $q ) {
            $query->orWhere('mobile', '=',$q);
        }
        return $query;
    }
    

    public function scopeOfSort($query, $sort = [])
    {
        if ( ! empty($sort) ) {
            foreach ( $sort as $column => $direction ) {
                $query->orderBy($column, $direction);
            }
        } 
        else {
            $query->orderBy('created_at','desc'); 
        }

        return $query;
    }

    public function socialProviders(){
        return $this->hasMany(SocialProvider::class);
    }


}
