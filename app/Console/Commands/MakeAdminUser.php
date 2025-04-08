<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class MakeAdminUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:admin
                            {--name=Admin : Nome do usuário}
                            {--email=admin@admin.com : E-mail do admin}
                            {--password=123456 : Senha do admin}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cria um usuário administrador';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = $this->option('email');

        if (User::where('email', $email)->exists()) {
            $this->error('Já existe um usuário com este e-mail.');
            return Command::FAILURE;
        }

        $user = User::create([
            'name' => $this->option('name'),
            'email' => $email,
            'password' => Hash::make($this->option('password')),
        ]);

        $this->info("Usuário admin criado com sucesso: {$user->email}");

        return Command::SUCCESS;
    }
}
