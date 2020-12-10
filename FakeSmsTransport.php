<?php

namespace YieldStudio\Notifier\FakeSms;

use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Notifier\Exception\LogicException;
use Symfony\Component\Notifier\Message\MessageInterface;
use Symfony\Component\Notifier\Message\SentMessage;
use Symfony\Component\Notifier\Message\SmsMessage;
use Symfony\Component\Notifier\Transport\AbstractTransport;

/**
 * @author James Hemery <james@yieldstudio.fr>
 */
final class FakeSmsTransport extends AbstractTransport
{
    protected const HOST = 'email';

    private string $to;
    private ?MailerInterface $mailer;

    public function __construct(
        string $to,
        MailerInterface $mailer = null
    ) {
        $this->to = $to;
        $this->mailer = $mailer;

        parent::__construct();
    }

    public function __toString(): string
    {
        return sprintf('fakesms://%s?to=%s', $this->getEndpoint(), $this->to);
    }

    public function supports(MessageInterface $message): bool
    {
        return ($message instanceof SmsMessage) && self::HOST === $this->getEndpoint();
    }

    /**
     * @param MessageInterface|SmsMessage $message
     * @return void
     * @throws TransportExceptionInterface
     */
    protected function doSend(MessageInterface $message): void
    {
        if (!$this->supports($message)) {
            throw new LogicException(sprintf(
                'The "%s" transport only supports instances of "%s" ("%s" given) and the host email ("%s" given).',
                __CLASS__,
                SmsMessage::class,
                \get_class($message),
                $this->host
            ));
        }

        if (!$this->mailer) {
            throw new \LogicException('Missing mailer.');
        }

        $email = (new Email())
            ->to($this->to)
            ->subject('New SMS on ' . $message->getPhone())
            ->text($message->getSubject());

        $this->mailer->send($email);
    }
}
