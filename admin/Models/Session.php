<?php

namespace Admin\Models;

class Session
{

    private $signedIn = false;
    public $user_id;
    public $role;
    public $message;


    public static function createSession($user_id)
    {
        session_start();
        $_SESSION['user_id'] = $user_id;
    }

    public function isSignedIn()
    {
        return $this->signedIn;
    }

    public function checkLogin()
    {
        if (isset($_SESSION['user_id'])) {
            $this->user_id = $_SESSION['user_id'];
            $this->role = $_SESSION['role'];
            $this->signedIn = true;
        } else {
            unset($this->user_id);
            unset($this->role);
            $this->signedIn = false;
        }
    }

    public function login($user)
    {
        if ($user) {
            $this->user_id = $user->id;
            $_SESSION['user_id'] = $user->id;
            $this->role = $user->role;
            $_SESSION['role'] = $user->role;
            $this->signedIn = true;
        }
    }

    public function logout()
    {
        unset($_SESSION['user_id']);
        unset($_SESSION['role']);
        unset($this->user_id);
        unset($this->role);
        $this->signedIn = false;
    }

    public function message($msg = "")
    {
        if (!empty($msg)) {
            $this->message = $_SESSION['message'] = $msg;
        } else {
            return $this->message;
        }
    }

    public function checkMessage()
    {
        if (isset($_SESSION['message'])) {
            $this->message = $_SESSION['message'];
            unset($_SESSION['message']);
        } else {
            $this->message = "";
        }
    }
}
