<?php

declare(strict_types=1);

use Lits\Config\MailConfig;
use Lits\Framework;

return function (Framework $framework): void {
    $framework->addConfig('mail', new MailConfig());
};
