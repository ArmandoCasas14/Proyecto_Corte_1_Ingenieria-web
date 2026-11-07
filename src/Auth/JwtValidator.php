<?php

namespace App\Auth;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use RuntimeException;

class JwtValidator
{
    public static function validate(string $token): object
    {
        $config = require dirname(__DIR__, 2) . '/config/jwt.php';

        if (empty($config['secret'])) {
            throw new RuntimeException('JWT_SECRET no está configurado.');
        }

        return JWT::decode(
            $token,
            new Key($config['secret'], $config['algo'])
        );
    }
}
