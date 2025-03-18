<?php

namespace PcbFlow\Dingtalk\Services;

class UserProfileService
{
    /**
     * @var \PcbFlow\Dingtalk\Client
     */
    protected $client;

    /**
     * @param \PcbFlow\Dingtalk\Client $client
     */
    public function __construct($client)
    {
        $this->client = $client;
    }

    /**
     * @param string $userAccessToken
     * @param string $unionid
     * @return array
     * @see https://open.dingtalk.com/document/orgapp/dingtalk-retrieve-user-information
     */
    public function getUserProfile($userAccessToken, $unionid = 'me')
    {
        return $this->client->httpGet("https://api.dingtalk.com/v1.0/contact/users/{$unionid}", [
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'x-acs-dingtalk-access-token' => $userAccessToken,
            ]
        ]);
    }
}
