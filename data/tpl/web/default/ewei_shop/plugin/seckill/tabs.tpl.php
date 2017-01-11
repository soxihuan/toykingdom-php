<?php defined('IN_IA') or exit('Access Denied');?><ul class="nav nav-tabs">
    
    
    <?php if(cv('seckill.index')) { ?><li <?php  if($_GPC['method']=='' ||  $_GPC['method']=='index') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createPluginWebUrl('seckill/index')?>">选择限时卖商品</a></li><?php  } ?>
    <?php if(cv('seckill.skill')) { ?><li <?php  if($_GPC['method']=='skill') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createPluginWebUrl('seckill/skill')?>">秒杀商品</a></li><?php  } ?>
    <?php if(cv('seckill.switchkill')) { ?><li <?php  if($_GPC['method']=='switchkill') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createPluginWebUrl('seckill/switchkill')?>">秒杀显示设置</a></li><?php  } ?>



</ul>
