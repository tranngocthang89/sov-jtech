<?php
echo $this->Html->script('/acl/js/acl_plugin');
$column_count = 1;
        
//$headers = array(__d('acl', 'Chức năng'));

foreach($roles as $role)
{
    $headers[] = $role[$role_model_name][$role_display_field];
    $column_count++;
}
?>
	
	<?php
	//echo $this->Html->link( "<span class=\"icone-remove red pointer\"></span>" . __d('acl', 'Xóa bảng phân quyền'), '/admin/acl/aros/empty_permissions', array('confirm' => __d('acl', 'Are you sure you want to delete all roles and users permissions ?'), 'escape' => false));
	?>
<div class="row-fluid widget dark">
<section class="body">
<div class="body-inner no-padding">
    <table class="table table-bordered table-striped table-hover dataTable" > 
        <thead>
        <tr>
        	<th>Nhóm</th>
        	<th><?php echo __d('acl', 'Cho phép thao tác với tất cả các chức năng'); ?></th>
        	<th><?php echo __d('acl', 'Chặn thao tác với các chức năng'); ?></th>
        </tr>
        </thead>
        <tbody>
            <?php
            $i = 0;
            foreach($roles as $role)
            {
                $color = ($i % 2 == 0) ? 'color1' : 'color2';
                echo '<tr class="' . $color . '">';
                echo '  <td>' . $role[$role_model_name][$role_display_field] . '</td>';
                echo '  <td style="text-align:center">' . $this->Html->link("<span class=\"icone-ok green pointer\"></span>", '/admin/acl/aros/grant_all_controllers/' . $role[$role_model_name][$role_pk_name], array('escape' => false, 'confirm' => sprintf(__d('acl', "Are you sure you want to grant access to all actions of each controller to the role '%s' ?"), $role[$role_model_name][$role_display_field]))) . '</td>';
                echo '  <td style="text-align:center">' . $this->Html->link("<span class=\"icone-remove red pointer\"></span>", '/admin/acl/aros/deny_all_controllers/' . $role[$role_model_name][$role_pk_name], array('escape' => false, 'confirm' => sprintf(__d('acl', "Are you sure you want to deny access to all actions of each controller to the role '%s' ?"), $role[$role_model_name][$role_display_field]))) . '</td>';
                echo '<tr>';
                
                $i++;
            }
            ?>
        </tbody>
    </table>
</div>
</section>
</div>
    











