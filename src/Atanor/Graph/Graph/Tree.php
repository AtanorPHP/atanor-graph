<?php
declare(strict_types=1);
namespace Atanor\Graph\Graph;

use Atanor\Graph\Edge\DefaultEdge;

class Tree
{
    /**
     * Delegated graph
     * @var Graph
     */
    protected $graph;

    public function AddAsChild($node,$parent)
    {
        $arrow = new DefaultEdge($parent,$node);
        $this->graph->addEdge($arrow);
        return $this;
    }
}
