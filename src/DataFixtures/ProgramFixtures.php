<?php

namespace App\DataFixtures;

use App\Entity\Program;
use App\DataFixtures\CategoryFixtures;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;


class ProgramFixtures extends Fixture implements DependentFixtureInterface
{
    public const PROGRAMS = [
        [
            'title' => 'BatesMotel',
            'synopsis' => "Après la mort mystérieuse de son mari, Norma Bates décide de refaire sa vie loin de l'Arizona, dans la petite ville de White Pine Bay dans l'Oregon, et emmène avec elle son fils Norman, âgé de 17 ans",
            'year' => '2013',
            'country' => 'USA',
            'categoryReference' => 'Horreur',
        ],
        [
            'title' => 'Girls',
            'synopsis' => "Girls est une série qui suit la vie d'un groupe d'amies ayant la vingtaine et qui vivent à New York.",
            'year' => '2017',
            'country' => 'USA',
            'categoryReference' => 'Romance',
        ],
        [
            'title' => 'WhiteLines',
            'synopsis' => "Suite à la découverte du corps d'Axel Collins, un jeune DJ anglais disparu 20 ans plus tôt, dans le désert espagnol, sa soeur, Zoe, se rend alors à Ibiza, là où Alex a été vu pour la dernière fois, afin de découvrir ce qui s'est réellement passé.",
            'year' => '2020',
            'country' => 'UK',
            'categoryReference' => 'Drame',
        ],
        [
            'title' => 'FireFlyLane',
            'synopsis' => "Sur trente ans, les hauts et les bas de Kate et Tully qui, depuis l'adolescence, sont meilleures amies et se soutiennent dans les bons comme les mauvais moments",
            'year' => '2021',
            'country' => 'USA',
            'categoryReference' => 'Romance',
        ],
        [
            'title' => 'StrangerThings',
            'synopsis' => "En 1983, à Hawkins dans l'Indiana, Will Byers disparaît de son domicile. Ses amis se lancent alors dans une recherche semée d'embûches pour le retrouver. Pendant leur quête de réponses, les garçons rencontrent une étrange jeune fille en fuite.",
            'year' => '2016',
            'country' => 'USA',
            'categoryReference' => 'Fantastique',
        ],
    ];

    public function load(ObjectManager $manager)
    {
        foreach (self::PROGRAMS as $programName) {
            $program = new Program();
            $program->setTitle($programName['title']);
            $program->setSynopsis($programName['synopsis']);
            $program->setYear($programName['year']);
            $program->setCountry($programName['country']);
            $program->setCategory($this->getReference('category_' . $programName['categoryReference']));
            
            $manager->persist($program);
            $this->addReference('program_' . $programName['title'], $program);
          
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
