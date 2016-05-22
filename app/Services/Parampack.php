<?php
namespace App\Services;
/**
 * 参数服务类.
 *
 */
use App\Models\Bizservice\YException;

class Parampack
{/*{{{*/
    const PIC = 'http://img1.kuwo.cn/star/picServer/62/25/1457403201525_100.jpg';
    const BPIC = 'http://img1.kuwo.cn/star/picServer/62/25/1457403201525.jpg';
    private $_id = 0;
    private $_uid = 0;
    private $_liveid = 0;
    private $_liveth = 0;
    private $_live = '';
    private $_lid = 0;
    private $_objid = 0;
    private $_objids = 0;
    private $_nickname = '';
    private $_pname = '';
    private $_sname = '';
    private $_username = '';
    private $_userid = '';
    private $_ipaddr = '';
    private $_content = '';
    private $_showfile = '';
    private $_status = 0;
    private $_pstatus = 0;
    private $_bpic = '';
    private $_liveurl = '';
    private $_push_stream = '';
    private $_pull_stream = '';
    private $_live_stream = '';
    private $_imurl = '';
    private $_feedbackproblem = '';
    private $_job = '';
    private $_msg = '';
    private $_hobby = '';
    private $_showskill = '';
    private $_birthday = '';
    private $_weibo = '';

    private $_mapid = 0;

    private $_name = '';
    private $_telephone = 0;
    private $_qq = 0;
    private $_idcardfrontimg = '';
    private $_idcardoppositeimg = '';
    private $_idcardno = 0;
    private $_iccardno = 0;
    private $_iccardbank = '';
    private $_iccardsubbank = '';
    private $_iccardadd = '';
    private $_usershowfile = '';

    private $_receipt = '';

    private $_sid = null;
    private $_devid   = null;
    private $_devname = null;
    private $_devtype = null;
    private $_type = null;
    private $_devresolution = null;
    private $_version = null;
    private $_src     = null;
    private $_sx     = null;
    private $_sex     = 0;
    private $_from = null;
    private $_platform = null;
    private $_signature = null;
    private $_pic = null;
    private $_offset = 0;
    private $_location = 0;
    private $_ulocation = 0;
    private $_pnums = 0;
    private $_num = 0;
    private $_pid = 0;
    private $_gid = 0;
    private $_cdn_type = 0;

    private $_pn = 0;
    private $_rn = 0;
    private $_start = 0;
    private $_pagesize = 0;

    private $_ky = null;
    private $_time = 0;
    private $_credit = 0;
    private $_paytype = 0;
    private $_agentid = 0;
    private $_customerid = null;
    private $_opid = 0;
    private $_loginsource = 0;

    private $_goodsname;
    private $_category;
    private $_price;
    private $_taobaosku;


