<div class="actions-container row-fluid animate">
	 <div id="profile-navigation" class="span12 nav-marginTop">		
		<div class="row-fluid">
			<div class="span6">		
				<div class="row-fluid">
					<div class="span4 module">
						<div class="module-wrap">
							<div class="module-name <?php echo $pluralVar;?>">
							
							<?php
							 echo " <?php echo \$this->Html->link( '{$pluralHumanName}',
														array('action' => 'index')
													);  ?>";						
							?>
							</div>
						</div>
					</div>
					<div class="span3">
					<?php
							 echo " <?php echo \$this->Html->link( 	\$this->Html->tag('i', '', array('class' => 'icon-plus icon-white')).
														\$this->Html->tag('span', 'CREATE', array('class' => 'action-label')),
														array('action' => 'add'), array('escape' => false,'class'=>'btn btn-medium btn-primary btn-block animate')
													);  ?>";
													
							?>
					</div>
					<div class="btn-group span3">
					  <a class="btn btn-medium btn-block dropdown-toggle" data-toggle="dropdown" href="#">
						<i class=" icon-th-list"></i><span class="action-label">LINKS</span>	
					  </a>
					  <ul class="dropdown-menu">
						<!-- dropdown menu links -->
						<?php
							$done = array();
							foreach ($associations as $type => $data) {
								foreach ($data as $alias => $details) {
									if ($details['controller'] != $this->name && !in_array($details['controller'], $done)) {
										
										echo "\t\t<li><?php echo \$this->Html->link(__('" . Inflector::humanize($details['controller']) . "', true), array('controller' => '{$details['controller']}', 'action' => 'index')); ?> </li>\n";
										/*
										echo "\t\t<li><?php echo \$this->Html->link(__('New " . Inflector::humanize(Inflector::underscore($alias)) . "', true), array('controller' => '{$details['controller']}', 'action' => 'add')); ?> </li>\n";
										*/
										/*
										echo "\t\t<li><?php echo 
													\$this->Html->tag('span', '".Inflector::humanize($details['controller'])."', array('class' => 'action-label')).
													\$this->Html->link( 	\$this->Html->tag('i', '', array('class' => 'icon-list-alt')).
													\$this->Html->tag('span', 'LIST', array('class' => 'action-label')),
													array('controller' => '{$details['controller']}', 'action' => 'index'), array('escape' => false)
												);  ?> </li>\n";
										echo "\t\t<li><?php echo \$this->Html->link( 	\$this->Html->tag('i', '', array('class' => 'icon-plus')).
													\$this->Html->tag('span', 'CREATE', array('class' => 'action-label')),
													array('controller' => '{$details['controller']}', 'action' => 'add'), array('escape' => false)
												);  ?> </li>\n";
											*/
										$done[] = $details['controller'];
									}
								}
							}
						?>
					  </ul>
					</div>
				</div>
			</div>
			<div class="span6 text-right">
				 <input class="span6 m-t-5 p" type="text" placeholder="Search">
			</div>
		</div>
	</div>
 </div>

<div class="row-fluid">
<div class="<?php echo $pluralVar;?> form span6 offset3">

<?php 
echo "<?php echo \$this->Form->create('{$modelClass}',array(	'class'=>'form-horizontal',
																	'inputDefaults' => array( 	'label'=>array('class'=>'control-label'),
																								'div'=>array('class'=>'control-group')
																							)
																	)
											);?>\n";?>
	<fieldset>
		<legend><?php printf("<?php __('%s %s'); ?>", Inflector::humanize($action), $singularHumanName); ?></legend>
<?php
		foreach ($fields as $field) {
			if (strpos($action, 'add') !== false && $field == $primaryKey) {
				continue;
			} elseif (!in_array($field, array('created', 'modified', 'updated'))) {
				$placeholder = Inflector::humanize($field);
				if($action=='add'){
					$placeholder=null;
				}
				echo "\t\t<?php echo \$this->Form->input('{$field}',array('placeholder'=>'{$placeholder}','between'=>'<div class=\"controls\">','after'=>'</div>' ,'class'=>'span11'));?>\n";
				
			}
		}
		if (!empty($associations['hasAndBelongsToMany'])) {
			foreach ($associations['hasAndBelongsToMany'] as $assocName => $assocData) {
				$placeholder = Inflector::humanize($assocName);
				if($action=='add'){
					$placeholder=null;
				}
				echo "\t\t<?php echo \$this->Form->input('{$assocName}',array('placeholder'=>'{$placeholder}','between'=>'<div class=\"controls\">','after'=>'</div>'));?>\n";

			}
		}
?>
	</fieldset>
	<div class="control-group">
		<div class="controls">
		<?php echo "<?php echo \$this->Form->button('Save',array('type'=>'submit','class'=>'btn btn-primary'));?>\n";?>
		<?php echo "<?php echo \$this->Form->button('Cancel',array('type'=>'reset','class'=>'btn'));?>\n";?>
		</div>
	</div>
	<?php echo "<?php echo \$this->Form->end();?>\n"; ?>
</div>
</div>