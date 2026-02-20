<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\AesHelper;

class UserCard extends Model
{


    protected $fillable = [
        'user_id',
        'consent_id1',
        'card_number'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function setConsentId1Attribute($value)
    {
        $this->attributes['consent_id1'] = AesHelper::encryptData($value);
        $this->attributes['consent_id1_hash'] = hash('sha256', $value);

    }

     public function setCardNumberAttribute($value)
    {
        $this->attributes['card_number'] = AesHelper::encryptData($value);
        $this->attributes['card_number_hash'] = hash('sha256', $value);


    }

    public function getConsentId1Attribute($value)
    {
        return AesHelper::decryptData($value);
    }
    public function getCardNumberAttribute($value)
    {
        return AesHelper::decryptData($value);
    }

}