    /**
     * Parampack constructor.
     * @param array $arr
     */
    public function __construct($arr = array())
    {/*{{{*/
        $this->_id      = isset($arr['id']) ? $arr['id'] : 0;
        $this->_uid      = isset($arr['uid']) ? $arr['uid'] : 0;
        $this->_pn      = isset($arr['pn']) ? $arr['pn'] : 0;
        $this->_rn      = isset($arr['rn']) ? $arr['rn'] : 0;
        $this->_cdn_type      = isset($arr['cdn_type']) ? $arr['cdn_type'] : 0;

        $this->_name        = isset($arr['name']) ? $arr['name'] : ''; 
        $this->_telephone   = isset($arr['telephone']) ? $arr['telephone'] : 0;        
        $this->_qq          = isset($arr['qq']) ? $arr['qq'] : 0;        
        $this->_idcardno    = isset($arr['idcardno']) ? $arr['idcardno'] : 0;        
        $this->_iccardno    = isset($arr['iccardno']) ? $arr['iccardno'] : 0;        
        $this->_iccardbank  = isset($arr['iccardbank']) ? $arr['iccardbank'] : '';         
        $this->_iccardadd   = isset($arr['iccardadd']) ? $arr['iccardadd'] : '';         
        $this->_usershowfile        = isset($arr['usershowfile']) ? $arr['usershowfile'] : '';
        $this->_iccardsubbank       = isset($arr['iccardsubbank']) ? $arr['iccardsubbank'] : '';         
        $this->_idcardfrontimg      = isset($arr['idcardfrontimg']) ? $arr['idcardfrontimg'] : '';         
        $this->_idcardoppositeimg   = isset($arr['idcardoppositeimg']) ? $arr['idcardoppositeimg'] : '';
        $this->_loginsource   = isset($arr['loginsource']) ? $arr['loginsource'] : '';

        $this->_start      = isset($arr['start']) ? $arr['start'] : 0;
        $this->_pagesize      = isset($arr['pagesize']) ? $arr['pagesize'] : 0;
        $this->_liveid      = isset($arr['liveid']) ? $arr['liveid'] : 0;
        $this->_liveth      = isset($arr['liveth']) ? $arr['liveth'] : 0;
        $this->_live      = isset($arr['live']) ? $arr['live'] : '';
        $this->_showfile      = isset($arr['showfile']) ? $arr['showfile'] : '';
        $this->_lid      = isset($arr['liveid']) ? $arr['liveid'] : 0;
        $this->_objid      = isset($arr['objid']) ? $arr['objid'] : 0;
        $this->_objids      = isset($arr['objids']) ? $arr['objids'] : 0;
        $this->_mapid      = isset($arr['mapid']) ? $arr['mapid'] : 0;
        $this->_nickname    = isset($arr['nickname']) ? $arr['nickname'] : '';
        $this->_birthday    = isset($arr['birthday']) ? $arr['birthday'] : '';
        $this->_job    = isset($arr['job']) ? $arr['job'] : '';
        $this->_pname    = isset($arr['pname']) ? $arr['pname'] : '';
        $this->_sname    = isset($arr['sname']) ? $arr['sname'] : '';
        $this->_username    = isset($arr['username']) ? $arr['username'] : '';
        $this->_userid    = isset($arr['userid']) ? $arr['userid'] : '';
        $this->_ipaddr   = isset($arr['ipaddr']) ? $arr['ipaddr'] : '';
        $this->_status   = isset($arr['status']) ? $arr['status'] : 0;
        $this->_pstatus  = isset($arr['pstatus']) ? $arr['pstatus'] : 0;
        $this->_bpic    = isset($arr['bpic']) ? $arr['bpic'] : '';
        $this->_weibo    = isset($arr['weibo']) ? $arr['weibo'] : '';
        $this->_content    = isset($arr['content']) ? $arr['content'] : '';
        $this->_liveurl  = isset($arr['liveurl']) ? $arr['liveurl'] : '';
        $this->_receipt  = isset($arr['receipt']) ? $arr['receipt'] : '';
        $this->_hobby  = isset($arr['hobby']) ? $arr['hobby'] : '';
        $this->_push_stream  = isset($arr['push_stream']) ? $arr['push_stream'] : '';
        $this->_pull_stream  = isset($arr['pull_stream']) ? $arr['pull_stream'] : '';
        $this->_live_stream  = isset($arr['live_stream']) ? $arr['live_stream'] : '';
        $this->_showskill  = isset($arr['showskill']) ? $arr['showskill'] : '';
        $this->_imurl    = isset($arr['imurl']) ? $arr['imurl'] : '';
        $this->_sid      = isset($arr['sid']) ? $arr['sid'] : '';
        $this->_devid    = isset($arr['dev_id']) ? $arr['dev_id'] : '';
        $this->_devname    = isset($arr['dev_name']) ? $arr['dev_name'] : '';
        $this->_devtype    = isset($arr['devType']) ? $arr['devType'] : '';
        $this->_type    = isset($arr['type']) ? $arr['type'] : '';
        $this->_devresolution    = isset($arr['devResolution']) ? $arr['devResolution'] : '';
        $this->_feedbackproblem    = isset($arr['feedbackproblem']) ? $arr['feedbackproblem'] : '';
        $this->_version  = isset($arr['version']) ? $arr['version'] : '';
        $this->_src      = isset($arr['src']) ? $arr['src'] : '';
        $this->_sx       = isset($arr['sx']) ? $arr['sx'] : '';
        $this->_sex       = isset($arr['sex']) ? $arr['sex'] : '';
        $this->_platform = isset($arr['plat']) && !empty($arr['plat']) ? $arr['plat'] : 'vz';
        $this->_from = isset($arr['from']) ? $arr['from'] : '';
        $this->_offset   = isset($arr['offset']) ? $arr['offset'] : 0;
        $this->_signature   = isset($arr['signature']) ? $arr['signature'] : 0;
        $this->_pic   = isset($arr['pic']) ? $arr['pic'] : 0;
        $this->_location   = isset($arr['location']) ? $arr['location'] : 0;
        $this->_ulocation   = isset($arr['ulocation']) ? $arr['ulocation'] : 0;
        $this->_num   = isset($arr['num']) ? $arr['num'] : 0;
        $this->_pid   = isset($arr['pid']) ? $arr['pid'] : 0;
        $this->_gid   = isset($arr['gid']) ? $arr['gid'] : 0;
        $this->_pnums   = isset($arr['pnums']) ? $arr['pnums'] : 0;
        $this->_msg   = isset($arr['msg']) ? $arr['msg'] : "";
        $this->_ky    = isset($arr['key']) ? $arr['key'] : "";
        $this->_time  = isset($arr['time']) ? $arr['time'] : 0;
        $this->_credit = isset($arr['credit']) ? $arr['credit'] : 0;
        $this->_paytype = isset($arr['payType']) ? $arr['payType'] : 0;
        $this->_agentid = isset($arr['agentId']) ? $arr['agentId'] : 0;
        $this->_customerid = isset($arr['customerid']) ? $arr['customerid'] : '';
        $this->_opid = isset($arr['openid']) ? $arr['openid'] : 0;

        $this->_goodsname = isset($arr['goodsname']) ? $arr['goodsname'] : 0;
        $this->_category = isset($arr['category']) ? $arr['category'] : 0;
        $this->_price = isset($arr['price']) ? $arr['price'] : 0;
        $this->_taobaosku = isset($arr['taobaosku']) ? $arr['taobaosku'] : 0;
    }/*}}}*/

