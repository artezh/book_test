<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

/**
 * Класс для генерации тестовых (фиктивных) данных для таблицы user
 */
class UserFixtures extends Fixture
{
    /**
     * @var UserPasswordHasherInterface
     */
    private $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        $user = new User();

        $user->setPassword($this->passwordHasher->hashPassword(
            $user,
            'nimda'
        ));
        $user->setEmail('admin@google.com');
        $user->setRoles(['ROLE_ADMIN', 'ROLE_USER']);
        $user->setIsActive(true);

        $manager->persist($user);
        $manager->flush();
    }
}
