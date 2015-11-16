<?php
declare(strict_types=1);
namespace Atanor\Graph\Edge;

interface Edge
{
    /**
     * Returns ends
     * @return \Traversable|\ArrayAccess
     */
    public function getEnds():\SplFixedArray;

    /**
     * Returns true if edge points to the node
     * @param mixed $node
     * @return bool
     */
    public function contains(&$node):bool;
}
