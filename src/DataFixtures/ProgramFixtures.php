<?php

namespace App\DataFixtures;

use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProgramFixtures extends Fixture implements DependentFixtureInterface
{
    public const PROGRAMS = [
        ['title' => 'Dead To Me', 'synopsis' => 'Accablée de chagrin et de colère après la mort tragique de son mari, 
l\'agent immobilier Jen, une femme acide, rencontre l\'empathique Judy dans un groupe de soutien', 'category' => 'category_Comédie'],
        ['title' => 'Stranger Things', 'synopsis' => 'Quand un jeune garçon disparaît, une petite ville découvre une affaire mystérieuse, des expériences secrètes, 
des forces surnaturelles terrifiantes... et une fillette', 'category' => 'category_Fantastique'],
        ['title' => 'The Tudors', 'synopsis' => 'Dans l\'Angleterre du XVIe siècle, le jeune Henri VIII accède au trône. Un ambassadeur, 
l\'oncle du roi, ayant été assassiné en Italie, cet événement précipite la gestion des affaires diplomatiques 
et Henri veut riposter en déclarant la guerre au royaume de France, accusé d\'être l\'instigateur de ce crime.', 'category' => 'category_Historique'],
        ['title' => 'Braquo', 'synopsis' => 'Suite à la condamnation injuste et au suicide de leur chef de groupe, trois flics de la PJ ont la tentation de franchir la ligne rouge.', 'category' => 'category_Policière'],
        ['title' => 'Outlander', 'synopsis' => 'Les aventures de Claire, une infirmière de guerre mariée qui se retrouve accidentellement propulsée en pleine campagne écossaise de 1743.', 'category' => 'category_Romance']
    ];

    public function load(ObjectManager $manager)
    {
        foreach (self::PROGRAMS as $programName) {
            $program = new Program();
            $program->setTitle($programName['title']);
            $program->setSynopsis($programName['synopsis']);
            $program->setCategory($this->getReference($programName['category']));
            $manager->persist($program);
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
