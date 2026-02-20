<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use App\Helpers\AesHelper;

class User extends Authenticatable
{
    use HasApiTokens;

    protected $fillable = [
        'user',
        'user_hash',
        'name',
        'phone',
        'password',
        'consent_id2',
        'consent2_status',
        'consent_id3',
        'consent3_status',
    ];

    protected $hidden = [
        'password',
        'user',
        'consent_id2',
        'consent_id3',
    ];


    public function cards()
    {
        return $this->hasMany(UserCard::class);
    }

    public function consentLogs()
    {
        return $this->hasMany(ConsentLog::class);
    }


    public function setUserAttribute($value)
    {
        $this->attributes['user'] = AesHelper::encryptData($value);
        $this->attributes['user_hash'] = hash('sha256', $value);

    }

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = AesHelper::encryptData($value);
    }

    public function setPhoneAttribute($value)
    {
        $this->attributes['phone'] = AesHelper::encryptData($value);
    }

   public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function setConsentId2Attribute($value)
    {
        $this->attributes['consent_id2'] = AesHelper::encryptData($value);
        $this->attributes['consent_id2_hash'] = hash('sha256', $value);
    }

    public function setConsentId3Attribute($value)
    {
        $this->attributes['consent_id3'] = AesHelper::encryptData($value);
        $this->attributes['consent_id3_hash'] = hash('sha256', $value);

    }


    public function getUserAttribute($value)
    {
        return AesHelper::decryptData($value);
    }

    public function getNameAttribute($value)
    {
        return AesHelper::decryptData($value);
    }

    public function getPhoneAttribute($value)
    {
        return AesHelper::decryptData($value);
    }

    public function getConsentId2Attribute($value)
    {
        return AesHelper::decryptData($value);
    }

    public function getConsentId3Attribute($value)
    {
        return AesHelper::decryptData($value);
    }

}
