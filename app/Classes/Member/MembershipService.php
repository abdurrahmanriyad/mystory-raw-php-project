<?php
/**
 * Created by PhpStorm.
 * User: primez
 * Date: 8/9/17
 * Time: 1:25 PM
 */

namespace Classes\Member;

use Classes\Config\Config;
use Classes\Util\Cookie;
use Classes\Util\CookieRepository;
use Classes\Util\Hash;
use Classes\Util\Session;

class MembershipService
{
    private $objMemberRepository;
    private $sessionName;
    private $cookieName;
    private $loggedIn;
    private $cookiesRepository;
    private $user_id;

    public function __construct($user = null)
    {
        $this->objMemberRepository = new MemberRepository();
        $this->sessionName = Config::get('session/session_name');
        $this->cookieName = Config::get('remember/cookie_name');
        $this->cookiesRepository = new CookieRepository();
    }
    
    public function register(Member $member)
    {
        $inserted = $this->objMemberRepository->add($member);

        if ($inserted) {
            return true;
        }

        return false;
    }


    public function login($username = null, $password = null, $remember = false)
    {
        if (!$username && !$password && !$this->isLoggedIn()) {
            Session::set($this->sessionName, $this->user_id);

        } else {
            $user = $this->objMemberRepository->get($username);
            if ($user) {
                if (password_verify($password, $user->password)){
                    Session::set($this->sessionName, $user->id);

                    if ($remember) {
                        $hash = Hash::unique();
                        $hashCheck = $this->cookiesRepository->get('users_session', ['user_id', '=', $user->id]);

                        if (!$hashCheck->count()) {
                            $this->cookiesRepository->add('users_session', [
                                'user_id' => $user->id,
                                'hash' => $hash
                            ]);
                        } else {
                            $hash =  $hashCheck->first()->hash;
                        }

                        Cookie::set($this->cookieName, $hash, Config::get('remember/cookie_expiry'));
                    }

                    return true;
                }
            }
        }

        return false;
    }


    public function isLoggedIn()
    {
        if (Session::exists($this->sessionName)) {
            $user = Session::get($this->sessionName);
            if ($this->objMemberRepository->get($user)) {
                $this->loggedIn = true;
            }
        } else {
            $this->loggedIn = false;
        }

        return $this->loggedIn;
    }

    public function logout()
    {
        $this->cookiesRepository->delete('users_session', ['user_id', '=', Session::get($this->sessionName)]);

        Session::unsetSession($this->sessionName);
        Cookie::delete($this->cookieName);

    }


    public function checkIfRemembered()
    {
        if (Cookie::exists(Config::get('remember/cookie_name')) && !Session::exists(Config::get('session/session_name'))) {
            $hash = Cookie::get(Config::get('remember/cookie_name'));
            $hashCheck = $this->cookiesRepository->get('users_session', ['hash', '=', $hash]);
            $this->user_id = $hashCheck->first()->user_id;

            if ($hashCheck->count()) {
                $this->login();
            }
        }
    }
}