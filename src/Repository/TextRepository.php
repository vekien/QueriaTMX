<?php

namespace App\Repository;

use App\Entity\Text;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class TextRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Text::class);
    }
    
    /**
     * Search for some translations
     */
    public function search(string $query, int $maxResults, int $option)
    {
        $sql = $this->createQueryBuilder('t');

        if ($option == 1) {
            $sql->where('t.original LIKE :original')->setParameter('original', "%{$query}%")
                ->orWhere('t.translated LIKE :translated')->setParameter('translated', "%{$query}%");
        }

        if ($option == 2) {
            $sql->where('t.original LIKE :original')->setParameter('original', "%{$query}%");
        }

        if ($option == 3) {
            $sql->where('t.translated LIKE :translated')->setParameter('translated', "%{$query}%");
        }

        return $sql->setMaxResults($maxResults)->getQuery()->getResult();
    }
}
