<?php
/**
 * Created by PhpStorm.
 * User: leon
 * Date: 25/05/2017
 * Time: 13:44
 */

namespace Wix\Mediaplatform\Authentication;


use Firebase\JWT\JWT;
use InvalidArgumentException;
use Wix\Mediaplatform\Configuration\Configuration;

/**
 * Class Authenticator
 * @package Wix\Mediaplatform\Authentication
 */
class Authenticator
{

    /**
     * @var Configuration
     */
    private $configuration;

    /**
     * @param configuration The Media Platform configuration
     */
    public function __construct(Configuration $configuration)
    {
        $this->configuration = $configuration;
    }

    /**
     * @return The authorization header
     */
    public function getHeader($token = null)
    {
        if (!$token) {
            $token = new Token();
            $token->setIssuer(NS::APPLICATION . $this->configuration->getAppId());
            $token->setSubject(NS::APPLICATION . $this->configuration->getAppId());

        }

        return $this->encode($token);
    }

    /**
     * @param Token $token
     * @return mixed
     */
    public function encode(Token $token)
    {
        return JWT::encode($token->toClaims(), $this->configuration->getSharedSecret());
    }

    /**
     * @param $token
     * @return Token
     */
    public function decode($token)
    {
        try {
            return new Token(JWT::decode($token, $this->configuration->getSharedSecret()));
        } catch (InvalidArgumentException $e) {
            throw new InvalidArgumentException("invalid token", $e);
        }
    }
}