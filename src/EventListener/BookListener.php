<?php
namespace App\EventListener;

use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpKernel\Event\KernelEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\Event\PostResponseEvent;
use Symfony\Component\HttpFoundation\RequestStack;
use App\Entity\Book;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class BookListener implements EventSubscriberInterface
{
    private $logger;
    private $em;
    private $requestStack;

    public function __construct(LoggerInterface $logger, EntityManagerInterface $em, RequestStack $requestStack)
    {
        $this->logger = $logger;
        $this->em = $em;
        $this->requestStack = $requestStack;
    }

    public function onKernelResponse(KernelEvent $event): void
    {
        $request = $this->requestStack->getCurrentRequest();
        if ($request && $request->attributes->get('_route') === 'book_new') {
            $book = $this->em->getRepository(Book::class)->findOneBy([], ['id' => 'DESC']);
            if ($book) {
                $this->logger->info('New book added: ' . $book->getTitle());
            }
        }
    }

    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::RESPONSE => 'onKernelResponse',
        ];
    }
}