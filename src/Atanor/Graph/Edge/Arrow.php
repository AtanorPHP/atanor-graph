<?php
declare(strict_types=1);
namespace Atanor\Graph\Edge;

interface Arrow extends Edge
{
    /**
     * Returns head
     * @return mixed
     */
    public function getHead();

    /**
     * Returns tail
     * @return mixed
     */
    public function getTail();

    /**
     * Swap arrow direction
     * @return $this
     */
    public function swap():Arrow;
}
