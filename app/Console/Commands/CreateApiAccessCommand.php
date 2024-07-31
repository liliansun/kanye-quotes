<?php

namespace App\Console\Commands;

use App\Models\ApiAccess;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class CreateApiAccessCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'api-access:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new API access token.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $name = $this->ask('What would you like to name this token?');

        $access = ApiAccess::create([
            'name' => $name,
            'token' => Str::random(64),
        ]);

        $this->table(
            ['Name', 'Token'],
            [[$access->name, $access->token]]
        );
    }
}
