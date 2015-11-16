<?php
declare(strict_types = 1);
namespace Atanor\Graph\Node;

interface NodeIdProvider
{
    /**
     * Returns node id
     * @return string
     */
    public function getNodeId():string;
}

