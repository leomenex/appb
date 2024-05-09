<?php

namespace App\Enums;

enum StatusMigrator{
    case PENDING;
    case FAIL;
    case SUCCESS;
    case DONE;
}
