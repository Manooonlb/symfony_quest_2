<?php

namespace App\DataFixtures;

use App\Entity\Season;
use App\DataFixtures\ProgramFixtures;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class SeasonFixtures extends Fixture implements DependentFixtureInterface
{

    public function load(ObjectManager $manager): void
    {
        
        // $product = new Product();
        // $manager->persist($product);
        $seasons = [
            [
                'name' => 'S1',
                'programReference' => 'program_BatesMotel',
            ],
            [
                'name' => 'Saison_1',
                'programReference' => 'program_Girls',
            ],
            [
                'name' => 'S1',
                'programReference' => 'program_WhiteLines',
            ],
        ];

        foreach ($seasons as $seasonName){
            $season = new Season();
            $season->setName($seasonName['name']);
            $season->setProgram($this->getReference($seasonName['programReference']));

            $manager->persist($season);
            $this->addReference('season_' . $seasonName['name'], $season);
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
