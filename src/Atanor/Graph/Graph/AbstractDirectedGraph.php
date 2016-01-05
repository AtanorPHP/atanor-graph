<?php
declare(strict_types = 1);
namespace Atanor\Graph\Graph;

use Atanor\Graph\Edge\Arrow;

abstract class AbstractDirectedGraph extends AbstractGraph implements DirectedGraph
{
    /**
     * @inheritDoc
     */
    public function getChildrenEdges($node):array
    {
        $childrenEdges = [];
        foreach($this->getEdgesOfNode($node) as $edge) {
            if ( ! $edge instanceof Arrow) continue;
            if ($edge->getTail() !== $node) continue;
            $childrenEdges[] = $edge;
        }
        return $childrenEdges;
    }

    /**
     * @inheritDoc
     */
    public function getChildren($node):array
    {
        $children = [];
        foreach($this->getChildrenEdges($node) as $edge ) {
            $children[] = $edge->getHead();
        }
        return $children;
    }

    /**
     * @inheritDoc
     */
    public function hasChildren($node):bool
    {
        foreach($this->getEdgesOfNode($node) as $edge) {
            if ( ! $edge instanceof Arrow) continue;
            if ($edge->getTail() !== $node) continue;
            return true;
        }
        return false;
    }

    /**
     * @inheritDoc
     */
    public function getParentEgdes($node):array
    {
        $parentEdges = [];
        foreach($this->getEdgesOfNode($node) as $edge) {
            if ( ! $edge instanceof Arrow) continue;
            if ($edge->getHead() !== $node) continue;
            $parentEdges[] = $edge;
        }
        return $parentEdges;
    }


    /**
     * @inheritDoc
     */
    public function getParents($node):array
    {
        $parents = [];
        foreach($this->getParentEgdes($node) as $edge) {
            $parents[] = $edge->getTail();
        }
        return $parents;
    }

    /**
     * @inheritDoc
     */
    public function hasParents($node):array
    {
        foreach($this->getEdgesOfNode($node) as $edge) {
            if ( ! $edge instanceof Arrow) continue;
            if ($edge->getHead() !== $node) continue;
            return true;
        }
        return false;
    }
}