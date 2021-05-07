<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;


    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
      $gender = $this->faker->randomElement(['Male', 'Female','Non-binary']);
        return [
            'username'          => $this->faker->userName,
            'password'          => bcrypt('password'), // password
            'name'              => $this->faker->name,
            'email'             => $this->faker->unique()->safeEmail,
            'SocialMedia'       => "https://www.facebook.com/nguyenthanhkhanhan",
            'dateOfBirth'       => $this->faker->dateTimeBetween('1981-12-31', '2012-12-31'),//rand(15,35),
            'gender'            => $gender,
            'urlAvatar'         => 'https://upload.wikimedia.org/wikipedia/commons/b/b5/191125_Taylor_Swift_at_the_2019_American_Music_Awards_%28cropped%29.png',
            'FreeTrial'         => rand(0,1),
            'Banned'            => rand(0,1),
            'VIP'               => rand(0,1),
            'VIP_expired'       => $this->faker->dateTimeBetween('2021-03-20', '2022-12-31'),
            'email_verified_at' => now(),
            'ShareInfo'         =>rand(0,1),
            'remember_token'    => Str::random(10),
        ];

    }//end definition()


}//end class
