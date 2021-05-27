<?php

namespace HtmlAcademy;

interface StatefulInterface
{
    public function getFiniteState(): TaskStatus;

    public function setFiniteState(TaskStatus $state): void;
}