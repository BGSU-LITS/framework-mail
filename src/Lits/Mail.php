<?php

declare(strict_types=1);

namespace Lits;

use Lits\Config\MailConfig;
use Lits\Exception\FailedSendingException;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface as Mailer;
use Symfony\Component\Mime\Message;

final class Mail
{
    public function __construct(
        public MailConfig $config,
        public Mailer $mailer,
    ) {
    }

    public function message(): TemplatedEmail
    {
        $message = new TemplatedEmail();

        if (\is_string($this->config->from)) {
            $message->from($this->config->from);
        }

        return $message;
    }

    /** @throws FailedSendingException */
    public function send(Message $message): void
    {
        try {
            $this->mailer->send($message);
        } catch (\Throwable $exception) {
            throw new FailedSendingException(
                'Could not send message',
                0,
                $exception,
            );
        }
    }
}
