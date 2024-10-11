<?php
namespace Youssef\ScandiwebTask\Classes;
class Session
{
    // Start
    public function __construct()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start(); // Start the session only if it's not already active
        }
    }
    // Set
    public static function set($data, $value)
    {
        $_SESSION[$data] = $value;
    }
    // Get
    public static function get($data)
    {
        return isset($_SESSION[$data]) ? $_SESSION[$data] : null;
    }
    // Unset
    public function remove($key)
    {
        unset($_SESSION[$key]);
    }
    // Destroy
    public function destroy()
    {
        session_destroy();
    }
}