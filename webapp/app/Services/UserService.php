<?php


namespace App\Services;


use App\Models\User;
use App\Repositories\UserRepository;
use GuzzleHttp\Exception\ServerException;

class UserService
{
    /** @var UserRepository */
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }


    public function get()
    {
        $users = [];

        try {
            $data = $this->userRepository->get();

            foreach($data as $item) {
                $users[] = new User($item['firstname'], $item['lastname'], $item['email']);
            }
        }
        catch(ServerException $exception) {
            session()->flash("user-status", sprintf("%d: Unable to load users", $exception->getCode()));
        }

        return $users;
    }

    public function getAsync()
    {
        return $this->userRepository->getAsync()->then(
            function($data) {
                $users = [];

                foreach($data as $item) {
                    $users[] = new User($item['firstname'], $item['lastname'], $item['email']);
                }

                return $users;
            },
            function($exception) {
                session()->flash("user-status", sprintf("%d: Unable to load users", $exception->getCode()));
                return [];
            }
        );
    }
}