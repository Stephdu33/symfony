<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;;


class CategoryFixtures extends Fixture
{
    public const CATEGORY = [
        ['name' => 'Horreur'],
        ['name' => 'Science Fiction'],
        ['name' => 'Romance'],
        ['name' => 'Comédie'],
        ['name' => 'Historique'],
        ['name' => 'Fantastique'],
        ['name' => 'Policière'],
        ['name' => 'Drame'],
    ];
    /**
     * Undocumented function
     *
     * @param ObjectManager $manager
     * @return void
     */
    public function load(ObjectManager $manager): void
    {
        foreach (self::CATEGORY as $categoryName) {
            $category = new Category();
            $category->setName($categoryName['name']);
            $manager->persist($category);
        }
        $manager->flush();
    }
}
