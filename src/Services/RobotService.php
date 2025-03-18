<?php

namespace PcbFlow\Dingtalk\Services;

use PcbFlow\Dingtalk\Exceptions\ApiException;

class RobotService
{
    const MSG_TYPE_TEXT = 'text';
    const MSG_TYPE_LINK = 'link';
    const MSG_TYPE_MARKDOWN = 'markdown';
    const MSG_TYPE_ACTION_CARD = 'actionCard';

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
     * @param string $webhook
     * @param array $message
     * @return void
     * @throws \PcbFlow\Dingtalk\Exceptions\ApiException
     * @see https://open.dingtalk.com/document/orgapp/custom-bot-to-send-group-chat-messages
     */
    public function send($webhook, $message)
    {
        $body = $this->client->httpPost($webhook, [
            'headers' => [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ],
            'json' => $message
        ]);

        if ($body['errcode'] != 0) {
            throw new ApiException($body['errmsg'], $body['errcode']);
        }
    }

    /**
     * @param string $webhook
     * @param string $content
     * @param bool $isAtAll
     * @param array $atUserIds
     * @param array $atMobiles
     * @return void
     * @throws \PcbFlow\Dingtalk\Exceptions\ApiException
     */
    public function sendText($webhook, $content, $isAtAll = false, $atUserIds = [], $atMobiles = [])
    {
        $this->send($webhook, [
            'msgtype' => self::MSG_TYPE_TEXT,
            'text' => [
                'content' => $content,
            ],
            'at' => [
                'isAtAll' => $isAtAll,
                'atUserIds' => $atUserIds,
                'atMobiles' => $atMobiles,
            ],
        ]);
    }

    /**
     * @param string $webhook
     * @param string $title
     * @param string $text
     * @param string $messageUrl
     * @param string $picUrl
     * @param bool $isAtAll
     * @param array $atUserIds
     * @param array $atMobiles
     * @return void
     * @throws \PcbFlow\Dingtalk\Exceptions\ApiException
     */
    public function sendLink($webhook, $title, $text, $messageUrl, $picUrl = '', $isAtAll = false, $atUserIds = [], $atMobiles = [])
    {
        $this->send($webhook, [
            'msgtype' => self::MSG_TYPE_LINK,
            'link' => [
                'title' => $title,
                'text' => $text,
                'messageUrl' => $messageUrl,
                'picUrl' => $picUrl
            ],
            'at' => [
                'isAtAll' => $isAtAll,
                'atUserIds' => $atUserIds,
                'atMobiles' => $atMobiles,
            ]
        ]);
    }

    /**
     * @param string $webhook
     * @param string $title
     * @param string $text
     * @param bool $isAtAll
     * @param array $atUserIds
     * @param array $atMobiles
     * @return void
     * @throws \PcbFlow\Dingtalk\Exceptions\ApiException
     */
    public function sendMarkdown($webhook, $title, $text, $isAtAll = false, $atUserIds = [], $atMobiles = [])
    {
        $this->send($webhook, [
            'msgtype' => self::MSG_TYPE_MARKDOWN,
            'markdown' => [
                'title' => $title,
                'text' => $text
            ],
            'at' => [
                'isAtAll' => $isAtAll,
                'atUserIds' => $atUserIds,
                'atMobiles' => $atMobiles,
            ]
        ]);
    }

    /**
     * @param string $webhook
     * @param string $title
     * @param string $text
     * @param string $singleTitle
     * @param string $singleURL
     * @param bool $isAtAll
     * @param array $atUserIds
     * @param array $atMobiles
     * @return void
     * @throws \PcbFlow\Dingtalk\Exceptions\ApiException
     */
    public function sendActionCard($webhook, $title, $text, $singleTitle = '', $singleURL = '', $isAtAll = false, $atUserIds = [], $atMobiles = [])
    {
        $this->send($webhook, [
            'msgtype' => self::MSG_TYPE_ACTION_CARD,
            'actionCard' => [
                'title' => $title,
                'text' => $text,
                'singleTitle' => $singleTitle,
                'singleURL' => $singleURL
            ],
            'at' => [
                'isAtAll' => $isAtAll,
                'atUserIds' => $atUserIds,
                'atMobiles' => $atMobiles,
            ]
        ]);
    }
}
