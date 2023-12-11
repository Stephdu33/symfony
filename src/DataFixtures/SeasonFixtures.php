<?php

namespace App\DataFixtures;

use App\Entity\Season;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;


class SeasonFixtures extends Fixture implements DependentFixtureInterface
{
    public const SEASONS = [
        ['number' => 1, 'year' => 2019, 'description' => 'Le mari de Jen est récemment décédé dans un délit de fuite et sa veuve sardonique est déterminée à résoudre le crime. Judy, d\'esprit libre et optimiste, a récemment subi une perte tragique. Les deux dames se rencontrent dans un groupe de soutien.'],
        ['number' => 2, 'year' => 2016, 'description' => 'Claire, Jamie et Murtagh arrivent en France et comprennent vite que vivre à Paris n\'est pas sans danger.'],
        ['number' => 4, 'year' => 2022, 'description' => 'En Californie, Onze, Mike, Will, Jonathan et Argyle créent un réservoir d\'isolement à travers lequel Onze entre dans l\'esprit de Max pour sauver son amie et affronter Vecna.'],
    ];

    public function load(ObjectManager $manager)
    {
        foreach (ProgramFixtures::PROGRAMS as $programName) {
            foreach (self::SEASONS as $seasons) {
                $season = new Season();
                $season->setNumber($seasons['number']);
                $season->setYear($seasons['year']);
                $season->setDescription($seasons['description']);
                $season->setProgram($this->getReference('program_' . $programName['title']));
                $this->addReference('season_' . $seasons['number'] . $programName['title'], $season);
                $manager->persist($season);
            }
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            ProgramFixtures::class,
        ];
    }
}
