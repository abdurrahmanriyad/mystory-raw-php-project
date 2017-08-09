<?php
/**
 * Created by PhpStorm.
 * User: primez
 * Date: 8/9/17
 * Time: 1:25 PM
 */

namespace Classes\Member;




use Classes\Config\Config;
use Classes\Util\Session;

class MembershipService
{
    private $objMemberRepository;
    private $sessionName;
    private $loggedIn;

    public function __construct($user = null)
    {
        $this->objMemberRepository = new MemberRepository();
        $this->sessionName = Config::get('session/session_name');
    }
    
    public function register(Member $member)
    {
        $inserted = $this->objMemberRepository->add($member);

        if ($inserted) {
            return true;
        }

        return false;
    }


    public function login($username = null, $password = null)
    {
        $user = $this->objMemberRepository->get($username);
        if (password_verify($password, $user->password)){
            Session::set($this->sessionName, $user->id);
            return true;
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
        Session::unsetSession($this->sessionName);
    }
}