<?php
/**
 * Created by PhpStorm.
 * User: primez
 * Date: 8/9/17
 * Time: 1:25 PM
 */

namespace Classes\Member;




class MembershipService
{

    public function register(Member $member)
    {
        $objMemberRepository = new MemberRepository();
        $inserted = $objMemberRepository->add($member);

        if ($inserted) {
            return true;
        }

        return false;
    }
}