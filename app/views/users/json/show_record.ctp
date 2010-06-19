<?php //echo $contact ?>
<?php //echo $this->element('contacts_details'); ?>
<style type="text/css">
	#adres-contact-window ul li a{
		padding:0.2em 0.5em;
	}
</style>

<div id="adres-contact-window" class="adres-tabs">
	<ul>
		<li><a title="contact-window" href="#"><span>Display	</span></a></li>
		<li><a title="contact-window" href="#"><span>Edit		</span></a></li>
		<li><a title="contact-window" href="#"><span>Group	</span></a></li>
		<li><a title="contact-window" href="#"><span>Affiliation</span></a></li>
		<li><a title="contact-window" href="#"><span>History	</span></a></li>
	</ul>
	<div id="contact-window"></div>
</div>


<script type="text/javascript">
	$('#adres-contact-window').tabs();
</script>