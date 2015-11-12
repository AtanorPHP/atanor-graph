<?php
declare(strict_types=1);
namespace Atanor\Graph\Edge;

class DefaultArrow extends DefaultEdge implements Arrow
{
    /**
     * @inheritdoc
     */
    public function getTail()
    {
        return $this->ends->offsetGet(0);
    }

    /**
     * @inheritdoc
     */
    public function getHead()
    {
        return $this->ends->offsetGet(1);
    }

    /**
     * @inheritdoc
     */
    public function swap()
    {
        $temp = $this->ends[0];
        $this->ends[0] = $this->ends[1];
        $this->ends[1] = $temp;
        unset($temp);
        return $this;
    }
}
