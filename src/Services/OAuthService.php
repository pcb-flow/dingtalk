<?php

namespace PcbFlow\Dingtalk\Services;

class OAuthService
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
     * @param string $redirectUrl
     * @param string $state
     * @return string
     * @see https://open.dingtalk.com/document/orgapp/tutorial-obtaining-user-personal-information
     */
    public function getAuthorizationUrl($redirectUrl, $state = '')
    {
        $query = [
            'redirect_uri' => $redirectUrl,
            'response_type' => 'code',
            'client_id' => $this->client->getConfig('app_id'),
            'scope' => 'openid',
            'state' => $state,
            'prompt' => 'consent',
        ];

        return sprintf('https://login.dingtalk.com/oauth2/auth?%s', http_build_query($query));
    }
}
