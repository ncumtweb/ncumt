<?php

namespace App\Logging;

use Monolog\Logger;
use Monolog\Handler\AbstractProcessingHandler;

class DiscordLogger
{
    public function __invoke(array $config)
    {
        $webhookUrl = $config['webhook_url'];

        $logger = new Logger('discord');
        $logger->pushHandler(new DiscordHandler($webhookUrl));

        return $logger;
    }
}

class DiscordHandler extends AbstractProcessingHandler
{
    private $webhookUrl;

    public function __construct($webhookUrl, $level = Logger::ERROR, bool $bubble = true)
    {
        parent::__construct($level, $bubble);
        $this->webhookUrl = $webhookUrl;
    }

    protected function write(array $record): void
    {
        if (empty($this->webhookUrl)) {
            return;
        }

        $message = "**Error: **". $record['message'];

        // 提取上下文中的信息
        $context = $record['context'];
        $file = $context['file'] ?? 'Unknown file';
        $line = $context['line'] ?? 'Unknown line';
        $code = $context['code'] ?? 'Unknown code';
        $prev = $context['prev'] ?? 'Unknown previous';

        $message .= sprintf(
            "\n**File:** %s\n**Line:** %d\n**Code:** %d\n**Previous:** %d\n\n",
            $file,
            $line,
            $code,
            $prev
        );

        // 準備發送的 Discord 消息
        $payload = [
            'content' => $message,
        ];

        // 發送 HTTP 請求到 Discord
        $client = new \GuzzleHttp\Client();
        $client->post($this->webhookUrl, [
            'json' => $payload,
        ]);
    }
}
