<?php
namespace App\Models\Integration;

class LogObject
{/*{{{*/
    private $_fp = null;
    private $_file_name = '';

    public function __construct( $fname )
    {/*{{{*/
        $this->_file_name = $fname;
    }/*}}}*/

    public function log( $msg )
    {/*{{{*/
        if ( is_null( $this->_fp ) )
        {
            $this->_fp = fopen( $this->_file_name, 'a' );
        }
        $msg = '['.date( 'Y-m-d H:i:s' ).' '.$this->_getClientIP().'] '.$msg."\n";
		if( $this->_fp )
			fwrite( $this->_fp, $msg );
    }/*}}}*/

	private function _getClientIP()
	{/*{{{*/
		return isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '';
		//return $_SERVER['REMOTE_ADDR'];
	}/*}}}*/

    public function __destruct()
    {/*{{{*/
        if ( is_resource( $this->_fp ) )
        {
            fclose( $this->_fp );
        }
    }/*}}}*/
}/*}}}*/
?>
