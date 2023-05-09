<?php

namespace App\DataFixtures;

use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;


class ProgramFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $programs = [
            [
                'title' => 'Bates Motel',
                'synopsis' => "Après la mort mystérieuse de son mari, Norma Bates décide de refaire sa vie loin de l'Arizona, dans la petite ville de White Pine Bay dans l'Oregon, et emmène avec elle son fils Norman, âgé de 17 ans",
                'categoryReference' => 'category_Horreur',
            ],
            [
                'title' => 'Girls',
                'synopsis' => "Girls est une série qui suit la vie d'un groupe d'amies ayant la vingtaine et qui vivent à New York.",
                'categoryReference' => 'category_Romance',
            ],
            [
                'title' => 'White Lines',
                'synopsis' => "Suite à la découverte du corps d'Axel Collins, un jeune DJ anglais disparu 20 ans plus tôt, dans le désert espagnol, sa soeur, Zoe, se rend alors à Ibiza, là où Alex a été vu pour la dernière fois, afin de découvrir ce qui s'est réellement passé.",
                'categoryReference' => 'category_Drame',
            ],
            [
                'title' => 'FireFly Lane',
                'synopsis' => "Sur trente ans, les hauts et les bas de Kate et Tully qui, depuis l'adolescence, sont meilleures amies et se soutiennent dans les bons comme les mauvais moments",
                'categoryReference' => 'category_Romance',
            ],
            [
                'title' => 'Stranger Things',
                'synopsis' => "En 1983, à Hawkins dans l'Indiana, Will Byers disparaît de son domicile. Ses amis se lancent alors dans une recherche semée d'embûches pour le retrouver. Pendant leur quête de réponses, les garçons rencontrent une étrange jeune fille en fuite.",
                'categoryReference' => 'category_Fantastique',
            ],
        ];
        foreach ($programs as $programData) {
            $programs = new Program();
            $programs->setTitle($programData['title']);
            $programs->setSynopsis($programData['synopsis']);
            $programs->setCategory($this->getReference($programData['categoryReference']));

            $manager->persist($programs);
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
