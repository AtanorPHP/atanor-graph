<?php
declare(strict_types=1);
namespace Atanor\Graph\Graph;

interface Graph
{
    /**
     *
     * @param string $nodeId
     * @return mixed
     */
    public function getNode($nodeId);

    /**
     * Remove node
     * @param string $nodeId
     * @return Graph
     */
    public function removeNodeById($nodeId):Graph;

    /**
     * Remove node
     * @param mixed $node
     * @return Graph
     */
    public function removeNode($node):Graph;

    /**
     * Returns true if graph contains node
     * @param mixed $node
     * @return bool
     */
    public function contains($node):bool;

    /**
     * @param $nodeId
     * @return bool
     */
    public function containsNodeId($nodeId):bool;
}
