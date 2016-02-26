<?php

namespace MyUserBundle\Security;


use Symfony\Component\Security\Core\Encoder\BasePasswordEncoder;

class MyPasswordEncoder extends BasePasswordEncoder{

    const SALT1 = "PROTECTIONMOTDEPASSE1";
    const SALT2 = "PROTECTIONMOTDEPASSE2";
    /**
     * Encodes the raw password.
     *
     * @param string $raw The password to encode
     * @param string $salt The salt
     *
     * @return string The encoded password
     */
    public function encodePassword($raw, $salt)
    {
        $password = sha1(self::SALT1.$raw.self::SALT2);
        $hash = password_hash($password.$salt, PASSWORD_BCRYPT );
        return $hash;
    }

    /**
     * Permettra de reencoder les passwords de la "vieille" database
     * @param $raw
     * @param $salt
     * @return bool|string
     */
    public function refreshOldPassword($raw, $salt){
        $password = password_hash($raw.$salt, PASSWORD_BCRYPT);
        return $password;
    }

    /**
     * Checks a raw password against an encoded password.
     *
     * @param string $encoded An encoded password
     * @param string $raw A raw password
     * @param string $salt The salt
     *
     * @return bool true if the password is valid, false otherwise
     */
    public function isPasswordValid($encoded, $raw, $salt)
    {
        $raw = sha1(self::SALT1.$raw.self::SALT2);
        return $isValid = password_verify($raw.$salt, $encoded);
    }

}