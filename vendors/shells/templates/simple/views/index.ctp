
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
															'javascript:void()'
														);  ?>";						
								?>
								
							</div>
						</div>
					</div>
					<div class="span3 upAccount">
					 <?php echo "<?php echo \$this->Html->link( 	\$this->Html->tag('i', '', array('class' => 'icon-chevron-left')).
													\$this->Html->tag('span', 'BACK', array('class' => 'action-label')),
													'/pages/apps',array('escape' => false,'class'=>'btn btn-medium tree-back btn-block animate' ,'id'=>'intent-back')
													); ?> "  ?>					
					</div>
					<div class="span3">
					<?php
							 echo " <?php echo \$this->Html->link( 	\$this->Html->tag('i', '', array('class' => 'icon-plus icon-white')).
														\$this->Html->tag('span', 'CREATE', array('class' => 'action-label')),
														array('action' => 'add'), array('escape' => false,'class'=>'btn btn-medium btn-primary btn-block animate' ,'id'=>'intent-create')
													);  ?>";
													
							?>
					</div>
					
				</div>
			</div>
			<div class="span3 pull-right">
				 <div id="simple-root"></div> 
			</div>
		</div>
	</div>
 </div>
<div class="sub-content-container">
	<div class="row-fluid">
		<div class="w90 center">
		<?php 	$canvasTable = $modelClass.'Table'; 
				$canvasForm = $modelClass.'CanvasForm';
		?>
		<table class="table table table-striped table-bordered  table-condensed RECORD tablesorter canvasTable" id="<?php echo $canvasTable; ?>" model="<?php echo $modelClass; ?>">
			<thead>
				<tr>
					<?php  foreach ($fields as $field):?>
						<?php if(!in_array($field, array('created', 'modified', 'updated','id'))): ?>
					<th class="w10 text-center"><a ><?php echo Inflector::humanize($field); ?></a></th>
						<?php endif ?>
					<?php endforeach;?>
					<th class="actions w5"><a >Actions</a></th>
				</tr>
			</thead>
			<tbody>
			<?php
				echo "\t<tr>\n";
				foreach ($fields as $field) {
					$isKey = false;
					if (!empty($associations['belongsTo'])) {
						foreach ($associations['belongsTo'] as $alias => $details) {
							if ($field === $details['foreignKey']) {
								$isKey = true;
								echo "\t\t<td>\n\t\t\t<span data-field='{$alias}.{$details['displayField']}'></span></td>\n";
								break;
							}
						}
					}
					if ($isKey !== true && !in_array($field, array('created', 'modified', 'updated','id')) ) {
						echo "\t\t<td><span data-field='{$modelClass}.{$field}'></span></td>\n";
					}
				}

				echo "\t\t<td class=\"actions\">\n";
				?>
					<div class="btn-group">
						<div class="btn-group btn-center">
							<button class="btn dropdown-toggle" data-toggle="dropdown"><i class="icon-cog"></i><span class="caret"></span></button>
							<ul class="dropdown-menu">
								<?php
								$done = array();
								foreach ($associations as $type => $data) {
									foreach ($data as $alias => $details) {
										if ($details['controller'] != $this->name && !in_array($details['controller'], $done)) {
										?>	
											 <li><a href="#intent-modal" data-toggle="modal"  class="action-view view-<?php echo $details['controller']; ?>"><i class="icon-eye-open"></i> <?php echo Inflector::humanize($details['controller']); ?></a></li>
										<?php
											$done[] = $details['controller'];
										}
									}
								}
								?>
							 
							  <li><a href="#" class="action-delete"><i class="icon-remove"></i> Delete</a></li>
							</ul>
						</div>
					</div>
				<?php
				echo "\t\t</td>\n";
			echo "\t</tr>\n";

		
			?>
			</tbody>
		</table>
		
		<?php 
		$paginate=false; 
		if($paginate):
			echo "	<?php
			if (!isset(\$modules)) {
				\$modulus = 11;
			}
			if (!isset(\$model)) {
				\$models = ClassRegistry::keys();
				\$model = Inflector::camelize(current(\$models));
			}
			?>";
		?>
		
		<div class="pagination">
		<ul>
			
			<?php echo "<?php echo \$this->Paginator->prev('<', array(
				'tag' => 'li',
				'class' => 'prev',
			), \$this->Paginator->link('<', array()), array(
				'tag' => 'li',
				'escape' => false,
				'class' => 'prev disabled',
			)); ?>";
			
			echo "<?php
			\$page = \$this->params['paging'][\$model]['page'];
			\$pageCount = \$this->params['paging'][\$model]['pageCount'];
			if (\$modulus > \$pageCount) {
				\$modulus = \$pageCount;
			}
			\$start = \$page - intval(\$modulus / 2);
			if (\$start < 1) {
				\$start = 1;
			}
			\$end = \$start + \$modulus;
			if (\$end > \$pageCount) {
				\$end = \$pageCount + 1;
				\$start = \$end - \$modulus;
			}
			for (\$i = \$start; \$i < \$end; \$i++) {
				\$url = array('page' => \$i);
				\$class = null;
				if (\$i == \$page) {
					\$url = array();
					\$class = 'active';
				} ";
			
			echo "\t\t\t	echo \$this->Html->tag('li', \$this->Paginator->link(\$i, \$url), array(
					'class' => \$class,
				)); ";
			
			echo "} ?>";
			echo"\t\t\t<?php echo \$this->Paginator->next('>', array(
				'tag' => 'li',
				'class' => 'next',
			), \$this->Paginator->link('>', array()), array(
				'tag' => 'li',
				'escape' => false,
				'class' => 'next disabled',
			)); ?>";
			?>
			
		</ul>
		</div>
		<?php endif; ?>
		</div>
	</div>
