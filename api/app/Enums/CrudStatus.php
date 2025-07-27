<?php

namespace App\Enums;

enum CrudStatus: string
{
    case CREATED = 'Successfully created';
    case DELETED = 'Successfully deleted';
    case UPDATED = 'Successfully updated';
    case NO_CHANGE = 'No change';
}
