<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/$factory->define(App\Proveedor::class, function (Faker $faker) {
    return [
        'nit' => $faker->randomNumber(8, true),
        'nombre_empresa' => $faker->company,
        'nombre_contacto' => $faker->name,
        'direccion' => $faker->address,
        'email' => $faker->unique()->safeEmail,
        'web_site' => $faker->url,
        'telefono' => $faker->phoneNumber,
        'categoria'=>$faker->randomElement(['intangible','tangible'])
    ];
});
$factory->define(App\Categoria::class, function (Faker $faker) {
    return [
        'nombre'=>$faker->randomElement(['intangible','tangible']),
        'descripcion' =>$faker-> paragraph($nbSentences = 3, $variableNbSentences = true)
    ];
});
$factory->define(App\Cliente::class, function (Faker $faker) {
    return [
        'nombre_contacto' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'nombre_empresa' => $faker->company,
        'nit' => $faker->randomNumber(8, true),
        'direccion' => $faker->address,
        'telefono' => $faker->phoneNumber,
        'web_site' => $faker->url,
    ];
});
$factory->define(App\Productos::class, function (Faker $faker) {
    $categoria = App\Categoria::pluck('id')->toArray();
    $proveedor = App\Proveedor::pluck('id')->toArray();
    $sucursal = App\Sucursal::pluck('id')->toArray();
    return [
        'codigo' => $faker->randomNumber(6, true),
        'codigo_barra' => $faker->randomNumber(8, true),
        'nombre' => $faker->lastName,
        'marca' => $faker->company,
        'precio_costo' => $faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 48.8932),
        'precio_venta_mayor' => $faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 48.8932),
        'precio_venta_menor' => $faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 48.8932),
        'cantidad' => $faker->randomNumber(2, true),
        'unidad' => $faker->randomElement(['docena','centena']),
        'cantidad_inicial' => $faker -> randomDigit,     
        'id_proveedor' =>  $faker->randomElement($proveedor),
        'id_categoria' => $faker->randomElement($categoria),
        'id_sucursal' =>  $faker->randomElement($sucursal),
    ];
});

//$factory->define(App\Productos::class, function (Faker $faker) {
  //  return [
       // 'codigo'=>$faker->randomElement(['intangible','tangible']),
        //'descripcion' =>$faker-> paragraph($nbSentences = 3, $variableNbSentences = true)
  //  ];
//});

