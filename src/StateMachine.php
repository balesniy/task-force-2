<?php

namespace HtmlAcademy;

class StateMachine
{
    public function __construct(
        public StatefulInterface $document,
        public \WeakMap $transitions
    )
    {
    }

    public function getCurrentState(): TaskStatus
    {
        return $this->document->getFiniteState();
    }

    public function can(ActionType $action): bool
    {
        return isset($this->transitions[$action]) && $this->transitions[$action]['from']->equals($this->document->getFiniteState());
    }

    public function getNextState(ActionType $action): ?TaskStatus
    {
        return $this->can($action) ? $this->transitions[$action]['to'] : null;
    }

    public function getAvailableActions(): array
    {
        $currentState = $this->getCurrentState();
        $actions = [];

        foreach ($this->transitions as $action => $states) {
           if ($currentState->equals($states['from'])) {
               $actions[] = $action;
           }
        }

        return $actions;
    }

    public function apply(ActionType $action): void
    {
        if ($this->can($action)) {
            $this->document->setFiniteState($this->getNextState($action));
        }
    }
}