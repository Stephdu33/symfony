<?php

namespace App\DataFixtures;

use App\Entity\Season;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

//Tout d'abord nous ajoutons la classe Factory de FakerPhp
use Faker\Factory;

class SeasonFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        //Puis ici nous demandons à la Factory de nous fournir un Faker
        $faker = Factory::create();

        /**
         * L'objet $faker que tu récupère est l'outil qui va te permettre 
         * de te générer toutes les données que tu souhaites
         */
        foreach (CategoryFixtures::CATEGORIES as $categoryName) {
            for ($i = 1; $i <= 5; $i++) {
                for ($s = 1; $s <= 5; $s++) {
                    $season = new Season();
                    //Ce Faker va nous permettre d'alimenter l'instance de Season que l'on souhaite ajouter en base
                    $season->setNumber($s);
                    $season->setYear($faker->year());
                    $season->setDescription($faker->realText(200));

                    $season->setProgram($this->getReference('program_' . $i . 'category_' . $categoryName));

                    $this->setReference('season_' . $i . $s . $categoryName, $season);

                    $manager->persist($season);
                }
            }
        }
        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            ProgramFixtures::class,
        ];
    }
}