    public function getId()
    {/*{{{*/
        $id = intval($this->_id);
        if (0 == $id) abort(YException::PARAMS_ERROR, 'Id');
        return $id;
    }/*}}}*/

    public function getUid()
    {/*{{{*/
        $uid = intval($this->_uid);
        if (0 == $uid) abort(YException::PARAMS_ERROR, 'Uid');
        return $uid;
    }/*}}}*/

    public function getUserid()
    {/*{{{*/
        $userid = intval($this->_userid);
        if (0 == $userid) abort(YException::PARAMS_ERROR, 'Userid');
        return $userid;
    }/*}}}*/

    public function getPn()
    {/*{{{*/
        $pn = intval($this->_pn);
        return $pn < 0 ? 0 : $pn;
    }/*}}}*/

    public function getRn()
    {/*{{{*/
        $rn = intval($this->_rn);
        return 20;
    }/*}}}*/

    public function getNum()
    {/*{{{*/
        $rn = intval($this->_num);
        return $rn;
    }/*}}}*/

    public function getPid()
    {/*{{{*/
        $pid = intval($this->_pid);
        if (0 == $pid) abort(YExeption::PARAMS_ERROR, 'Pid');
        return $pid;
    }/*}}}*/

    public function getGid()
    {/*{{{*/
        $gid = intval($this->_gid);
        if (0 == $gid) abort(YExeption::PARAMS_ERROR, 'Gid');
        return $gid;
    }/*}}}*/

