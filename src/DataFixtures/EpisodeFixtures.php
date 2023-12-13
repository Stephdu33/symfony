<?php

namespace App\DataFixtures;

use App\Entity\Episode;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;;

use Faker\Factory;

class EpisodeFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {

        $faker = Factory::create();

        foreach (CategoryFixtures::CATEGORIES as $categoryName) {
            for ($i = 1; $i <= 5; $i++) {
                for ($s = 1; $s <= 5; $s++) {
                    for ($e = 1; $e <= 10; $e++) {
                        $episode = new Episode();
                        $episode->setTitle($faker->title());
                        $episode->setNumber($e);
                        $episode->setSynopsis($faker->realText(200));

                        $episode->setSeason($this->getReference('season_' . $i . $s . $categoryName));

                        $manager->persist($episode);
                    }
                }
            }
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            SeasonFixtures::class,
        ];
    }
}
