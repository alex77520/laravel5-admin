<?php

namespace App\Models\Integration;
use Illuminate\Database\Eloquent\Model;
use DB;

class Idgenter extends Model
{/*{{{*/
    const DEF_OBJ    = 'other';
    const TABLE_NAME = 'zb_id_genter';

    private $executor;
    private $container;

    public function __construct( $executor = '')
    {/*{{{*/
        $this->executor  = $executor;
        $this->container = array();
    }/*}}}*/

    public function creates( $obj = self::DEF_OBJ )
    {/*{{{*/
        if ( false === $this->hasReg( $obj ) )
        {
            $this->reg( $obj );
        }

        if ( $this->full( $obj ) )
        {
            $this->renew( $obj );
        }

        $this->container[$obj]['id']++;
        return ( string ) $this->container[$obj]['id'];
    }/*}}}*/

    private function hasReg( $obj )
    {/*{{{*/
        return array_key_exists( $obj, $this->container );
    }/*}}}*/

    private function reg( $obj )
    {/*{{{*/
        $sql = 'select id, step ';
        $sql.= 'from '.self::TABLE_NAME.' ';
        $sql.= "where obj = '".$obj."' ";

        $row = DB::select($sql);

        if ( is_null( $row ) )
        {
            return false;
        }

        $info = array( 'id' => $row[0]->id, 'step' => $row[0]->step, 'max_id' => $row[0]->id );
        $this->container[$obj] = $info;
        return true;
    }/*}}}*/

    private function full( $obj )
    {/*{{{*/
        if ( $this->container[$obj]['id'] == $this->container[$obj]['max_id'] )
        {
            return true;
        }
        return false;
    }/*}}}*/

    private function renew( $obj )
    {/*{{{*/
        $sql = 'update '.self::TABLE_NAME.' set ';
        $sql.= 'id = last_insert_id( id + '.$this->container[$obj]['step'].' ) ';
        $sql.= "where obj = '".$obj."' ";

        if ( false === DB::update( $sql ) )
        {
            return false;
        }

        $sql = "select id from ".self::TABLE_NAME." where obj = '".$obj."'";
        $row = DB::select( $sql );
        if ( is_null( $row ) )
        {
            return false;
        }

        $this->container[$obj]['max_id'] = $row[0]->id;
        $this->container[$obj]['id'] = $row[0]->id - $this->container[$obj]['step'];
        return true;
    }/*}}}*/
}/*}}}*/
?>
