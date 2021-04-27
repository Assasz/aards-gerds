<?php

declare(strict_types=1);

namespace AardsGerds\Game\Location\Town;

final class VisitorRole implements \Stringable
{
    private const ROLE_TRADER = 'trader';
    private const ROLE_TEACHER = 'teacher';
    private const ROLE_QUEST_GIVER = 'quest giver';

    private function __construct(
        private string $role,
    ) {}

    public static function trader(): self
    {
        return new self(self::ROLE_TRADER);
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
