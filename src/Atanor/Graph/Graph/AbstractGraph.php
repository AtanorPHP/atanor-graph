<?php
declare(strict_types=1);
namespace Atanor\Graph\Graph;

use Atanor\Graph\Edge\Edge;

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
    protected $currentNodId = 0;

    /**
     * Returns node
     * @param string $nodeId
     * @return mixed
     */
    public function getNode($nodeId)
    {
        if ( ! isset($this->nodes[$nodeId])) return null;
        return $this->nodes[$nodeId];
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
    }

    /**
     * @inheritdoc
     */
    public function removeNodeById($nodeId):Graph
    {
        $node = $this->getNode($nodeId);
        if ( ! $node) return $this;
        foreach($this->edges as &$edge) {
            if ($edge->contains($node)) $this->deleteEdge($edge);
        }
        unset($this->nodes[$nodeId]);
        return $this;
    }

    /**
     * @inheritdoc
     */
    public function removeNode($removedNode):Graph
    {
        $nodeId = $this->getNodeId($removedNode);
        return $this->removeNodeById($nodeId);
    }

    /**
     * Delete edge
     * @param $deletedEdge
     * @return Graph
     */
    protected function deleteEdge(Edge $deletedEdge):Graph
    {
        foreach ($this->edges as &$edge) {
            if ($edge === $deletedEdge) unset($edge);
        }
        return $this;
    }

    /**
     * Add node
     * @param mixed $node
     * @return int
     */
    protected function addNode(&$node,$nodeId)
    {
        if ($this->contains($node)) return null;
        $this->nodes[$nodeId] = $node;
        return $nodeId;
    }

    /**
     * @param Edge $edge
     * @return bool
     */
    protected function addEdge(&$edge)
    {
        if (in_array($edge,$this->edges)) return false;
        foreach($edge->getEnds() as $end) {
            if ( ! $this->contains($end)) return $this;
        }
        $this->edges[] = $edge;
        return true;
    }

    /**
     * @inheritdoc
     */
    public function contains($node):bool
    {
        return in_array($node,$this->nodes);
    }

    /**
     * @inheritdoc
     */
    public function containsNodeId($nodeId):bool
    {
        return isset($this->nodes[$nodeId]);
    }

}
