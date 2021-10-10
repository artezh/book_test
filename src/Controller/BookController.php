<?php

namespace App\Controller;

use App\Entity\Book;
use App\Form\BookFormType;
use App\Form\DeleteForm;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\{
    Template, IsGranted
};
use Symfony\Component\HttpFoundation\{
    Request, RedirectResponse
};
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route ("/book")
 * @IsGranted("IS_AUTHENTICATED_FULLY")
 */
class BookController extends AbstractController
{
    /**
     * Список книг
     *
     * @Route ("", name="books_alias", methods={"GET"})
     * @Route ("s", name="books", methods={"GET"})
     * @Route ("/list", name="book_list", methods={"GET"})
     * @Template("view/book/list.html.twig")
     *
     * @return array
     */
    public function grid()
    {
        $books = $this->getDoctrine()
            ->getRepository(Book::class)
            ->findBy([], ['id' => 'ASC']);

        return [
            'title' => 'Список книг',
            'books' => $books
        ];

    }

    /**
     * Удаление книги
     *
     * @Route ("/remove/{id}", name="book_del", requirements={"id"="\d+"}, methods={"GET","POST", "DELETE"})
     * @Template("form/delete.html.twig")
     */
    public function deleteBook(Request $request, Book $book)
    {
        $form = $this->createForm(DeleteForm::class, $book);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $em->remove($book);
            $em->flush();

            return $this->redirectToRoute('books');
        }

        return [
            'entity' => $book,
            'form' => $form->createView(),
        ];

    }

    /**
     * Форма добавления/редактирования данных о книге
     *
     * @Route ("/edit/{id}", name="book_edit", requirements={"id"="\d+"}, methods={"GET","POST"})
     * @Route ("/add", name="book_add", methods={"GET","POST"})
     * @Template("view/book/form.html.twig")
     *
     * @param Request $request
     * @param Book|null $book
     *
     * @return array|RedirectResponse
     */
    public function form(Request $request, Book $book = null)
    {
        if (null === $book) {
            $book = new Book();
        }

        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm(BookFormType::class, $book);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($book);
            $em->flush();

            return $this->redirectToRoute('book_list');
        }

        return [
            'entity' => $book,
            'form' => $form->createView()
        ];
    }
}