<?php

namespace Tests\Feature\App\Services\Domains;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use PHPUnit\Framework\Attributes\Group;
use Tests\TestCase;

/**
 * @see AbService
 */
#[Group('AbService')]
final class AbServiceTest extends TestCase
{
    use DatabaseTransactions;
}