    public function getPresentid()
    {/*{{{*/
        $pid = intval($this->_pid);
        return $pid;
    }/*}}}*/

    public function getUlocation()
    {/*{{{*/
        $ulocation = strip_tags($this->_ulocation);
        if($ulocation)
        {
            return $ulocation;
        }
        abort(YException::PARAMS_ERROR, 'Ulocation');
    }/*}}}*/

    public function getMapid()
    {/*{{{*/
        $mapid = intval($this->_mapid);
        if($mapid)
        {
            return $mapid;
        }
        abort(YException::PARAMS_ERROR, 'Mapid');
    }/*}}}*/

    public function getStart()
    {/*{{{*/
        $start = intval($this->_start);
        return $start;
    }/*}}}*/

    public function getLoginsource()
    {/*{{{*/
        $loginsource = intval($this->_loginsource);
        return $loginsource;
    }/*}}}*/

    public function getPagesize()
    {/*{{{*/
        $pagesize = intval($this->_pagesize);
        return $pagesize;
    }/*}}}*/

    public function getLiveid()
    {/*{{{*/
        $liveid = intval($this->_liveid);
        if (0 == $liveid) abort(YException::PARAMS_ERROR, 'Liveid');
        return $liveid;
    }/*}}}*/

    public function getGoodsname()
    {/*{{{*/
        $goodsname = strip_tags($this->_goodsname);
        if($goodsname) return $goodsname;
        abort(YException::PARAMS_ERROR, 'goodsname');
    }/*}}}*/

    public function getCategory()
    {/*{{{*/
        $category = strip_tags($this->_category);
        if ($category) return $category;
        abort(YException::PARAMS_ERROR, 'category');
    }/*}}}*/

    public function getPrice()
    {/*{{{*/
        $price = strip_tags($this->_price);
        if ($price) return $price;
        abort(YException::PARAMS_ERROR, 'price');
    }/*}}}*/

    public function getTaobaosku()
    {/*{{{*/
        $taobaosku = intval($this->_taobaosku);
        if (0 == $taobaosku) abort(YException::PARAMS_ERROR, 'taobaosku');
        return $taobaosku;
    }/*}}}*/

    public function getLid()
    {/*{{{*/
        $liveid = intval($this->_lid);
        return $liveid;
    }/*}}}*/

    public function getCdn_type()
    {/*{{{*/
        $_cdn_type = intval($this->_cdn_type);
        return $_cdn_type;
    }/*}}}*/

    public function getSid()
    {/*{{{*/
        $sid = intval($this->_sid);
        if (!$sid) abort(YException::PARAMS_ERROR, 'Sid');
        return $sid;
    }/*}}}*/

    public function getSex()
    {/*{{{*/
        $sex = intval($this->_sex);
        return $sex;
    }/*}}}*/

    public function getObjid()
    {/*{{{*/
        $objid = intval($this->_objid);
        if (0 == $objid) abort(YException::PARAMS_ERROR, 'Objid');
        return $objid;
    }/*}}}*/

    public function getObjids()
    {/*{{{*/
        $objids = $this->_objids;
        if (0 == $objids) abort(YException::PARAMS_ERROR, 'Objids');
        return $objids;
    }/*}}}*/

    public function getDevid()
    {/*{{{*/
        $devid = intval($this->_devid);
        return $devid;
    }/*}}}*/

    public function getDevName()
    {/*{{{*/
        $devname = strip_tags($this->_devname);
        if($devname)
        {
            return $devname;
        }
        abort(YException::PARAMS_ERROR, 'DevName');
    }/*}}}*/

    public function getSignature()
    {/*{{{*/
        return strip_tags($this->_signature);
    }/*}}}*/

