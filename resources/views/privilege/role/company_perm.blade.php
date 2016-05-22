
<p class='alert alert-success'>公司权限(非资源)</p>
<table class="table table-bordered table-hover table-condensed">
    <thead>
    <tr>
        <td style='width:120px;'>公司</td>
        <td>子模块</td>
    </tr>
    </thead>
    <tbody>
    <?php foreach($allCompanyModule as $k=>$v):?>
    <tr>
        <td><?php echo $v[0]->module_cn;?></td>
        <td>
            <ul>
                <?php foreach ($v as $vv):?>
                <li style='float:left;padding-right:5px;'>
                    <input class='static-perm' data-module-id="<?php echo $vv->id;?>" data-role-id="<?php echo
                    $role->id;?>" <?php if(in_array($vv->id, $rolePermission)) echo 'checked="checked" data-op="revoke"'; else echo "data-op='grant'";?> type='checkbox' value='<?php echo $vv->id;?>' name='action' /><?php echo $vv->action_cn;?>
                </li>
                <?php endforeach;?>
            </ul>
        </td>
    </tr>
    <?php endforeach;?>
    </tbody>
</table>
