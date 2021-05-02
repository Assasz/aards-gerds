<?php

declare(strict_types=1);

namespace AardsGerds\Game\Dialog;

use AardsGerds\Game\Shared\Collection;

final class PlayerDialogOptionCollection extends Collection
{
    /**
     * @note This method mutates state of the collection
     */
    public function remove(PlayerDialogOption $item): self
    {
        $this->items = $this->filter(
            static fn(PlayerDialogOption $dialogOption): bool => $dialogOption !== $item,
        )->getItems();

        return $this;
    }

    /**
     * @note This method mutates state of the collection
     */
    public function clear(): self
    {
        $this->items = [];

        return $this;
    }

    protected function getType(): string
    {
        return PlayerDialogOption::class;
    }
}
