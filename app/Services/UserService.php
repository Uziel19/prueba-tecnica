<?php

namespace App\Services;

use App\Contracts\ConsentLogServiceInterface;
use App\Contracts\UserServiceInterface;
use App\Exceptions\InvalidCredentialsException;
use App\Exceptions\UserAlreadyExistsException;
use App\Exceptions\UserDeletionNotAllowedException;
use App\Exceptions\UserNotFoundException;
use App\Models\User;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class UserService implements UserServiceInterface
{

    private $consentLogService;

    public function __construct(ConsentLogServiceInterface $consentLogService)
    {
        $this->consentLogService = $consentLogService;
    }



    public function getToken(string $user, string $password): array
    {

        $user = User::where('user_hash', hash('sha256', $user))
            ->select('id', 'password')
            ->first();

        if ((!$user) || !(password_verify($password, $user->password))) throw new InvalidCredentialsException();

        $token = $user->createToken('api-token', ['*'], now()->addMinutes(5))->plainTextToken;

        return [
            'token' => $token,
            'date_finish' => now()->addMinutes(5)->toDateTimeString()
        ];
    }

    public function create(array $data): array
    {
        if ($this->userExists($data['user'])) throw new UserAlreadyExistsException();

        return DB::transaction(function () use ($data) {

            $consent_id2 = Str::random(30);
            $consent_id3 = Str::random(30);

            $user = User::create([
                'user' => $data['user'],
                'name' => $data['name'],
                'phone' => $data['phone'],
                'password' => $data['password'],
                'consent_id2' =>  $consent_id2,
                'consent2_status' => $data['consent2_status'],
                'consent_id3' =>   $consent_id3,
                'consent3_status' => $data['consent3_status'],
            ]);

            $this->consentLogService->create($user->id, 2, $user->consent_id2, $user->consent2_status, 'created');
            $this->consentLogService->create($user->id, 3, $user->consent_id3, $user->consent3_status, 'created');

            return [
                'response' => true,
                'message' => 'User created successfully.',
                'id_user' => $user->id,
            ];
        });
    }

    public function update(int $id, array $data): array
    {
        return DB::transaction(function () use ($id, $data) {

            $user = $this->getUser($id);

            if (isset($data['user']) && $user->user != $data['user']) {

                if ($this->userExists($data['user'])) throw new UserAlreadyExistsException();
                $user->user = $data['user'];
            }

            if (isset($data['name'])) $user->name = $data['name'];
            if (isset($data['phone'])) $user->phone = $data['phone'];
            if (isset($data['password'])) $user->password = $data['password'];

            if (isset($data['consent2_status']) && ($data['consent2_status'] != $user->consent2_status)) {
                $consent_id2 = Str::random(30);
                $user->consent_id2 = $consent_id2;
                $user->consent2_status = $data['consent2_status'];
                $this->consentLogService->create($id, 2, $user->consent_id2, $user->consent2_status, 'updated');
            }

            if (isset($data['consent3_status']) && ($data['consent3_status'] != $user->consent3_status)) {
                $consent_id3 = Str::random(30);
                $user->consent_id3 = $consent_id3;
                $user->consent3_status = $data['consent3_status'];
                $this->consentLogService->create($id, 3, $user->consent_id3, $user->consent3_status, 'updated');
            }

            $user->save();

            return [
                'response' => true,
                'message' => 'User updated successfully.',
            ];
        });
    }

    public function delete(int $id): array
    {
        $user = $this->getUser($id);

        if ($user->user == 'testuser') throw new UserDeletionNotAllowedException();

        $user->delete();

        return [
            'response' => true,
            'message' => 'User deleted successfully.',
        ];
    }



    private function userExists(string $user): bool
    {
        $userHash = hash('sha256', $user);
        return User::where('user_hash', $userHash)->exists();
    }

    private function getUser(int $id): User
    {
        $user = User::find($id);
        if (!$user) throw new UserNotFoundException();
        return $user;
    }
}
