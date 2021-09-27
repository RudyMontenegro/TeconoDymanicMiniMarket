<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Cliente;
use App\Proveedor;
use App\Categoria;
use App\Sucursal;
use App\Productos;
class DatabaseSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Rudy',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('secret'), // secret
            'cedula' => '12714785',
            'direccion' => '',
            'telefono' => '',
            'nivel_usuario'=> 'admin'
        ]);
        Sucursal::create([
            'nombre' => 'Sucursal-Quillacollo',
            'responsable' => 'Fernando'
        ]);
        Sucursal::create([
            'nombre' => 'Sucursal-Sacaba',
            'responsable' => 'Rudy'
        ]);
        Sucursal::create([
            'nombre' => 'Sucursal-ZonaSud',
            'responsable' => 'Alex'
        ]);
        factory(Proveedor::class, 10)->create();
        factory(Categoria::class, 2)->create();
        factory(Cliente::class, 100)->create();
       factory(Productos::class, 100)->create();
       // factory(Productos::class, 100)->create();
    }
    
}
