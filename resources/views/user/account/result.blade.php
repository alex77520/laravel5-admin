<div style='clear:both'></div>
<span class='alert alert-success'>共 <span class="badge">{{$users->total()}}</span> 条记录</span>
<a class='btn btn-primary pull-right add-account' style="margin: 5px auto">添加用户</a>
<table class="table table-bordered table-hover table-condensed">
    <thead>
        <tr>
        <?php foreach (Config::get('admin.user.attr') as $k => $v):?>
            <th><?php echo $v;?></th>
        <?php endforeach;?>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($users as $u):?>
        <tr id='user-<?php echo $u->id;?>'>
            <?php foreach (Config::get('admin.user.attr') as $k => $v):?>
            <td class='<?php echo $k;?>'><?php echo $u->$k;?></td>
            <?php endforeach;?>
            <td style='width:80px;'>
                <?php echo view('user.account.operation')
                        ->with('b', $u)
                        ->render();?>
            </td>
        </tr>
        <?php endforeach;?>
    </tbody>
</table>
<div class="pull-right">
{!! $users->render() !!}
</div>
<div style='clear:both'></div>
