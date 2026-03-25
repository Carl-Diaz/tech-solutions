<?php

namespace Database\Factories;

use App\Models\Contract;
use App\Models\Collaborator;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContractFactory extends Factory
{
    protected $model = Contract::class;

    public function definition(): array
    {
        $cargos = [
            'Desarrollador de Software',
            'Analista de Sistemas',
            'Coordinador de Proyectos',
            'Director de Tecnología',
        ];

        $salarios = [2500000, 3200000, 3800000, 4500000, 5200000];
        $tiposContrato = ['Fijo', 'Indefinido', 'Prestación de Servicios'];
        $estados = ['Activo', 'Terminado', 'Finalizado'];

        $startDate = $this->faker->dateTimeBetween('-1 year', 'now');
        $isIndefinido = $this->faker->boolean(20);

        return [
            'collaborator_id' => Collaborator::factory(),
            'contract_type' => $this->faker->randomElement($tiposContrato),
            'start_date' => $startDate->format('Y-m-d'),
            'end_date' => $isIndefinido ? null : $this->faker->dateTimeBetween($startDate, '+2 years')->format('Y-m-d'),
            'position' => $this->faker->randomElement($cargos),
            'salary' => $this->faker->randomElement($salarios),
            'status' => $this->faker->randomElement($estados),
        ];
    }

    public function activo(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'Activo',
        ]);
    }

    public function fijo(): static
    {
        return $this->state(fn (array $attributes) => [
            'contract_type' => 'Fijo',
        ]);
    }
}