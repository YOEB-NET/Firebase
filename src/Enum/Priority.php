<?php
namespace Yoeb\Firebase\Enum;

    enum Priority: string
    {
        case UNSPECIFIED    = 'PRIORITY_UNSPECIFIED';
        case MIN            = 'MIN';
        case LOW            = 'LOW';
        case DEFAULT        = 'DEFAULT';
        case HIGH           = 'HIGH';
        case MAX            = 'MAX';
    }
?>