    public function getDevType()
    {/*{{{*/
        $devtype = strip_tags($this->_devtype);
        if($devtype)
        {
            return $devtype;
        }
        abort(YException::PARAMS_ERROR, 'Devtype');
    }/*}}}*/

    public function getLive()
    {/*{{{*/
        $live = strip_tags($this->_live);
        if($live)
        {
            return $live;
        }
        abort(YException::PARAMS_ERROR, 'Live');
    }/*}}}*/

    public function getShowfile()
    {/*{{{*/
        $showfile = strip_tags($this->_showfile);
        return $showfile;
    }/*}}}*/

    
    public function getTelephone()
    {/*{{{*/
        $telephone = intval($this->_telephone);
        return $telephone;
    }/*}}}*/


    public function getQq()
    {/*{{{*/
        $qq = intval($this->_qq);
        if($qq)
        {
            return $qq;
        }
        abort(YException::PARAMS_ERROR, 'qq');
    }/*}}}*/

    public function getIdcardfrontimg()
    {/*{{{*/
        $idcardfrontimg = strip_tags($this->_idcardfrontimg);
        if($idcardfrontimg)
        {
            return $idcardfrontimg;
        }
        abort(YException::PARAMS_ERROR, 'idcardfrontimg');
    }/*}}}*/

    public function getIdcardoppositeimg()
    {/*{{{*/
        $idcardoppositeimg = strip_tags($this->_idcardoppositeimg);
        if($idcardoppositeimg)
        {
            return $idcardoppositeimg;
        }
        abort(YException::PARAMS_ERROR, 'idcardoppositeimg');
    }/*}}}*/

    public function getIdcardno()
    {/*{{{*/
        $idcardno = intval($this->_idcardno);
        if($idcardno)
        {
            return $idcardno;
        }
        abort(YException::PARAMS_ERROR, 'idcardno');
    }/*}}}*/

    public function getIccardno()
    {/*{{{*/
        $iccardno = intval($this->_iccardno);
        if($iccardno)
        {
            return $iccardno;
        }
        abort(YException::PARAMS_ERROR, 'iccardno');
    }/*}}}*/


    public function getIccardbank()
    {/*{{{*/
        $iccardbank = strip_tags($this->_iccardbank);
        if($iccardbank)
        {
            return $iccardbank;
        }
        abort(YException::PARAMS_ERROR, 'iccardbank');
    }/*}}}*/

    public function getName()
    {/*{{{*/
        $name = strip_tags($this->_name);
        if($name)
        {
            return $name;
        }
        abort(YException::PARAMS_ERROR, 'Name');
    }/*}}}*/


    public function getUsershowfile()
    {/*{{{*/
        $usershowfile = strip_tags($this->_usershowfile);
        if($usershowfile)
        {
            return $usershowfile;
        }
        abort(YException::PARAMS_ERROR, 'usershowfile');
    }/*}}}*/

    public function getIccardadd()
    {/*{{{*/
        $iccardadd = strip_tags($this->_iccardadd);
        if($iccardadd)
        {
            return $iccardadd;
        }
        abort(YException::PARAMS_ERROR, 'iccardadd');
    }/*}}}*/

    public function getIccardsubbank()
    {/*{{{*/
        $iccardsubbank = strip_tags($this->_iccardsubbank);
        if($iccardsubbank)
        {
            return $iccardsubbank;
        }
        abort(YException::PARAMS_ERROR, 'iccardsubbank');
    }/*}}}*/

    public function getReceipt()
    {/*{{{*/
        $receipt = $this->_receipt;
        if($receipt)
        {
            $receipt = str_replace(' ', '+', $receipt);
            return $receipt;
        }
        abort(YException::PARAMS_ERROR, 'receipt');
    }/*}}}*/

    public function getType()
    {/*{{{*/
        return $this->_type ? $this->_type : 0;
    }/*}}}*/

