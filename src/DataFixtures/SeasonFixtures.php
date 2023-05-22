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
        foreach (ProgramFixtures::PROGRAMS as $program){
            $season = new Season();
            $season->setNumber(1);
            $season->setYear(rand(1990,2020));
            $season->setDescription("description de la saison");
            $reference = 'program_' . $program['title'];
            $season->setProgram($this->getReference($reference));
            $manager->persist($season);
    
            $seasonReference = 'saison_1_' . $program['title'];
            $this->addReference($seasonReference, $season);

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
