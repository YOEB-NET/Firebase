<?php
namespace Yoeb\Firebase\Enum;

    enum Visibility: string
    {
        case UNSPECIFIED    = 'VISIBILITY_UNSPECIFIED';
        case PRIVATE        = 'PRIVATE';
        case PUBLIC         = 'PUBLIC';
        case SECRET         = 'SECRET';
    }
?>
