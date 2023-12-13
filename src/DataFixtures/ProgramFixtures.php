<?php

namespace App\DataFixtures;

use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

use Faker\Factory;

class ProgramFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();
        foreach (CategoryFixtures::CATEGORIES as $categoryName) {

            for ($i = 1; $i <= 5; $i++) {
                $program = new Program();

                $program->setTitle($faker->title());
                $program->setSynopsis($faker->realText(200));
                $program->setPoster($faker->image(null, 360, 360, 'film', true));
                $program->setCountry($faker->countryCode());
                $program->setYear($faker->year());
                $program->setCategory($this->getReference('category_' . $categoryName));
                $this->addReference('program_' . $i . 'category_' . $categoryName, $program);

                $manager->persist($program);
            }
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        // Tu retournes ici toutes les classes de fixtures dont ProgramFixtures dépend
        return [
            CategoryFixtures::class,
        ];
    }
}