</div>

<?php 
echo "<?php echo \$this->Form->create('{$modelClass}',array('name'=>'modalForm','action'=>'add','class'=>'form-horizontal', 'model'=> '{$pluralVar}', 'canvas'=>'#{$canvasForm}',
																	'inputDefaults' => array( 	'label'=>array('class'=>'control-label'),
																								'div'=>array('class'=>'control-group')
																							)
																	)
											);?>\n";?>

<div id="intent-modal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="intent-label" aria-hidden="true">
  <div class="modal-header">
     <h3 id="intent-label"><span class="intent-text">Create </span><span class="intent-object"><?php echo $singularHumanName;?></span></h3>
  </div>
  <div class="modal-body">
  

<div class="row-fluid">
<div class="<?php echo $pluralVar;?> form span12">

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
<?php
	
	if (empty($associations['hasMany'])) {
		$associations['hasMany'] = array();
	}
	if (empty($associations['hasAndBelongsToMany'])) {
		$associations['hasAndBelongsToMany'] = array();
	}
	$relations = array_merge($associations['hasMany'], $associations['hasAndBelongsToMany']);
	$i = 0;
	foreach ($relations as $alias => $details):
		$otherSingularVar = Inflector::variable($alias);
		$otherClass = Inflector::classify($alias);
		$otherCanvasTable = $alias.'Table';
		$otherPluralHumanName = Inflector::humanize($details['controller']);
		$otherVarName = str_replace('_','-',$details['controller']);
		$otherModal = $otherVarName.'-modal';
		$otherIntentButton = 'add-'.$otherVarName;
?>
			<table cellpadding="0" cellspacing="0" class="table table-striped table-bordered table-condensed RECORD tablesorter canvasTable" id="<?php echo $otherCanvasTable; ?>" model="<?php echo $otherClass; ?>">
				<caption class="caption-bordered"><?php echo $otherPluralHumanName; ?></caption>
				<thead>
				<tr>
				<?php
					foreach ($details['fields'] as $field) {
						if(!in_array($field, array('created', 'modified', 'updated','id')))
						echo "\t\t<th><?php __('" . Inflector::humanize($field) . "'); ?></th>\n";
					}
				?>
					<th class="actions">Actions</th>
				</tr>
				</thead>
				<tbody class="hide">
					<tr>
						<?php
						$ctr = 0;
						foreach ($details['fields'] as $field) {
							if(!in_array($field, array('created', 'modified', 'updated','id')))
							echo "\t\t<td><span data-field='$alias.$field'></span></td>\n";
							$ctr++;
						}
						?>
						<td>
						<div class="btn-group">
							<div class="btn-group btn-center">
								<button class="btn dropdown-toggle" data-toggle="dropdown"><i class="icon-cog"></i><span class="caret"></span></button>
								<ul class="dropdown-menu">
									  <li><a  href="#<?php echo $otherModal; ?>" data-toggle="modal" data-dismiss="modal" class="action-add"><i class="icon-plus"></i> Add</a></li>
									 <li><a  href="#<?php echo $otherModal; ?>" data-toggle="modal" data-dismiss="modal" class="action-edit"><i class="icon-edit"></i> Edit</a></li>
									 <li><a href="#" class="action-delete"><i class="icon-remove"></i> Delete</a></li>
								</ul>
							</div>
						</div>
						</td>
					</tr>
				</tbody>
					
				<tfoot>
					<tr class="no-details">
						<td colspan="<?php echo $ctr++ ?>">
							<div class="well text-center">
								<button class="btn  btn-medium"  id="<?php echo $otherIntentButton; ?>" href="#<?php echo $otherModal; ?>" data-toggle="modal" data-dismiss="modal"><i class="icon-plus"></i> <?php echo $otherPluralHumanName; ?></button>
								<div class="muted">No <?php echo $otherPluralHumanName; ?> found, click to add.</div>
							</div>
						</td>
					</tr>
				</tfoot>
			</table>
	<?php endforeach;?>
