<?php defined('IN_IA') or exit('Access Denied');?><?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/_header', TEMPLATE_INCLUDEPATH)) : (include template('web/_header', TEMPLATE_INCLUDEPATH));?>
<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('tabs', TEMPLATE_INCLUDEPATH)) : (include template('tabs', TEMPLATE_INCLUDEPATH));?>


<div class="main">

    <style>
        .label{cursor:pointer;}
    </style>


    <div class="panel panel-default">
        <div class="panel-body">
            <form action="./index.php" method="post" enctype='multipart/form-data' class="form-horizontal" role="form" id="form2">
                <input type="hidden" name="c" value="site" />
                <input type="hidden" name="a" value="entry" />
                <input type="hidden" name="m" value="ewei_shop" />
                <input type="hidden" name="do" value="plugin" />
                <input type="hidden" name="p" value="commission" />
                <input type="hidden" name="method" value="white" />
                <input type="hidden" name="op" value="display" />

                <input type="file" name="file" value="2"  style="display: block;width: 300px"/>
                <button type="submit" name="import" value="2" class="btn btn-primary" >导入 Excel</button>


            </form>
        </div>
    </div>



    <div class="panel panel-default">
        <div class="panel-heading">已导入白名单客户：<?php  echo $total;?></div>
        <div class="panel-body table-responsive">
            <table class="table table-hover">
                <thead class="navbar-inner">
                <tr>
                    <th style="width:60px;">文件名</th>
                    <th style="width:300px;">上传时间</th>

                </tr>
                </thead>
                <tbody>
                <?php  if(is_array($record)) { foreach($record as $item) { ?>
                <tr>

                    <td><?php  echo $item['name'];?></td>
                    <td><?php  echo date('Y-m-d H:i:s', $item['time']);?></td>
                </tr>
                <?php  } } ?>

                </tr>
                </tbody>
            </table>
            <?php  echo $pager;?>
        </div>
    </div>



</div>



<?php (!empty($this) && $this instanceof WeModuleSite || 1) ? (include $this->template('web/_footer', TEMPLATE_INCLUDEPATH)) : (include template('web/_footer', TEMPLATE_INCLUDEPATH));?>