<?php

namespace HtmlAcademy;

use Spatie\Enum\Enum;

/**
 * @method static self new()
 * @method static self cancelled()
 * @method static self inWork()
 * @method static self done()
 * @method static self fail()
 */
class TaskStatus extends Enum
{
    protected static function labels(): array
    {
        return [
            'new' => 'Новое',
            'cancelled' => 'Отменено',
            'inWork' => 'В работе',
            'done' => 'Выполнено',
            'fail' => 'Провалено',
        ];
    }
}