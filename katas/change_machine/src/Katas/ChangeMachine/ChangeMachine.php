<?php

namespace Katas\ChangeMachine;

class ChangeMachine
{
    private $cassete;

    public function __construct(Cassete $cassete)
    {
        $this->cassete = $cassete;
    }

    public function change(array $coins)
    {
        $this->cassete->dispense([]);
    }

}
