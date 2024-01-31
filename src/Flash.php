<?php

namespace RodCar\Portfolio;

class Flash
{
    public static function set(string $key, string $message)
    {
        $_SESSION[$key] = $message;
    }

    public static function get(string $key)
    {
        $messages = isset($_SESSION[$key]) ? $_SESSION[$key] : null;
        unset($_SESSION[$key]);

        return $messages;
    }

    public static function validation(array $errors = [], string $action = 'set')
    {
        if ($action === 'set') $_SESSION['validation'] = $errors;
        elseif ($action === 'get')
        {
            $errors = isset($_SESSION['validation']) ? $_SESSION['validation'] : null;
            unset($_SESSION['validation']);
            return $errors;
        }
    }
}