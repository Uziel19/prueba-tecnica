<?php

namespace App\Services;

use App\Contracts\ConsentLogServiceInterface;
use App\Models\ConsentLog;

class ConsentLogService implements ConsentLogServiceInterface
{

    public function create(int $userId, int $type, string $consentId, bool $status, string $action): void
    {
        ConsentLog::create([
            'user_id' => $userId,
            'consent_type' => $type, // 2 = cuenta2, 3 = cuenta3
            'consent_id' => $consentId,
            'status' => $status,
            'action_type' => $action, // created / updated
            'privacy_policy_version' => 'v1.0',
            'presented_language' => 'ES',
        ]);
    }
}
