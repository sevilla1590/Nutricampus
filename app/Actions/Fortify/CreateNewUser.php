<?php

namespace App\Actions\Fortify;

use App\Models\Cliente;
use App\Models\Team;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:users',
            ],
            'password' => $this->passwordRules(),
        ], [
            'email.unique' => 'El correo electrónico ya está registrado.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
            'email.required' => 'El campo correo electrónico es obligatorio.',
            'password.required' => 'El campo contraseña es obligatorio.',
            'name.required' => 'El campo nombre es obligatorio.',
        ])->validate();

        try {
            return DB::transaction(function () use ($input) {
                // Crear usuario
                $user = User::create([
                    'name' => $input['name'],
                    'email' => $input['email'],
                    'password' => Hash::make($input['password']),
                    'id_rol' => 2, // Rol de Cliente
                ]);

                // Crear el team personal
                $this->createTeam($user);

                // Separar nombre y apellido
                $nombreCompleto = explode(' ', $user->name);
                $nombre = $nombreCompleto[0];
                $apellido = count($nombreCompleto) > 1 ? implode(' ', array_slice($nombreCompleto, 1)) : '';

                // Crear cliente
                Cliente::create([
                    'id' => $user->id,
                    'nombre' => $nombre,
                    'apellido' => $apellido,
                    'direccion' => '',
                    'preferencias' => '',
                    'observaciones' => '',
                ]);

                return $user;
            });
        } catch (\Exception $e) {
            // Para debug, puedes descomentar la siguiente línea
            // dd($e->getMessage());
            throw $e;
        }
    }

    /**
     * Create a personal team for the user.
     */
    protected function createTeam(User $user): void
    {
        $user->ownedTeams()->save(Team::forceCreate([
            'user_id' => $user->id,
            'name' => explode(' ', $user->name, 2)[0]."'s Team",
            'personal_team' => true,
        ]));
    }
}
