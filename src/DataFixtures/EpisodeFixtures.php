<?php

namespace App\DataFixtures;

use App\Entity\Episode;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;;

class EpisodeFixtures extends Fixture implements DependentFixtureInterface
{
    public const EPISODES = [
        [
            'title' => 'You have to go', 'number' => 10, 'synopsis' => 'Armed with the truth about her husband\'s death, Jen demands justice. Meanwhile, Judy\'s attempt to make amends causes all sorts of problems for Steve.'
        ],
        [
            'title' => 'Dragonfly in amber', 'number' => 13, 'synopsis' => 'In 1968, Claire attends a wake with her daughter; in 1746, the battle of Culloden Moor is looming.'
        ],
        [
            'title' => 'Chapter One: The Hellfire Club', 'number' => 1, 'synopsis' => 'El est victime d\'intimidation à l\'école. Joyce ouvre un mystérieux colis. Un joueur rusé bouscule la soirée D&D.'
        ],
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (ProgramFixtures::PROGRAMS as $programName) {
            foreach (SeasonFixtures::SEASONS as $seasons) {
                foreach (self::EPISODES as $episodeName) {
                    $episode = new Episode();
                    $episode->setTitle($episodeName['title']);
                    $episode->setNumber($episodeName['number']);
                    $episode->setSynopsis($episodeName['synopsis']);
                    $episode->setSeason($this->getReference('season_' . $seasons['number'] . $programName['title']));
                    $manager->persist($episode);
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
