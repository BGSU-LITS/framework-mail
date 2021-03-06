<?php

declare(strict_types=1);

namespace Lits\Package;

use Lits\Package;

final class MailPackage extends Package
{
    public function path(): string
    {
        return \dirname(\dirname(__DIR__));
    }
}
