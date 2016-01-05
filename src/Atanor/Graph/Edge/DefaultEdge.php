<?php
declare(strict_types=1);
namespace Atanor\Graph\Edge;


class DefaultEdge implements Edge
{
    /**
     * Ends storage
     * @var \SplFixedArray
     */
    protected $ends;

    /**
     * @inheritdoc
     */
    public function getEnds():\SplFixedArray
    {
        return $this->ends;
    }

    /**
     * Constructor
     * @param mixed $node1
     * @param mixed $node2
     */
    public function __construct(&$node1,&$node2)
    {
        $this->ends = \SplFixedArray::fromArray([$node1,$node2]);
    }

    /**
     * @inheritdoc
     */
    public function contains(&$node):bool
    {
        foreach($this->getEnds() as $end){
            if ($end === $node) return true;
        }
        return false;
    }
}
