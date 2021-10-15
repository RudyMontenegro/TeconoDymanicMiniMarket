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
            'name' => 'Administrador',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('secret'), // secret
            'cedula' => '12714785',
            'direccion' => '',
            'telefono' => '',
            'nivel_usuario'=> 'admin'
        ]);
        Sucursal::create([
            'nombre' => 'Sucursal-Principal',
            'responsable' => 'Administrador'
        ]);
        Proveedor::create([
            'nit' => '12714785',
        'nombre_empresa' => 'Sin nombre',
        'nombre_contacto' => 'Sin nombre',
        'direccion' => 'Sin direccion',
        'email' => 'proveedor@gmail.com',
        'web_site' => 'www.google.com',
        'telefono' => '12714785',
        'categoria'=> 'tangible'
        ]);
       // factory(Proveedor::class, 10)->create();
       factory(Categoria::class, 2)->create();
        //factory(Cliente::class, 100)->create();
       //factory(Productos::class, 100)->create();
        factory(Productos::class, 500)->create();
    }
    
}