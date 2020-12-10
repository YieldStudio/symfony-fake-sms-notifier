<?php

namespace YieldStudio\Notifier\FakeSms\Tests;

use PHPUnit\Framework\TestCase;
use Symfony\Component\Notifier\Exception\IncompleteDsnException;
use Symfony\Component\Notifier\Exception\UnsupportedSchemeException;
use Symfony\Component\Notifier\Transport\Dsn;
use YieldStudio\Notifier\FakeSms\FakeSmsTransportFactory;

final class FakeSmsTransportFactoryTest extends TestCase
{
    public function testCreateWithDsn(): void
    {
        $factory = $this->initFactory();

        $dsn = 'fakesms://email?to=tech@yieldstudio.fr&from=sender@localhost.dev';
        $transport = $factory->create(Dsn::fromString($dsn));

        $this->assertSame('fakesms://email?to=tech@yieldstudio.fr&from=sender@localhost.dev', (string) $transport);
    }

    public function testCreateWithNoRecipientThrowsMalformed(): void
    {
        $factory = $this->initFactory();

        $this->expectException(IncompleteDsnException::class);

        $dsnIncomplete = 'fakesms://email';
        $factory->create(Dsn::fromString($dsnIncomplete));
    }

    public function testSupportsFakeSmsScheme(): void
    {
        $factory = $this->initFactory();

        $dsn = 'fakesms://email?to=tech@yieldstudio.fr&from=sender@localhost.dev';
        $dsnUnsupported = 'foobar://email?to=tech@yieldstudio.fr&from=sender@localhost.dev';

        $this->assertTrue($factory->supports(Dsn::fromString($dsn)));
        $this->assertFalse($factory->supports(Dsn::fromString($dsnUnsupported)));
    }

    public function testNonFakeSmsSchemeThrows(): void
    {
        $factory = $this->initFactory();

        $this->expectException(UnsupportedSchemeException::class);

        $dsnUnsupported = 'foobar://email?to=tech@yieldstudio.fr&from=sender@localhost.dev';
        $factory->create(Dsn::fromString($dsnUnsupported));
    }

    private function initFactory(): FakeSmsTransportFactory
    {
        return new FakeSmsTransportFactory();
    }
}
