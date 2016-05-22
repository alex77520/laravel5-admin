<?php

namespace App\Models\Dao;

use App\Models\Integration\Idgenter;
use Illuminate\Database\Eloquent\Model;

class BaseDao extends Model
{/*{{{*/
    protected function getNewId()
    {/*{{{*/
        $idgenter = new Idgenter();
        return $idgenter->creates($this->table);
    }/*}}}*/

    protected function objtoarray($obj)
    {/*{{{*/
        return json_decode(json_encode($obj), true);
    }/*}}}*/

    protected function getPreName()
    {/*{{{*/
        return 'cm';
    }/*}}}*/

    public $timestamps = false;

}/*}}}*/