</div>
</div>
	
  </div>
  <div class="modal-footer">
    <button class="btn btn-primary intent-save" type="submit">Save</button>
    <button class="btn intent-cancel" data-dismiss="modal" aria-hidden="true" type="submit">Cancel</button>
  </div>
  
</div>
<?php echo "<?php echo \$this->Form->end();?>\n"; ?>
<!-- CANVASFORM -->
<?php 
echo "<?php echo \$this->Form->create('{$modelClass}',array('action'=>'index',
															'class'=>'canvasForm',
															'id'=>'{$canvasForm}',
															'model'=> '{$modelClass}',
															'canvas'=>'#{$canvasTable}'
														)
											);?>\n";?>
<?php echo "<?php echo \$this->Form->end();?>\n"; ?>

<?php foreach ($relations as $alias => $details):
	$otherSingularHumanName = Inflector::humanize($alias);
	$otherModelClass = Inflector::classify($alias);
	$otherPluralVar = Inflector::variable(Inflector::pluralize($alias));
	$otherCanvasTable = $otherModelClass.'Table';
	$otherCanvasForm = $otherModelClass.'CanvasForm';
	$otherModalName = $alias.'Modal';
	$otherVarName = str_replace('_','-',$details['controller']);
	$otherModal = $otherVarName.'-modal';
?>
	<?php 
echo "<?php echo \$this->Form->create('{$otherModelClass}',array('name'=>'{$otherModalName}','action'=>'add','class'=>'form-horizontal', 'model'=> '{$otherPluralVar}', 'canvas'=>'#{$otherCanvasForm}',
																	'inputDefaults' => array( 	'label'=>array('class'=>'control-label'),
																								'div'=>array('class'=>'control-group')
																							)
																	)
											);?>\n";?>

		<div id="<?php echo $otherModal;?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="intent-label" aria-hidden="true">
			<div class="modal-header">
				<h3 id="intent-label"><span class="intent-text">Create </span><span class="intent-object"><?php echo $otherSingularHumanName;?></span></h3>
			</div>
			<div class="modal-body">
  
				<div class="row-fluid">
					<div class="<?php echo $otherPluralVar;?> form span12">
					
					<?php
							$fields =  $details['fields'];
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
					</div>		
				</div>
			</div>
			 <div class="modal-footer">
				<button class="btn btn-primary intent-save" type="submit">Save</button>
				<button class="btn intent-cancel" data-dismiss="modal" aria-hidden="true" type="submit">Cancel</button>
			 </div>
		</div>
<?php echo "<?php echo \$this->Form->end();?>\n"; ?>
<?php 
echo "<?php echo \$this->Form->create('{$otherModelClass}',array('action'=>'index',
															'class'=>'canvasForm',
															'id'=>'{$otherCanvasForm}',
															'model'=> '{$otherModelClass}',
															'canvas'=>'#{$otherCanvasTable}'
														)
											);?>\n";?>
<?php echo "<?php \$this->Form->input('{$details['foreignKey']}',array('type'=>'hidden','value'=>null,'role'=>'foreign-key')); ?>\n" ?>
<?php echo "<?php echo \$this->Form->end();?>\n"; ?>
<?php endforeach; ?>

<?php echo"<?php echo \$this->Html->script(array('ui/uiTable1.1','utils/canvasTable'),array('inline'=>false));?>" ?>