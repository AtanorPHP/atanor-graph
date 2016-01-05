<?php
declare(strict_types = 1);
namespace Atanor\Graph\Graph;

interface DirectedGraph extends Graph
{
    /**
     * @param $node
     * @return mixed
     */
    public function getChildren($node):array;

    /**
     * List of egdes pointing to children
     * @param $node
     * @return mixed
     */
    public function getChildrenEdges($node):array;

    /**
     * @param $node
     * @return bool
     */
    public function hasChildren($node):bool;

    /**
     * @param $node
     * @return mixed
     */
    public function getParents($node):array;

    /**
     * @param $node
     * @return mixed
     */
    public function getParentEgdes($node):array;

    /**
     * @param $node
     * @return mixed
     */
    public function hasParents($node):array;
}