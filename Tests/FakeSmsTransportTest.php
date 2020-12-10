<?php

namespace YieldStudio\Notifier\FakeSms\Tests;

use PHPUnit\Framework\TestCase;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Notifier\Message\MessageInterface;
use Symfony\Component\Notifier\Message\SmsMessage;
use YieldStudio\Notifier\FakeSms\FakeSmsTransport;

final class FakeSmsTransportTest extends TestCase
{
    public function testToString(): void
    {
        $transport = $this->getTransport('tech@yieldstudio.fr');

        $this->assertSame('fakesms://email?to=tech@yieldstudio.fr', (string)$transport);
    }

    public function testSupportsMessageInterface(): void
    {
        $transport = $this->getTransport('tech@yieldstudio.fr');

        $this->assertTrue($transport->supports(new SmsMessage('0612345678', 'Hi !')));
        $this->assertFalse($transport->supports($this->createMock(MessageInterface::class)));
    }

    private function getTransport(string $to): FakeSmsTransport
    {
        return new FakeSmsTransport($to, $this->createMock(MailerInterface::class));
    }
}
