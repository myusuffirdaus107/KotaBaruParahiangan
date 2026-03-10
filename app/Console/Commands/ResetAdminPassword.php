<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class ResetAdminPassword extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:reset-password {email} {password}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reset admin user password';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = $this->argument('email');
        $password = $this->argument('password');

        $user = User::where('email', $email)->where('role', 'admin')->first();

        if (!$user) {
            $this->error("Admin user with email {$email} not found");
            return 1;
        }

        $user->update([
            'password' => Hash::make($password),
        ]);

        $this->info("Password for {$email} has been reset to: {$password}");
        return 0;
    }
}
