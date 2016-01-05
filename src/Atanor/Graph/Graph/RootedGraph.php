<?php
declare(strict_types = 1);
namespace Atanor\Graph;

interface RootedGraph
{
    /**
     * Return root node
     * @return mixed
     */
    public function getRoot();

    /**
     * Set given node has graph
     * @param $node
     * @return RootedGraph
     */
    public function setRoot(&$node):RootedGraph;
}