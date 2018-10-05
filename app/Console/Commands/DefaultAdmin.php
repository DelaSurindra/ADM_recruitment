<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;
use Hash;

class DefaultAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:admin {email}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make new user admin';

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
     *
     * @return mixed
     */
    public function handle()
    {
        //
        $username = $this->argument('email');
        $password = str_random(8);

        $hash = Hash::make($password);

        $user = new User;

        if(!empty($user->where('email',$username)->first())){
            echo "Email already exists. Pleas use another email.\n";
        }else{

            $user->name = 'admin_'.date('YmdHis');
            $user->email = $username;
            $user->password = $hash;
            $user->save();

            echo "User berhasil dibuat, silakan login dengan:\n - Email: ".$username."\n - Password: ".$password."\n";
        }


    }

}
