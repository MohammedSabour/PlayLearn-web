<?php

namespace App\Enums;

enum QuestionType: string
{
    case QCM = 'qcm';           
    case QCU = 'qcu';           

    public function label(): string
    {
        return match($this) {
            self::QCM => 'Question à Choix Multiple',
            self::QCU => 'Question à Choix Unique',
        };
    }
}
