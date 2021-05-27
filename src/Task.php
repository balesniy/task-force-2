<?php
namespace HtmlAcademy;

class Task implements StatefulInterface
{
    public function __construct(
        private TaskStatus $status,
        public int $customerId,
        public ?int $executorId = null
    ) {}

    public function getFiniteState(): TaskStatus
    {
        return $this->status;
    }

    public function setFiniteState(TaskStatus $state): void
    {
        $this->status = $state;
    }

    public function getRoleById(int $userId): ?UserRole
    {
        if ($userId === $this->customerId) {
            return UserRole::customer();
        }
        if ($this->executorId && $userId === $this->executorId) {
            return UserRole::executor();
        }

        return null;
    }

    public function getStatefulTask(int $userId): ?StateMachine
    {
        $role = $this->getRoleById($userId);

        if ($role?->equals(UserRole::customer())) {
            return new CustomerStateMachine($this);
        }

        if ($role?->equals(UserRole::executor())) {
            return new ExecutorStateMachine($this);
        }

        return null;
    }
}