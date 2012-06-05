<div class="adres-tabs">

	<ul>
		<li><a href="#tabs-1"><span>Avd Search</span></a></li>
		<li><a href="#tabs-2"><span>Aff Search</span></a></li>
		<li><a href="#tabs-3"><span>Customize</span></a></li>
	</ul>

	<div id="tabs-1">
		<?php echo $form->create('AdvanceSearch',array(
			'url'=>array(
				'controller'=>'users',
				'action'=>'add_criteria'
			),
			'class' => 'adres-ajax-form'
			)) ?>
			<?php
			/*-------------------------------
			| Advance Search generated form
			| the plugin
			|-------------------------------*/
			?>
			<?php echo $advance_search_form ?>

		<?php echo $form->end(array('label'=>'Advance Search','class'=>'adres-button')) ?>
	</div>

	<div id="tabs-2">
		<?php echo $form->create('Affiliation',array(
			'url' => array(
				'controller' => 'users',
				'action' => 'search_by_affiliation'
			),
			'class' => 'adres-ajax-form',
			))
		 ?>
			<?php echo $form->input('aff_selection_id',array(
				'type' => 'radio',
				'options' => 'Affiliation'
			)) ?>
			<?php echo $form->input('aff_selection_id',array(
				'type' => 'radio',
				'options' => 'Affiliation + Contact'
			)) ?>
			<?php echo $form->input('aff_selection_id',array(
				'type' => 'radio',
				'options' => 'Affiliation + Filter'
			)) ?>
			<?php echo $form->input('affiliation_id',array(
				'type' => 'select',
				'options' => $html->getAffliationSelectValues($affiliations)
			)) ?>
			<?php echo $form->input('contact_id',array(
				'class' => 'advance_search_contact adres-contact-picker'
			)) ?>

            <b>OR</b>
            <?php echo $form->input('filter_id',array(
                'type'=>'select',
                'options'=>$filters,
                'empty'=>'Select One',
                'class'=>'adres-filter-template'
            ))?>
		<?php echo $form->end('Aff Search') ?>
	</div>

	<div id="tabs-3">



	</div>

</div>

<script type="text/javascript">

$(function(){
    $('#AffiliationAffiliationId').bind("change",ADres.SELECT.affiliated_filters);
    $('#AffiliationAffiliationId').bind("change",ADres.SELECT.update_contact_picker);
	ADres.SELECT.autocomplete_affliation(null);

    $('.adres-tabs').tabs();
    $('select').selectmenu({width:230});

});
</script>

