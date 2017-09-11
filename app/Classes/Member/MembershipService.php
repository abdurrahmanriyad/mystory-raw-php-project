<?php
/**
 * Created by PhpStorm.
 * User: primez
 * Date: 8/9/17
 * Time: 1:25 PM
 */

namespace Classes\Member;

use Classes\Config\Config;
use Classes\Database\DB;
use Classes\Form\FormFile;
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
    private $objFormFile;
    private $db;

    public function __construct($user = null)
    {
        $this->objMemberRepository = new MemberRepository();
        $this->sessionName = Config::get('session/session_name');
        $this->cookieName = Config::get('remember/cookie_name');
        $this->cookiesRepository = new CookieRepository();
        $this->objFormFile =  new FormFile();
        $this->db = DB::getInstance();
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

            if ($hashCheck->count()) {
                $this->user_id = $hashCheck->first()->user_id;
                $this->login();
            }
        }
    }


    public function updateMember(Member $member, $memberId)
    {

        if ($member->new_photo_url['name']) {
            if (file_exists('../../../../user/uploads/'.$member->photo_url)) {
                unlink('../../../../user/uploads/'.$member->photo_url);
            }

            $uploaded_filename = $this->objFormFile->uploadFile($member->new_photo_url, '../../../../user/uploads/');
            $member->photo_url = $uploaded_filename;
        }

        $updated  = $this->objMemberRepository->updateMember($member, $memberId);

        if ($updated) {
            return $updated;
        }

        return false;

    }

    public function updateMemberPermission($permission, $memberId)
    {
        $updated  = $this->objMemberRepository->updateMemberPermission($permission, $memberId);
        if ($updated) {
            return $updated;
        }

        return false;
    }

    public function updateMemberActivation($active, $memberId)
    {
        $updated  = $this->objMemberRepository->updateMemberActivation($active, $memberId);
        if ($updated) {
            return $updated;
        }

        return false;
    }

    public function hasPermission($key = '', $group_id)
    {
        $group = $this->db->get('user_group', ['id', '=', $group_id])->first();
        if (count($group)) {
            $permission = json_decode($group->permissions, true);
            if ($permission[$key] == true) {
                return true;
            }
        }

        return false;
    }

}