<?php

namespace App\DataFixtures;

use App\Entity\{
    Author, Book
};
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

/**
 * Класс для генерации тестовых (фиктивных) данных для таблицы book
 */
class BookFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $books = [
            ['Булгаков М.А.', 'Белая гвардия', 50010],
            ['Булгаков М.А.', 'Мастер и Маргарита', 78090],
            ['Аркадий и Борис Стругацкие', 'Трудно быть богом', 45500],
            ['Аркадий и Борис Стругацкие', 'Понедельник начинается в субботу', 95500],
            ['Илья Ильф и Евгений Петров', '12 стульев', 35999],
            ['Илья Ильф и Евгений Петров', 'Золотой теленок', 85500],
            ['Шолохов М.А.', 'Тихий Дон', 63720],
            ['Шолохов М.А.', 'Поднятая целина', 53720],
            ['Шолохов М.А.', 'Они сражались за Родину', 83720],
            ['Максим Горький', 'Цикл очерков «В Америке»', 58759],
        ];

        array_map (function($item) use (&$manager) {
            $author = $manager
                ->getRepository(Author::class)
                ->findOneBy([
                    'name' => $item[0]
                ]);
            if (null !== $author) {
                $book = new Book();

                $book->setAuthor($author);
                $book->setTitle($item[1]);
                $book->setPrice($item[2]);

                $manager->persist($book);
            }
        }, $books);

        $manager->flush();
    }
}
