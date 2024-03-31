<?php

namespace Database\Factories;

use Faker\Provider\Base;
use Ramsey\Uuid\Uuid;

class UUIDFactory extends Base
{
    public static function uuid()
    {
        return Uuid::uuid4()->toString();
    }
}
