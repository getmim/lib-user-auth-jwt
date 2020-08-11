<?php
/**
 * User authorizer
 * @package lib-user-auth-jwt
 * @version 0.0.1
 */

namespace LibUserAuthJwt\Authorizer;

use LibJwt\Library\Jwt as _Jwt;
use LibEvent\Library\Event;

class Jwt implements \LibUser\Iface\Authorizer
{
    private static $session;

    private static function getJwtOpt(bool $create=true): array{
        $mim = &\Mim::$app;

        $result = [
            'iss' => $mim->config->name,
            'aud' => ['self'],
            'sub' => 'auth',
            'jti' => md5('lib-user-auth-jwt')
        ];

        if($create){
            $result['exp'] = time() + $mim->config->libUserAuthJwt->expires;
            $result['iat'] = time();
        }

        return $result;
    }

    static function getSession(): ?object{
        return self::$session;
    }

    static function identify(): ?string{
        $token = $_SERVER['HTTP_AUTHORIZATION'] ?? null;
        if(!$token)
            return null;
        $token = str_ireplace('Bearer ', '', $token);

        $result = _Jwt::decode($token, self::getJwtOpt(false));

        if(!$result)
            return null;

        self::$session = (object)[
            'type'    => 'jwt',
            'expires' => $result['exp'] - time(),
            'token'   => $token
        ];

        return $result['data']['user'];
    }

    static function loginById(string $identity): ?array{
        $opt = self::getJwtOpt();
        $opt['data'] = [
            'user' => $identity
        ];

        $token = _Jwt::encode($opt);
        if(!$token)
            return null;

        if(module_exists('lib-event'))
            Event::trigger('user:authorized', $identity);

        return [
            'type' => 'bearer',
            'expires' => $opt['exp'] - time(),
            'token' => $token
        ];
    }

    static function logout(): void{

    }
}