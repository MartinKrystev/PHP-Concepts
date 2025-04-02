<?php

namespace Core;

class Session
{
    public static function has($key)
    {
        return (bool) static::get($key);
    }

    public static function get($key, $default = null)
    {
        return $_SESSION['_flash'][$key] ?? $_SESSION[$key] ?? $default;
    }

    public static function put($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public static function flash($key, $value)
    {
        $_SESSION['_flash'][$key] = $value;
    }

    public static function unflash()
    {
        // deletes the _flash value from the $_SESSION
        unset($_SESSION['_flash']);
    }

    public static function destroy()
    {
        static::flush();
        session_destroy();

        $params = session_get_cookie_params();
        // the name of the cookie, new value, the time (- in the past), the path to the storage, domain
        setcookie('PHPSESSID', '', time() - 3600, $params['path'], $params['domain']);
    }

    public static function flush()
    {
        $_SESSION = [];
    }
}