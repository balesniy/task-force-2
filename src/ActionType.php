<?php

namespace HtmlAcademy;

use Spatie\Enum\Enum;

/**
 * @method static self reply()
 * @method static self cancel()
 * @method static self done()
 * @method static self fail()
 */
class ActionType extends Enum
{
    protected static function labels(): array
    {
        return [
            'reply' => 'Откликнуться',
            'cancel' => 'Отменить',
            'done' => 'Выполнено',
            'fail' => 'Провалено',
        ];
    }
}