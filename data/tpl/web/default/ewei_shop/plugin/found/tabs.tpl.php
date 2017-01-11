<?php defined('IN_IA') or exit('Access Denied');?><ul class="nav nav-tabs">
    
    
    <?php if(cv('found.index')) { ?><li <?php  if($_GPC['method']=='') { ?>class="active"<?php  } ?>><a href="<?php  echo $this->createPluginWebUrl('found/index')?>">发现列表</a></li><?php  } ?>



</ul>