    public function getDevResolution()
    {/*{{{*/
        $devresolution = strip_tags($this->_devresolution);
        if($devresolution)
        {
            return $devresolution;
        }
        abort(YException::PARAMS_ERROR, 'DevResolution');
    }/*}}}*/

    public function getVersion()
    {/*{{{*/
        $version = strip_tags($this->_version);
        if($version)
        {
            return $version;
        }
        abort(YException::PARAMS_ERROR, 'Version');
    }/*}}}*/

    public function getContent()
    {/*{{{*/
        return strip_tags($this->_content);
    }/*}}}*/

    public function getSrc()
    {/*{{{*/
        $src = strip_tags($this->_src);
        if($src)
        {
            return $src;
        }
        //abort(YException::PARAMS_ERROR, 'Src');
    }/*}}}*/

    public function getPic()
    {/*{{{*/
        $pic = strip_tags($this->_pic);
        return $pic ? $pic : self::PIC;
    }/*}}}*/

    public function getBpic()
    {/*{{{*/
        $bpic = strip_tags($this->_bpic);
        return $bpic ? $bpic : self::BPIC;
    }/*}}}*/

    public function getSx()
    {/*{{{*/
        $sx = strip_tags($this->_sx);
        if($sx)
        {
            return $sx;
        }
        abort(YException::PARAMS_ERROR, 'Sx');
    }/*}}}*/

    public function getFrom()
    {/*{{{*/
        $from = strip_tags($this->_from);
        if($from)
        {
            return $from;
        }
        abort(YException::PARAMS_ERROR, 'From');
    }/*}}}*/

    public function getPlatform()
    {/*{{{*/
        $platform = strip_tags($this->_platform);
        if($platform)
        {
            return strtolower($platform);
        }
        abort(YException::PARAMS_ERROR, 'Platform');
    }/*}}}*/

    public function getPageId()
    {/*{{{*/
        $page = intval($this->_offset);
        return $page ? $page : 0;
    }/*}}}*/

    public function getPname()
    {/*{{{*/
        return strip_tags($this->_pname);
    }/*}}}*/

    public function getSname()
    {/*{{{*/
        $sname = strip_tags($this->_sname);
        if($sname)
        {
            return $sname;
        }
        abort(YException::PARAMS_ERROR, 'Sname');
    }/*}}}*/


    public function getNickname()
    {/*{{{*/
        return strip_tags($this->_nickname);
    }/*}}}*/

    public function getUsername()
    {/*{{{*/
        $username = strip_tags($this->_username);
        if($username)
        {
            return $username;
        }
        abort(YException::PARAMS_ERROR, 'Username');
    }/*}}}*/

    public function getLocation()
    {/*{{{*/
        return strip_tags($this->_location);
    }/*}}}*/

    public function getIpaddr()
    {/*{{{*/
        return $this->_ipaddr;
    }/*}}}*/

    public function getStatus()
    {/*{{{*/
        $status = intval($this->_status);
        return $status;
    }/*}}}*/

    public function getPstatus()
    {/*{{{*/
        $pstatus = intval($this->_pstatus);
        return $pstatus;
    }/*}}}*/

    public function getLiveth()
    {/*{{{*/
        $liveth = intval($this->_liveth);
        return $liveth;
    }/*}}}*/

    public function getLiveurl()
    {/*{{{*/
        $liveurl = strip_tags($this->_liveurl);
        if($liveurl)
        {
            return $liveurl;
        }
        abort(YException::PARAMS_ERROR, 'Liveurl');
    }/*}}}*/

    public function getImurl()
    {/*{{{*/
        $imurl = strip_tags($this->_imurl);
        if($imurl)
        {
            return $imurl;
        }
        abort(YException::PARAMS_ERROR, 'Imurl');
    }/*}}}*/

    public function getPush_stream()
    {/*{{{*/
        $push_stream = strip_tags($this->_push_stream);
        if($push_stream)
        {
            return $push_stream;
        }
        abort(YException::PARAMS_ERROR, 'Push_stream');
    }/*}}}*/

