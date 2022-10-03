<?php

declare(strict_types=1);

use Lits\Config\MailConfig;
use Lits\Framework;
use Lits\Mail;
use Lits\Settings;
use Symfony\Bridge\Twig\Mime\BodyRenderer;
use Symfony\Component\EventDispatcher\EventDispatcherInterface as Dispatcher;
use Symfony\Component\Mailer\EventListener\MessageListener;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mailer\Transport as MailerTransport;
use Twig\Environment;

return function (Framework $framework): void {
    $framework->addDefinition(
        Mail::class,
        function (
            Dispatcher $dispatcher,
            Environment $environment,
            Settings $settings
        ): Mail {
            $dispatcher->addSubscriber(
                new MessageListener(null, new BodyRenderer($environment))
            );

            assert($settings['mail'] instanceof MailConfig);

            /** @psalm-suppress TooManyArguments */
            $transport = MailerTransport::fromDsn(
                $settings['mail']->dsn,
                $dispatcher
            );

            $mailer = new Mailer(
                $transport,
                null,
                $dispatcher
            );

            return new Mail($settings['mail'], $mailer);
        }
    );
};
