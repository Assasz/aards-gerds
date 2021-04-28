<?php

declare(strict_types=1);

namespace AardsGerds\Game\Location;

final class VisitorRole implements \Stringable
{
    private const ROLE_MERCHANT = 'merchant';
    private const ROLE_TEACHER = 'teacher';
    private const ROLE_QUEST_GIVER = 'quest giver';

    private function __construct(
        private string $role,
    ) {}

    public static function merchant(): self
    {
        return new self(self::ROLE_MERCHANT);
    }

    public static function teacher(): self
    {
        return new self(self::ROLE_TEACHER);
    }

    public static function questGiver(): self
    {
        return new self(self::ROLE_QUEST_GIVER);
    }

    public function __toString(): string
    {
        return $this->role;
    }
}
