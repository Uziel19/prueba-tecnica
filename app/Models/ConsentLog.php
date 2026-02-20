<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\AesHelper;

class ConsentLog extends Model
{


    protected $fillable = [
        'user_id',
        'consent_type',
        'consent_id',
        'status',
        'action_type',
        'privacy_policy_version',
        'presented_language',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function setConsentIdAttribute($value)
    {
        $this->attributes['consent_id'] = AesHelper::encryptData($value);
        $this->attributes['consent_id_hash'] = hash('sha256', $value);

    }

    public function getConsentIdAttribute($value)
    {
        return AesHelper::decryptData($value);
    }
}
