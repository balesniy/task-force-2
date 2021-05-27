<?php
require_once "vendor/autoload.php";

use HtmlAcademy\ActionType;
use HtmlAcademy\Task;
use HtmlAcademy\TaskStatus;

$newTask = new Task(TaskStatus::new(), customerId: 1);
assert($newTask->customerId == 1, 'хранит id заказчика');

$inWorkTask = new Task(TaskStatus::inWork(), customerId: 1, executorId: 2);
assert($inWorkTask->executorId == 2, 'хранит id исполнителя');

$taskSM = $newTask->getStatefulTask(userId: 1);
assert($taskSM->can(ActionType::cancel()) == true, 'проверяет доступное действие');
assert($taskSM->can(ActionType::fail()) == false, 'проверяет недоступное действие');
assert($taskSM->getCurrentState()->label == 'Новое', 'возвращает текуший статус');
assert($taskSM->getNextState(ActionType::cancel())->label == 'Отменено', 'возвращает следующий статус');
assert($taskSM->getAvailableActions()[0] == ActionType::cancel(), 'возвращает доступные действия');

echo 'all done' . "\n";
