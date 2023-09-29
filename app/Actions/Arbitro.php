<?php

namespace App\Actions;

use TCG\Voyager\Actions\AbstractAction;

// Models
use App\Models\Tournament;

class Arbitro extends AbstractAction
{
    public function getTitle()
    {
        return 'Arbitros';
    }

    public function getIcon()
    {
        return 'voyager-alarm-clock';
    }

    public function getPolicy()
    {
        return 'add';
    }

    public function getAttributes()
    {
        return [
            'class' => 'btn btn-sm btn-success pull-right',
            'style' => 'margin: 5px;',
        ];
    }

    public function getDefaultRoute()
    {
        return '#';
    }
    
    public function shouldActionDisplayOnDataType()
    {
        return $this->dataType->slug == 'tournaments';
    }
}