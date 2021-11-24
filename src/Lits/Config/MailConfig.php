<?php

declare(strict_types=1);

namespace Lits\Config;

use Lits\Config;

final class MailConfig extends Config
{
    public string $dsn = '';
    public ?string $from = null;
}
