<?php

namespace App\Jobs;

use App\Jobs\Tenancy\DeleteDatabaseJob;
use Stancl\Tenancy\Database\DatabaseManager;
use Stancl\Tenancy\Jobs\CreateDatabase;

class CreateDatabaseJob extends CreateDatabase
{

    public function handle(DatabaseManager $databaseManager): void
    {
        if(!app()->isProduction()){
            (new DeleteDatabaseJob($this->tenant))->handle();
        }

        parent::handle($databaseManager);
    }
}
