<?php

namespace PcbFlow\Dingtalk\Services;

use PcbFlow\Dingtalk\Exceptions\ApiException;

class UserService
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
     * @param string $userid
     * @return array
     * @throws \PcbFlow\Dingtalk\Exceptions\ApiException
     * @see https://open.dingtalk.com/document/orgapp/query-user-details
     */
    public function getUserById($userid)
    {
        $body = $this->client->httpPost('https://oapi.dingtalk.com/topapi/v2/user/get', [
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ],
            'query' => [
                'access_token' => $this->client->ensureAccessToken(),
            ],
            'json' => [
                'userid' => $userid,
                'language' => 'zh_CN',
            ]
        ]);

        if ($body['errcode'] != 0) {
            throw new ApiException($body['errmsg'], $body['errcode']);
        }

        return $body['result'];
    }

    /**
     * @param string $phone
     * @return array
     * @throws \PcbFlow\Dingtalk\Exceptions\ApiException
     * @see https://open.dingtalk.com/document/orgapp/query-users-by-phone-number
     */
    public function getUserByPhone($phone)
    {
        $body = $this->client->httpPost('https://oapi.dingtalk.com/topapi/v2/user/getbymobile', [
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ],
            'query' => [
                'access_token' => $this->client->ensureAccessToken(),
            ],
            'json' => [
                'mobile' => $phone,
            ]
        ]);

        if ($body['errcode'] != 0) {
            throw new ApiException($body['errmsg'], $body['errcode']);
        }

        return $body['result'];
    }

    /**
     * @param string $unionid
     * @return array
     * @throws \PcbFlow\Dingtalk\Exceptions\ApiException
     * @see https://open.dingtalk.com/document/orgapp/query-a-user-by-the-union-id
     */
    public function getUserByUnionid($unionid)
    {
        $body = $this->client->httpPost('https://oapi.dingtalk.com/topapi/user/getbyunionid', [
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ],
            'query' => [
                'access_token' => $this->client->ensureAccessToken(),
            ],
            'json' => [
                'unionid' => $unionid,
            ]
        ]);

        if ($body['errcode'] != 0) {
            throw new ApiException($body['errmsg'], $body['errcode']);
        }

        return $body['result'];
    }
}
