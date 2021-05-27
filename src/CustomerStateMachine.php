<?php

namespace HtmlAcademy;

class CustomerStateMachine extends StateMachine
{
    public \WeakMap $transitions;

    public function __construct(StatefulInterface $document)
    {
        $this->transitions = new \WeakMap();
        $this->transitions[ActionType::cancel()] = ['from' => TaskStatus::new(), 'to' => TaskStatus::cancelled()];
        $this->transitions[ActionType::done()] = ['from' => TaskStatus::inWork(), 'to' => TaskStatus::done()];
        parent::__construct($document, $this->transitions);
    }
}