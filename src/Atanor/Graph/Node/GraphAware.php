<?php
declare(strict_types = 1);
namespace Atanor\Graph\Node;

use Atanor\Graph\Graph\Graph;

interface GraphAware
{
    /**
     * @return Graph
     */
    public function getGraph():Graph;

    /**
     * @param Graph $graph
     * @return mixed
     */
    public function setGraph(Graph $graph):GraphAware;
}
