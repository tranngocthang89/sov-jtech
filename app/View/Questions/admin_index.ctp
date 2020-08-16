<!-- <div class="page-header line1">
    <h4>Quản lý nội dung</h4>
</div> -->
<!-- START Row -->

<div class="row-fluid">
    <!-- START Datatable 2 -->
    <div class="span12 widget dark">
        <header>
            <h4 class="title pull-left"><span class="icon icone-list"></span></h4>
            <!-- START Button Group -->
            <div class="btn-group pull-left">
                <?php echo $this->Html->link("<span class=\"icone-trash\"></span>&nbsp;&nbsp;Xóa các mục đã chọn",'javascript:void(0);',array("class"=>"btn btn-danger","id"=>"chkAll","escape"=>false));?>
            </div>

            <div class="btn-group pull-right">
                <?php echo $this->Html->link("<span class=\"icone-edit\"></span>&nbsp;&nbsp;Thêm mới",array("action"=>"add"),array("class"=>"btn btn-success","escape"=>false));?>
            </div>
            <!--/ END Button Group -->
        </header>
        <section class="body">
            <div class="body-inner no-padding">
                <?php echo $this->Form->create('frm',array('type' => 'post'));?>
                <div class="row-fluid headbar">
                    <div class="span12 filter pull-right">
                        <div class="dataTables_filter">
                            <label>
                                <div style="margin-top: 1px; display:inline-table;">
                                    <?php echo $this->element("libs/_ajax_status_index");?>
                                </div>
                                <?php echo $this->Form->input('s',array("label"=>false,"div"=>false));?>
                                <?php echo $this->Form->submit("&nbsp;Tìm kiếm",array("class"=>"btn icone-search btn-smalluccess","div"=>false,"escape"=>false));?>
                            </label>
                        </div>
                    </div>
                </div>
                <?php echo $this->Form->end();?>
                <table class="table table-bordered table-striped table-hover datatable">
                    <thead class="sorting">
                        <tr>
                            <th width="5%"><div align="center"><input type="checkbox"></div></th>
                            <th><?php echo $this->Paginator->sort('name','Người hỏi'); ?></th>
                            <th><?php echo $this->Paginator->sort('phone','Điện thoại'); ?></th>
                            <th><?php echo $this->Paginator->sort('email','E-mail'); ?></th>
                            <th><?php echo $this->Paginator->sort('types','Loại'); ?></th>
                            <th width="10%"><div align="center"><?php echo $this->Paginator->sort('status',"Hiển thị"); ?></div></th>
                            <th width="10%"><div align="center">Thao tác</div></th>
                        </tr>
                    </thead>
                    <tbody>
						<?php foreach ($questions as $v): ?>
						<tr>
							<td><div align="center"><input type='checkbox' value="<?php echo $v[Inflector::singularize($this->name)]['id'];?>" class='icheckbox_minimal-grey'></div></td>
							<td><?php echo h($v['Question']['name']); ?>&nbsp;</td>
							<td><?php echo h($v['Question']['phone']); ?>&nbsp;</td>
							<td><?php echo h($v['Question']['email']); ?>&nbsp;</td>
							<td><?php if($v['Question']['types'] == 1){ echo "Câu hỏi thường gặp";}else echo "Khách hàng hỏi";

							?></td>
							<td class="center">
                            <div id="togglediv_<?php echo $v[Inflector::singularize($this->name)]['id'].'_'.$v[Inflector::singularize($this->name)]['status'].'_'.$this->request->params['controller'];?>" class="toggle_div">
                                <?php if($v[Inflector::singularize($this->name)]['status'] == 1){?>
                                <span data-content="2" id="toggle_div_span_<?php echo $v[Inflector::singularize($this->name)]['id'];?>" title="Ẩn" class='icon icone-remove red pointer'></span>
                                <?php }else{?>
                                <span data-content="1" id="toggle_div_span_<?php echo $v[Inflector::singularize($this->name)]['id'];?>"  title="Hiển thị" class='icon icone-ok green pointer'></span>
                                <?php }?>
                            </div>
                            <span id="toggle_div_span_<?php echo $v[Inflector::singularize($this->name)]['id'];?>_spinner" title="Loadding..." class='icon icone-spinner green pointer' style="display:none"></span>
                            <?php //echo $app->toggle(1,2);?>
                        </td>
						<td><div class='toolbar' align="center">
							<?php echo $this->Html->link("<span class='icone-eye-open'></span>",array("action"=>"edit",$v[Inflector::singularize($this->name)]['id']),array("escape"=>false,"class"=>"btn btn-small"));?>
							<?php echo $this->Form->postLink("<span class='icone-trash'></span>", array('action' => 'delete', $v[Inflector::singularize($this->name)]['id']), array("escape"=>false,"class"=>"btn btn-small btn-danger"), __('confirmDel', $v[Inflector::singularize($this->name)]['id'])); ?>
						</div></td>
						</tr>
					<?php endforeach; ?>

                    </tbody>
                </table>
            </div>
            <?php echo $this->element("libs/pagination");?>
            <?php //echo $this->element("sql_dump");?>
        </section>

    </div>
    <!--/ END Datatable  -->
</div>
<!--/ END Row -->


