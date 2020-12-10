<?php

namespace YieldStudio\Notifier\FakeSms;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Notifier\Exception\IncompleteDsnException;
use Symfony\Component\Notifier\Exception\UnsupportedSchemeException;
use Symfony\Component\Notifier\Transport\AbstractTransportFactory;
use Symfony\Component\Notifier\Transport\Dsn;
use Symfony\Component\Notifier\Transport\TransportInterface;

/**
 * @author James Hemery <james@yieldstudio.fr>
 */
final class FakeSmsTransportFactory extends AbstractTransportFactory
{

    protected ?MailerInterface $mailer;

    public function __construct(MailerInterface $mailer = null)
    {
        $this->mailer = $mailer;
        parent::__construct();
    }

    /**
     * @param Dsn $dsn
     * @return FakeSmsTransport
     */
    public function create(Dsn $dsn): TransportInterface
    {
        $scheme = $dsn->getScheme();
        $to = $dsn->getOption('to');
        $host = $dsn->getHost();

        if (!$to) {
            throw new IncompleteDsnException('Missing to.', $dsn->getOriginalDsn());
        }

        if ('fakesms' === $scheme) {
            return (new FakeSmsTransport($to, $this->mailer))->setHost($host);
        }

        throw new UnsupportedSchemeException($dsn, 'fakesms', $this->getSupportedSchemes());
    }

    protected function getSupportedSchemes(): array
    {
        return ['fakesms'];
    }
}
