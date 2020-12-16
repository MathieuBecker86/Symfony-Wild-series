<?php

namespace App\DataFixtures;

use App\Entity\Episode;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker;
use App\Service\Slugify;

class EpisodesFixtures extends Fixture implements DependentFixtureInterface
{
    public function getDependencies()
    {
        return [SeasonFixtures::class];
    }

    private $slugify;

    public function __construct(Slugify $slugify)
    {
        $this->slugify = $slugify;
    }

    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('en_US');
        for ($i = 0; $i <= 200; $i++) {
                    $episode = new Episode();
                    $slugify = new Slugify();
                    $episode->setSeason($this->getReference('season_' . rand(1, 50)));
                    $episode->setTitle($faker->sentence);
                    $slug = $slugify->generate($episode->getTitle());
                    $episode->setSlug($slug);
                    $episode->setNumber($faker->numberBetween($min=1, $max=15));
                    $episode->setSynopsis($faker->text);
                    $manager->persist($episode);
        }
        $manager->flush();
    }
}
