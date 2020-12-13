<?php

namespace App\DataFixtures;

use App\Entity\Episode;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker;

class EpisodesFixtures extends Fixture implements DependentFixtureInterface
{
    public function getDependencies()
    {
        return [SeasonFixtures::class];
    }

    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('en_US');
        for ($i = 0; $i <= 10; $i++) {
                    $episode = new Episode();
                    $episode->setSeason($this->getReference('season_' . rand(1, 50)));
                    $episode->setTitle($faker->sentence);
                    $episode->setNumber($faker->numberBetween($min=1, $max=15));
                    $episode->setSynopsis($faker->text);
                    $manager->persist($episode);
        }
        $manager->flush();
    }
}