    public function getLive_stream()
    {/*{{{*/
        $live_stream = strip_tags($this->_live_stream);
        if($live_stream)
        {
            return $live_stream;
        }
        abort(YException::PARAMS_ERROR, 'Live_stream');
    }/*}}}*/


    public function getPull_stream()
    {/*{{{*/
        $pull_stream = strip_tags($this->_pull_stream);
        if($pull_stream)
        {
            return $pull_stream;
        }
        abort(YException::PARAMS_ERROR, 'Pull_stream');
    }/*}}}*/
    
    //个性签名
    public function getEditsignature()
    {/*{{{*/
        return strip_tags($this->_signature);
    }/*}}}*/

    //个性签名
    public function getEditshowskill()
    {/*{{{*/
        return strip_tags($this->_showskill);
    }/*}}}*/

    //个性签名
    public function getEdithobby()
    {/*{{{*/
        return strip_tags($this->_hobby);
    }/*}}}*/

    //个性签名
    public function getEditweibo()
    {/*{{{*/
        return strip_tags($this->_weibo);
    }/*}}}*/

    //头像
    public function getEditpic()
    {/*{{{*/
        $pic = strip_tags($this->_pic);
        if ($pic) return $pic;
        abort(YException::PARAMS_ERROR, 'Pic');
    }/*}}}*/

    //封面
    public function getEditbpic()
    {/*{{{*/
        $bpic = strip_tags($this->_bpic);
        if ($bpic) return $bpic;
        abort(YException::PARAMS_ERROR, 'Bpic');
    }/*}}}*/

    //地区
    public function getEditulocation()
    {/*{{{*/
        return strip_tags($this->_ulocation);
    }/*}}}*/

    public function getEditjob()
    {/*{{{*/
        return strip_tags($this->_job);
    }/*}}}*/

    public function getEditbirthday()
    {/*{{{*/
        return strip_tags($this->_birthday);
    }/*}}}*/

    public function getUids()
    {
        return $this->_userid;
    }

    public function getFeedbackproblem()
    {
        $feedbackproblem = strip_tags($this->_feedbackproblem);
        if ($feedbackproblem) return $feedbackproblem;
        abort(YException::PARAMS_ERROR, 'Feedbackproblem');
    }

    public function getPnums()
    {
        return intval($this->_userid);
    }

    public function getMsg()
    {
        $msg = strip_tags($this->_msg);
        if ($msg) return $msg;
        abort(YException::PARAMS_ERROR, 'Msg');
    }
    //交易部分
    public function getKey()
    {
        $key = strip_tags($this->_ky);
        if ($key) return $key;
        abort(YException::PARAMS_ERROR, 'Callback Key');
    }

    public function getTime()
    {
        $times = intval($this->_time);
        if ($times) return $times;
        abort(YException::PARAMS_ERROR, 'Callback Time');
    }

    public function getCredit()
    {/*{{{*/
        $credit = $this->_credit;
        if (!in_array($credit, array('0.0', '0.00'))) return $credit;
        abort(YException::PARAMS_ERROR, 'Callback Credit');
    }/*}}}*/

    public function getPaytype()
    {
        $paytype = intval($this->_paytype);
        if ($paytype) return $paytype;
        abort(YException::PARAMS_ERROR, 'Callback PayType');
    }

    public function getAgntid()
    {
        $agntid = intval($this->_agentid);
        if ($agntid) return $agntid;
        abort(YException::PARAMS_ERROR, 'Callback Agntid');
    }

    public function getCustomerid()
    {
        $customerid = strip_tags($this->_customerid);
        if ($customerid) return $customerid;
        abort(YException::PARAMS_ERROR, 'Callback Customerid');
    }

    public function getOpid()
    {/*{{{*/
        $opid = strip_tags($this->_opid);
        return $opid ? $opid : 0;
    }/*}}}*/

}/*}}}*/

