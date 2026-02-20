<?php

namespace App\Services;

use App\Contracts\ConsentLogServiceInterface;
use App\Contracts\UserCardServiceInterface;
use App\Exceptions\CardAlreadyExistsException;
use App\Exceptions\UserNotFoundException;
use App\Models\User;
use App\Models\UserCard;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class UserCardService implements UserCardServiceInterface
{

  private $consentLogService;

    public function __construct(ConsentLogServiceInterface $consentLogService)
    {
        $this->consentLogService = $consentLogService;
    }

   public function create(int $userId, array $data): array
   {
         $userExists = User::where('id', $userId)->exists();
        if (!$userExists) throw new UserNotFoundException();

        return DB::transaction(function () use ($userId, $data) {

            $cardHash = hash('sha256', $data['card_number']);
            $cardExists = UserCard::where('card_number_hash', $cardHash)->exists();

            if($cardExists) throw new CardAlreadyExistsException();

            $consent_id1 = Str::random(30);

            $card = UserCard::create([
                'user_id' => $userId,
                'card_number' => $data['card_number'],
                'consent_id1' => $consent_id1,

            ]);

            $this->consentLogService->create($userId, 1, $card->consent_id1, true, 'created');

             return [
                'response' => true,
                'message' => 'Card created successfully.',
                'id_card' => $card->id,
            ];

        });
   }
}
