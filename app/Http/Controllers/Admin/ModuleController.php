<?php

namespace App\Http\Controllers\Admin;

use Request;
use Config;
use Response;
use Validator;
use App\Models\Bizservice\AdminModuleSvc;
class ModuleController extends BaseController
{

    private $_adminModuleSvc = null;

    public function __construct()
    {
        parent::__construct();
    }

    public function modulelist()
    {
        $this->_adminModuleSvc = new AdminModuleSvc();

        $page = Request::input('page', 1);
        $module = Request::input('m', '');
        $per_page = Config::get('admin.module_list.per_page');
        $where = array();
        if(!empty($module)) {
            $where[] = array('module','=',$module
            );
        }
        $order = array(
            'order_by' =>'asc',
            'id' =>'asc',
        );
        $list = $this->_adminModuleSvc->moduleList($where, $page, $per_page,$order);
        $action = $this->action('module', 'modulelist');

        return view('module.list.main')
            ->with('action', $action)
            ->with('modules', $list)
            ->with('modulesGroup', $this->_adminModuleSvc->modulesGroupBy());
    }

    public function opeModuleList()
    {
        $op= Request::input('op', FALSE);
        if (!$op) return $this->json(false);

        $data = Request::input('data', array());
        switch ($op) {
            case 'add':
                return $this->_moduleAdd($data);
                break;
            case 'edit':
                return $this->_moduleEdit($data);
                break;
            case 'delete':
                return $this->_moduleDelete($data);
                break;
            default:
                return $this->json(false);
        }
    }

    public function _moduleAdd($data)
    {
        $this->_adminModuleSvc = new AdminModuleSvc();

        if ($this->_checkModuleAction($data)) {
            return Response::json(array(
                'code'=> 1,
                'msg' => array(array('模块及子项名已经存在')),
            ));
        }
        $rule = array(
            'module'	    =>  'required|between:1,64|alpha_dash',
            'module_cn'	    =>  'required|max:64',
            'action'	    =>  'required|between:1,64|alpha_dash',
            'action_cn'	    =>  'required|max:64',
            'module_type'   =>  'numeric|between:0,2',
            'order_by'	    =>  'numeric|unique:admin_modules,order_by',
            'gname'	        =>  'max:64',
            'column_id'	    =>  'required|exists:admin_top_column,id',
            //'description'	=>	'numeric',
        );
        $message = array(
            'module.required'       =>	'模块名必须提供',
            'module.between'	    =>	'模块名长度限制为1到64字节',
            'module.alpha_dash'	    =>	'模块名只能为字母',
            'module_cn.required'	=>	'模块中文名必须提供',
            'module_cn.max'	        =>	'模块中文名超过最大长度',

            'action.required'	    =>	'模块子项名必须提供',
            'action.between'	    =>	'模块子项名长度限制为1到64字节',
            'action.alpha_dash'     =>	'模块子项名只能为字母',
            'action_cn.required'    =>	'模块子项中文名必须提供',
            'action_cn.max'	        =>	'模块子项中文名超过最大长度',

            //'module_type_required'	=>	'模块类型必须提供',
            'module_type.numeric'	=>	'必须为数字',
            'module_type.between'	=>	'超出范围',

            'order_by.numeric'	    =>	'必须为数字',
            'order_by.unique'	    =>	'排序位已经占用',
            'gname.max'	            =>	'超过最大长度',
            'column_id.required'	=>	'必须选择顶部导航',
            'column_id.exists'	    =>	'顶部导航不存在',
        );
        $val = Validator::make($data, $rule, $message);
        if ($val->fails()) return $this->json($val->errors()->all());

        return $this->json($this->_adminModuleSvc->moduleAdd($data));
    }

    public function _moduleEdit($data)
    {
        $this->_adminModuleSvc = new AdminModuleSvc();

        if (!isset($data['id'])) return $this->json(false);
        $module = $this->_adminModuleSvc->getSingle(array(array('id', '=', $data['id'])));
        if (!$module) return $this->json(false);
        if ($this->_checkModuleAction($data)) {
            return Response::json(array(
                'code'=> 1,
                'msg' => array(array('模块及子项名已经存在')),
            ));
        }
        $rule = array(
            'module'	    =>  'required|between:1,64|alpha_dash',
            'module_cn'	    =>  'required|max:64',
            'action'	    =>  'required|between:1,64|alpha_dash',
            'action_cn'	    =>  'required|max:64',
            'module_type'   =>	'numeric|between:0,2',
            'order_by'	    =>  'numeric|unique:admin_modules,order_by,'.$module->id,
            'gname'     	=>  'max:64',
        );
        $message = array(
            'module.required'	    =>	'模块名必须提供',
            'module.between'	    =>	'模块名长度限制为1到64字节',
            'module.alpha_dash'	    =>	'模块名只能为字母',
            'module_cn.required'    =>	'模块中文名必须提供',
            'module_cn.max'	        =>	'模块中文名超过最大长度',

            'action.required'	    =>	'模块子项名必须提供',
            'action.between'	    =>	'模块子项名长度限制为1到64字节',
            'action.alpha_dash'	    =>	'模块子项名只能为字母',
            'action_cn.required'    =>	'模块子项中文名必须提供',
            'action_cn.max'	        =>	'模块子项中文名超过最大长度',

            'module_type.numeric'	=>	'必须为数字',
            'module_type.between'	=>	'超出范围',

            'order_by.numeric'	    =>	'必须为数字',
            'order_by.unique'	    =>	'排序位已经占用',
            'gname.max'	            =>	'超过最大长度',
        );
        $val = Validator::make($data, $rule, $message);
        if ($val->fails()) return $this->json($val->errors()->all());

        return $this->json($this->_adminModuleSvc->moduleEdit($data));
    }

    public function _moduleDelete($data)
    {
        $this->_adminModuleSvc = new AdminModuleSvc();

        if (!isset($data['id'])) return $this->json(false);

        $module = $this->_adminModuleSvc->getSingle(array(array('id', '=', $data['id'])));
        if (!$module) return $this->json(false);

        return $this->json($this->_adminModuleSvc->moduleDelete($data['id']));
    }

    /**
     * check module&action name exist
     */
    public function _checkModuleAction($data)
    {
        $this->_adminModuleSvc = new AdminModuleSvc();

        $data['id'] = empty($data['id'])?0:$data['id'];
        return $this->_adminModuleSvc->getSingle(
            array(
                array('module', '=', $data['module']),
                array('action', '=', $data['action']),
                array('id', '!=', $data['id'])
            )
        );
    }
}
