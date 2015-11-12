<?php
declare(strict_types = 1);
namespace Atanor\Graph\Edge;

interface MutableEdge
{
    /**
     * Set options
     * @param array|\ArrayAccess $options
     * @return MutableEdge
     */
    public function setOptions($options):MutableEdge;

    /**
     * Set ends
     * @param mixed $end1
     * @param mixed $end2
     * @return MutableEdge
     */
    public function setEnds(&$end1,&$end2):MutableEdge;
}