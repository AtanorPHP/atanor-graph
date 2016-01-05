<?php
declare(strict_types=1);
namespace Atanor\Graph\Graph;

use Atanor\Core\Exception\ApiException;
use Atanor\Graph\Edge\Edge;
use Atanor\Graph\Node\GraphAware;
use Atanor\Graph\Node\NodeIdProvider;

abstract class AbstractGraph implements Graph
{
    /**
     * @var array
     */
    protected $edges = [];

    /**
     * @var array
     */
    protected $nodes = [];

    /**
     * @var int
     */
    protected $currentIndex = 0;

    /**
     * Returns node
     * @param string $nodeId
     * @return mixed
     */
    public function getNodeById($nodeId)
    {
        if ( ! $this->hasNodeWithId($nodeId)) {
            throw new ApiException("Graph does not contain any node with id $nodeId");
        }
        return $this->nodes[$nodeId];
    }

    /**
     * @return mixed
     */
    public function getNodes():array
    {
        return $this->nodes;
    }

    /**
     * @inheritDoc
     */
    public function getEdges():array
    {
        return $this->edges;
    }


    /**
     * Returns node id
     * @param mixed $node
     * @return string
     */
    protected function getNodeId($node)
    {
        foreach ($this->nodes as $id => $innerNode) {
            if ($node === $innerNode) {
                return (string)$id;
            }
        }
        throw new ApiException("Node not found");
    }

    /**
     * @inheritdoc
     */
    public function removeNodeById($nodeId,bool $keepPendentEdges = false):Graph
    {
        $node = $this->getNodeById($nodeId);
        unset($this->nodes[$nodeId]);
        if ($keepPendentEdges == false) {
            foreach ($this->edges as &$edge) {
                if ($edge->contains($node)) {
                    $this->removeEdge($edge);
                }
            }
        }
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function removeNode($removedNode,bool $keepPendentEdges = false):Graph
    {
        $nodeId = $this->getNodeId($removedNode);
        return $this->removeNodeById($nodeId,$keepPendentEdges);
    }

    /**
     * Add node
     * @param mixed $node
     * @return Graph
     */
    public function addNode($node, string $nodeId = null):Graph
    {
        if ($this->hasNode($node)) return $this;
        if ( ! $nodeId) $nodeId = $this->computeNodeId($node);
        if ($node instanceof GraphAware) {
            if ($node->getGraph() !== $this) {
                $this->mergeWith($node->getGraph());
                $node->setGraph($this);
            }
        }
        $this->nodes[$nodeId] = $node;
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function addEdge(Edge &$edge,bool $addEndIfNotExists = false):Graph
    {
        if ($this->hasEdge($edge)) {
            return $this;
        }
        foreach($edge->getEnds() as $end) {
            if ($this->hasNode($end)) continue;
            if ($addEndIfNotExists) {
                $this->addNode($end);
            }
            else {
                throw new ApiException("Adding an edge that point to a node that is not contained in graph");
            }
        }
        $this->edges[] = $edge;
        return $this;
    }

    /**
     * @param             $node
     * @param string|null $nodeId
     * @return Graph
     */
    protected function addNodeWithNoMerge($node,string $nodeId = null):Graph
    {
        if ($this->hasNode($node)) return $this;
        if ( ! $nodeId) $nodeId = $this->computeNodeId($node);
        $this->nodes[$nodeId] = $node;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function hasEdge(Edge $edge):bool
    {
        foreach($this->edges as $test) {
            if ($test === $edge) return true;
        }
        return false;
        // this does not work : return in_array($edge,$this->edges);
    }

    /**
     * @inheritDoc
     */
    public function removeEdge(Edge $edge, $keepOrphanNode = false):Graph
    {
        if ( ! $this->hasEdge($edge)) {
            throw new ApiException("Edge doesn't exist");
        }
        if ($keepOrphanNode == false) {
            foreach ($edge->getEnds() as $end) {
                $edges = $this->getEdgesOfNode($end);
                if (count($edges) > 1) {
                    continue;
                }
                $this->removeNode($end,true);
            }
        }
        foreach ($this->edges as &$item) {
            if ($item === $edge) unset($item);
        }
    }

    /**
     * @inheritdoc
     */
    public function hasNode($node):bool
    {
        return in_array($node,$this->nodes);
    }

    /**
     * @inheritdoc
     */
    public function hasNodeWithId(string $nodeId):bool
    {
        return isset($this->nodes[$nodeId]);
    }

    /**
     * Compute and return node id
     * @param $node
     * @return string
     */
    public function computeNodeId($node):string
    {
        if (! is_object($node)) {
            return $this->getCurrentIndex();
        }
        if ($node instanceof NodeIdProvider) return $node->getNodeId();
        else {
            return spl_object_hash($node);
        }
    }

    /**
     * @inheritdoc
     */
    public function mergeWith(Graph $graph):Graph
    {
        foreach($graph->getNodes() as $node) {
            $this->addNodeWithNoMerge($node);
        }
        $this->edges = array_merge($this->edges,$graph->getEdges());
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function getEdgesOfNodeById(string $id):array
    {
        $edges = [];
        $node = $this->getNodeById($id);
        foreach($this->edges as $edge) {
            if ( ! $edge->contains($node)) continue;
            $edges[] = $edge;
        }
        return $edges;
    }

    /**
     * @inheritdoc
     */
    public function getEdgesOfNode($node):array
    {
        $nodeId = $this->getNodeId($node);
        return $this->getEdgesOfNodeById($nodeId);
    }

    /**
     * @return int
     */
    protected function getCurrentIndex()
    {
        return (string)$this->currentIndex++;
    }
}
