<?php
declare(strict_types=1);
namespace Atanor\Graph\Graph;

use Atanor\Graph\Edge\Edge;

interface Graph
{
    /**
     *
     * @param string $nodeId
     * @return mixed
     */
    public function getNodeById($nodeId);

    /**
     * @return mixed
     */
    public function getNodes():array;

    /**
     * Add a new node
     * @param mixed$node
     * @param string $nodeId
     * @return Graph
     */
    public function addNode($node,string $nodeId = null):Graph;

    /**
     * Remove node
     * @param string $nodeId
     * @param $keepPendentEdges bool
     * @return Graph
     */
    public function removeNodeById($nodeId,bool $keepPendentEdges = false):Graph;

    /**
     * Remove node
     * @param mixed $node
     * @param $keepPendentEdges bool
     * @return Graph
     */
    public function removeNode($node,bool $keepPendentEdges = false):Graph;

    /**
     * Returns true if graph contains node
     * @param mixed $node
     * @return bool
     */
    public function hasNode($node):bool;

    /**
     * @param string $nodeId
     * @return bool
     */
    public function hasNodeWithId(string $nodeId):bool;

    /**
     * @param Edge $edge
     * @param bool $addEndIfNotExists
     * @return Graph
     */
    public function addEdge(Edge &$edge,bool $addEndIfNotExists = false):Graph;

    /**
     * @param Edge $edge
     * @return bool
     */
    public function hasEdge(Edge $edge):bool;

    /**
     * @param Edge $edge
     * @param bool $keepOrphanNode
     * @return Graph
     */
    public function removeEdge(Edge $edge,$keepOrphanNode = false):Graph;

    /**
     * @param Graph $graph
     * @return Graph
     */
    public function mergeWith(Graph $graph):Graph;

    /**
     * @param strin $
     * @return mixed
     */
    public function getEdgesOfNodeById(string $id):array;

    /**
     * @param $node
     * @return mixed
     */
    public function getEdgesOfNode($node):array;

    /**
     * @return mixed
     */
    public function getEdges():array;
}
