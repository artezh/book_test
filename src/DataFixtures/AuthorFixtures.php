<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Author;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

/**
 * Класс для генерации тестовых (фиктивных) данных для таблицы author
 */
class AuthorFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $authorsList = [
            'Булгаков М.А.',
            'Аркадий и Борис Стругацкие',
            'Илья Ильф и Евгений Петров',
            'Шолохов М.А.',
            'Максим Горький',
        ];

        foreach ($authorsList as $authorName) {
            $author = new Author();
            $author->setName($authorName);

            $manager->persist($author);
        }
        $manager->flush();
    }
}
