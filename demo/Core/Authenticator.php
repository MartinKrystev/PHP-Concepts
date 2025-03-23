<?php

namespace Core;

class Authenticator
{
    public function attempt($email, $password)
    {
        // match the credentials
        $user = App::resolve(Database::class)->query('SELECT * FROM users WHERE email = :email', [
            'email' => $email
        ])->find();

        if ($user) {

            if (password_verify($password, $user['password'])) {
                $this->login([
                    'email' => $email
                ]);
                // verify the hashed password -> correct
                return true;
            }
        }
        // verify the hashed password -> incorrect
        return false;
    }

    public function login($user)
    {
        $_SESSION['user'] = [
            'email' => $user['email']
        ];

        session_regenerate_id(true);
    }

    public static function logout()
    {
        Session::destroy();
    }
}