<div class="widget dark stacked">
    <header><h4 class="title"><span class='icon icone-list'></span>Phân quyền cho nhóm người dùng</h4></header>
    <section class="body">
        <div class="body-inner">
            <div class="accordion" id="accordion">
	<?php
	$i = 0;
	if(isset($actions['app']) && is_array($actions['app']))
	{
        ?>
        
        <?php
		foreach($actions['app'] as $controller_name => $ctrl_infos)
		{$i++;
        ?><div class="accordion-group">
        <div class="accordion-heading">                     
            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseChild<?php echo $i;?>"><?php echo __d('acl',$controller_name);?></a>
        </div>
        <div id="collapseChild<?php echo $i;?>" class="accordion-body collapse">
            <div class="accordion-inner">
            <table class="table table-bordered table-striped table-hover dataTable" >  
            <tbody role="alert" aria-live="polite" aria-relevant="all">
                <tr><th rowspan=2  class="v_center">Chức năng</th>
                    <th colspan=<?php echo $column_count;?>>Nhóm người dùng</th>
                </tr>
                <?php echo $this->Html->tableHeaders($headers);?>
                <?php
        			$row=0;

        			foreach($ctrl_infos as $ctrl_info)
        			{
                        echo "<tr><td>";
                        $row++;
                        $class = $row%2==0?"odd":"even";
        	    		 
        	    		 //echo $ctrl_info['name'];
                          echo __d('acl',$ctrl_info['name']);
                         echo "</td>";
        		    	foreach($roles as $role)
        		    	{
                            echo "<td>";
         		    	    echo '<span id="right__' . $role[$role_model_name][$role_pk_name] . '_' . $controller_name . '_' . $ctrl_info['name'] . '">';
        	    		
        		    	    if(isset($ctrl_info['permissions'][$role[$role_model_name][$role_pk_name]]))
        		    	    {
            		    		if($ctrl_info['permissions'][$role[$role_model_name][$role_pk_name]] == 1)
            		    		{
            		    			$this->Js->buffer('register_role_toggle_right(true, "' . $this->Html->url('/') . '", "right__' . $role[$role_model_name][$role_pk_name] . '_' . $controller_name . '_' . $ctrl_info['name'] . '", "' . $role[$role_model_name][$role_pk_name] . '", "", "' . $controller_name . '", "' . $ctrl_info['name'] . '")');
                                    echo "<span class=\"icone-ok green pointer\"></span>";
            		    		}
            		    		else
            		    		{
            		    			$this->Js->buffer('register_role_toggle_right(false, "' . $this->Html->url('/') . '", "right__' . $role[$role_model_name][$role_pk_name] . '_' . $controller_name . '_' . $ctrl_info['name'] . '", "' . $role[$role_model_name][$role_pk_name] . '", "", "' . $controller_name . '", "' . $ctrl_info['name'] . '")');
                                    echo "<span class=\"icone-remove red pointer\"></span>";
            		    		}
        		    	    }
        		    	    else
        		    	    {
                                echo "<span class=\"icone-warning-sign organe\" title=\"The ACO node is probably missing. Please try to rebuild the ACOs first.\"></span>";
        		    	    }
        		    		
        		    		echo '</span>';
                	    	echo "<span id='right__". $role[$role_model_name][$role_pk_name] . "_" . $controller_name . "_" . $ctrl_info['name'] . "_spinner' class=\"icone-spinner green\" style= 'display:none;'></span>";
                    		 echo "</td>";
         		    	}
        	    		echo "</tr>";
         			}
                    echo "</tbody></table>";
                    echo "</div></div>";echo "</div>";
        		}
                
        	}
        	?>
        	<?php
        	if(isset($actions['plugin']) && is_array($actions['plugin']))
        	{
        	    foreach($actions['plugin'] as $plugin_name => $plugin_ctrler_infos)
            	{$i++;
                    ?>
                    <div class="accordion-group">
                    <div class="accordion-heading">                     
                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseChild<?php echo $i;?>">Module hệ thống <?php echo $plugin_name;?></a>
                    </div>
                    <div id="collapseChild<?php echo $i;?>" class="accordion-body collapse">
                        <div class="accordion-inner">
                        <table class="table table-bordered table-striped table-hover dataTable" >  
                        <tbody role="alert" aria-live="polite" aria-relevant="all">
                            <tr><th rowspan=2  class="v_center">Chức năng</th>
                            <th colspan=<?php echo $column_count;?>>Nhóm người dùng</th>
                        </tr>
                        <?php echo $this->Html->tableHeaders($headers);?>
                    <?php
            	    foreach($plugin_ctrler_infos as $plugin_ctrler_name => $plugin_methods)
            	    {
            	        foreach($plugin_methods as $method)
            	        { 
                            echo "<tr><td>";
                            echo $method['name'];
                            echo "</td>";            
                	        foreach($roles as $role)
            		    	{
                                echo "<td>";
             		    	    echo '<span id="right_' . $plugin_name . '_' . $role[$role_model_name][$role_pk_name] . '_' . $plugin_ctrler_name . '_' . $method['name'] . '">';
            		    	    
            		    	    if(isset($ctrl_info['permissions'][$role[$role_model_name][$role_pk_name]]))
            		    	    {
                		    		if($method['permissions'][$role[$role_model_name][$role_pk_name]] == 1)
                		    		{
                		    		    $this->Js->buffer('register_role_toggle_right(true, "' . $this->Html->url('/') . '", "right_' . $plugin_name . '_' . $role[$role_model_name][$role_pk_name] . '_' . $plugin_ctrler_name . '_' . $method['name'] . '", "' . $role[$role_model_name][$role_pk_name] . '", "' . $plugin_name . '", "' . $plugin_ctrler_name . '", "' . $method['name'] . '")');
            		    		        echo "<span class=\"icone-ok green pointer\"></span>";
                		    		}
                		    		else
                		    		{
                		    		    $this->Js->buffer('register_role_toggle_right(false, "' . $this->Html->url('/') . '", "right_' . $plugin_name . '_' . $role[$role_model_name][$role_pk_name] . '_' . $plugin_ctrler_name . '_' . $method['name'] . '", "' . $role[$role_model_name][$role_pk_name] . '", "' . $plugin_name . '", "' . $plugin_ctrler_name . '", "' . $method['name'] . '")');
                		    		    echo "<span class=\"icone-remove red pointer\"></span>";
                		    		}
            		    	    }
            		    	    else
            		    	    {
                                    echo "<span class=\"icone-warning-sign organe\" title=\"The ACO node is probably missing. Please try to rebuild the ACOs first.\"></span>";
            		    	    }
            		    		
            		    		echo '</span>';
                    	    	echo "<span id='right_" . $plugin_name . "_" . $role[$role_model_name][$role_pk_name] . "_" . $plugin_ctrler_name . "_" . $method['name'] . "_spinner' class=\"icone-spinner green\" style= 'display:none;'></span>";
                        	   echo "</td>";
             		    	}
            		    	echo "</tr>";
             	        }
            	    } echo "</tbody></table>";
                    echo "</div></div></div>";
            	}
        	}
            ?>
        	</table>

        </div>
    </div>
    </section>
</div>
<div class="widget">
    <?php
    echo   '<span class="icone-ok green"></span> ' . __d('acl', 'authorized');
    echo '&nbsp;&nbsp;&nbsp;';
    echo  '<span class="icone-remove red"></span> ' . __d('acl', 'blocked');
    ?>
</div>
<?php
echo $this->element('design/footer');
?>