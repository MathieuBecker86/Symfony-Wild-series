<?php

namespace App\DataFixtures;

use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;


class ProgramFixtures extends Fixture implements DependentFixtureInterface
{
    const PROGRAMS = [
        'Walking Dead' => [
            'summary' => 'Le policier Rick Grimes se réveille après un long coma. Il découvre avec effarement que le monde, ravagé par une épidémie, est envahi par les morts-vivants.',
            'category' => 'Horreur',
            'poster' => 'https://m.media-amazon.com/images/M/MV5BZmFlMTA0MmUtNWVmOC00ZmE1LWFmMDYtZTJhYjJhNGVjYTU5XkEyXkFqcGdeQXVyMTAzMDM4MjM0._V1_.jpg',

        ],
        'The Haunting Of Hill House' => [
            'summary' => 'Plusieurs frères et sœurs qui, enfants, ont grandi dans la demeure qui allait devenir la maison hantée la plus célèbre des États-Unis, sont contraints de se réunir pour finalement affronter les fantômes de leur passé.',
            'category' => 'Horreur',
            'poster' => 'https://fr.web.img5.acsta.net/r_1920_1080/pictures/18/09/20/08/44/5720467.jpg',

        ],
        'American Horror Story' => [
            'summary' => 'A chaque saison, son histoire. American Horror Story nous embarque dans des récits à la fois poignants et cauchemardesques, mêlant la peur, le gore et le politiquement correct.',
            'category' => 'Horreur',
            'poster' => 'https://www.scifinow.co.uk/wp-content/uploads/2019/08/american_horror_story_ver102_xlg.jpg',

        ],
        'Love Death And Robots' => [
            'summary' => 'Un yaourt susceptible, des soldats lycanthropes, des robots déchaînés, des monstres-poubelles, des chasseurs de primes cyborgs, des araignées extraterrestres et des démons assoiffés de sang : tout ce beau monde est réuni dans 18 courts métrages animés déconseillés aux âmes sensibles.',
            'category' => 'Horreur',
            'poster' => 'https://fr.web.img2.acsta.net/r_1920_1080/pictures/19/02/15/09/58/1377321.jpg',

        ],
        'Penny Dreadful' => [
            'summary' => 'Dans le Londres ancien, Vanessa Ives, une jeune femme puissante aux pouvoirs hypnotiques, allie ses forces à celles de Ethan, un garçon rebelle et violent aux allures de cowboy, et de Sir Malcolm, un vieil homme riche aux ressources inépuisables. Ensemble, ils combattent un ennemi inconnu, presque invisible, qui ne semble pas humain et qui massacre la population.',
            'category' => 'Horreur',
            'poster' => 'https://m.media-amazon.com/images/M/MV5BNmE5MDE0ZmMtY2I5Mi00Y2RjLWJlYjMtODkxODQ5OWY1ODdkXkEyXkFqcGdeQXVyNjU2NjA5NjM@._V1_SY1000_CR0,0,695,1000_AL_.jpg',

        ],
        'Fear The Walking Dead' => [
            'summary' => 'La série se déroule au tout début de l épidémie relatée dans la série mère The Walking Dead et se passe dans la ville de Los Angeles, et non à Atlanta. Madison est conseillère dans un lycée de Los Angeles. Depuis la mort de son mari, elle élève seule ses deux enfants : Alicia, excellente élève qui découvre les premiers émois amoureux, et son grand frère Nick qui a quitté la fac et a sombré dans la drogue.',
            'category' => 'Horreur',
            'poster' => 'https://m.media-amazon.com/images/M/MV5BYWNmY2Y1NTgtYTExMS00NGUxLWIxYWQtMjU4MjNkZjZlZjQ3XkEyXkFqcGdeQXVyMzQ2MDI5NjU@._V1_SY1000_CR0,0,666,1000_AL_.jpg',
        ],

        'Dexter' => [
            'summary' => 'Brillant expert scientifique du service médico-légal de la police de Miami, Dexter Morgan est spécialisé dans les tâches de sang. Mais voilà, Dexter cache aussi un terrible secret...',
            'category' => 'Action',
            'poster' => 'https://images-na.ssl-images-amazon.com/images/I/51-4vDjh-EL._AC_.jpg',
        ],

        'Chips' => [
            'summary' => 'Les aventures de Jon Baker et Francis Poncherello, deux motards de la brigade autoroutière de Los Angeles (California Highway Patrol).',
            'category' => 'Action',
            'poster' => 'https://media.senscritique.com/media/000006492278/source_big/CHi_Ps.jpg',
        ],

        'Friends' => [
            'summary' => 'Les péripéties de 6 jeunes newyorkais liés par une profonde amitié. Entre amour, travail, famille, ils partagent leurs bonheurs et leurs soucis au Central Perk, leur café favori...',
            'category' => 'Comédie',
            'poster' => 'https://www.kaakook.fr/img/affiche/big/affiche-1121.jpg',
        ],

        'H' => [
            'summary' => 'Dans un hôpital de banlieue parisienne, 3 internes entretiennent une ambiance un peu décalée. Entre gaffes, plaisanteries de mauvais goût et autres erreurs...',
            'category' => 'Comédie',
            'poster' => 'https://fr.web.img3.acsta.net/pictures/20/06/25/11/01/0914771.jpg',
        ],


    ];

    public function load(ObjectManager $manager)
    {
        $i = 0;
        foreach (self::PROGRAMS as $title => $data) {
            $program = new Program();
            $program->setTitle($title);
            $program->setSummary($data['summary']);
            $program->setCategory($this->getReference($data['category']));
            $program->setPoster($data['poster']);
            $manager->persist($program);
            $this->addReference('program_' . $i, $program);
            $i++;
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [CategoryFixtures::class];
    }

}
