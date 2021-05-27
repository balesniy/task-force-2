<?php

namespace HtmlAcademy;

class ExecutorStateMachine extends StateMachine
{
    public \WeakMap $transitions;

    public function __construct(StatefulInterface $document)
    {
        $this->transitions = new \WeakMap();
        $this->transitions[ActionType::reply()] = ['from' => TaskStatus::new(), 'to' => TaskStatus::inWork()];
        $this->transitions[ActionType::fail()] = ['from' => TaskStatus::inWork(), 'to' => TaskStatus::fail()];
        parent::__construct($document, $this->transitions);
    }
}