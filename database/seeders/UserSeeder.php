<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Administradores
        User::create([
            'name' => 'Administrador',
            'email' => 'admin@ecotech.com',
            'password' => Hash::make('user1234'),
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@ecotech.com',
            'password' => Hash::make('user1234'),
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);

        // Usuarios comunes (50 usuarios)
        $users = [
            ['Juan Perez', 'juan@ecotech.com'],
            ['Maria Gomez', 'maria@ecotech.com'],
            ['Carlos Rodriguez', 'carlos@ecotech.com'],
            ['Laura Fernandez', 'laura@ecotech.com'],
            ['Diego Martinez', 'diego@ecotech.com'],
            ['Ana Silva', 'ana@ecotech.com'],
            ['Pablo Lopez', 'pablo@ecotech.com'],
            ['Sofia Torres', 'sofia@ecotech.com'],
            ['Martin Diaz', 'martin@ecotech.com'],
            ['Lucia Romero', 'lucia@ecotech.com'],
            ['Jose Alvarez', 'jose@ecotech.com'],
            ['Carla Moreno', 'carla@ecotech.com'],
            ['Luis Castro', 'luis@ecotech.com'],
            ['Marta Reyes', 'marta@ecotech.com'],
            ['Pedro Ortiz', 'pedro@ecotech.com'],
            ['Elena Navarro', 'elena@ecotech.com'],
            ['Jorge Castillo', 'jorge@ecotech.com'],
            ['Natalia Paredes', 'natalia@ecotech.com'],
            ['Roberto Herrera', 'roberto@ecotech.com'],
            ['Valeria Vega', 'valeria@ecotech.com'],
            ['Andres Flores', 'andres@ecotech.com'],
            ['Carolina Mendez', 'carolina@ecotech.com'],
            ['Fernando Rios', 'fernando@ecotech.com'],
            ['Gabriela Cruz', 'gabriela@ecotech.com'],
            ['Hector Morales', 'hector@ecotech.com'],
            ['Irene Castro', 'irene@ecotech.com'],
            ['Javier Ortiz', 'javier@ecotech.com'],
            ['Karina Soto', 'karina@ecotech.com'],
            ['Leonardo Vargas', 'leonardo@ecotech.com'],
            ['Monica Pena', 'monica@ecotech.com'],
            ['Nicolas Ramos', 'nicolas@ecotech.com'],
            ['Olga Ruiz', 'olga@ecotech.com'],
            ['Pablo Silva', 'pablosilva@ecotech.com'],
            ['Raquel Torres', 'raquel@ecotech.com'],
            ['Santiago Gomez', 'santiago@ecotech.com'],
            ['Teresa Morales', 'teresa@ecotech.com'],
            ['Uriel Juarez', 'uriel@ecotech.com'],
            ['Veronica Castro', 'veronica@ecotech.com'],
            ['Walter Diaz', 'walter@ecotech.com'],
            ['Ximena Leon', 'ximena@ecotech.com'],
            ['Yolanda Paredes', 'yolanda@ecotech.com'],
            ['Zoe Fernandez', 'zoe@ecotech.com'],
            ['Agustin Herrera', 'agustin@ecotech.com'],
            ['Belen Rios', 'belen@ecotech.com'],
            ['Cristian Mendez', 'cristian@ecotech.com'],
            ['Daniela Soto', 'daniela@ecotech.com'],
            ['Emiliano Vega', 'emiliano@ecotech.com'],
            ['Florencia Silva', 'florencia@ecotech.com'],
            ['Gustavo Lopez', 'gustavo@ecotech.com'],
             ['User Cool', 'user@ecotech.com'],
        ];

        foreach ($users as [$name, $email]) {
            User::create([
                'name' => $name,
                'email' => $email,
                'password' => Hash::make('user1234'),
                'role' => 'user',
                'email_verified_at' => now(),
            ]);
        }
    }
}