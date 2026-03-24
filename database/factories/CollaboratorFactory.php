<?php

namespace Database\Factories;

use App\Models\Collaborator;
use Illuminate\Database\Eloquent\Factories\Factory;

class CollaboratorFactory extends Factory
{
    protected $model = Collaborator::class;

    public function definition(): array
    {
        return [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'document_type' => $this->faker->randomElement(['CC', 'CE', 'PPT']),
            'document_number' => $this->faker->unique()->numerify('########'),
            'birth_date' => $this->faker->date(),
            'email' => $this->faker->unique()->email,
            'phone_number' => $this->faker->phoneNumber,
            'address' => $this->faker->address,
        ];
    }
}