<?php
if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array(
	'key' => 'group_5cd00bf74c67b',
	'title' => 'Endpoint Fields',
	'fields' => array(
		array(
			'key' => 'field_5cd00c35daac4',
			'label' => 'URL',
			'name' => 'url',
			'type' => 'url',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
		),
		// array(
		// 	'key' => 'field_5cd00c54daac5',
		// 	'label' => 'Cron Frequency',
		// 	'name' => 'cron_frequency',
		// 	'type' => 'select',
		// 	'instructions' => '',
		// 	'required' => 0,
		// 	'conditional_logic' => 0,
		// 	'wrapper' => array(
		// 		'width' => '',
		// 		'class' => '',
		// 		'id' => '',
		// 	),
		// 	'choices' => array(
		// 		'hourly' => 'Hourly',
		// 		'twice_daily' => 'Twice Daily',
		// 		'daily' => 'Daily',
		// 	),
		// 	'default_value' => array(
		// 		0 => 'daily',
		// 	),
		// 	'allow_null' => 0,
		// 	'multiple' => 0,
		// 	'ui' => 1,
		// 	'ajax' => 0,
		// 	'return_format' => 'value',
		// 	'placeholder' => '',
		// ),
		array(
			'key' => 'field_5cd03788bc489',
			'label' => 'FIle Name',
			'name' => 'file_name',
			'type' => 'text',
			'instructions' => 'FIles are saved in the uploads directory + ' . WP_GROWL_ENDPOINTS_DIR,
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
			'readonly' => 1,
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'endpoint',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => 1,
	'description' => '',
));

endif;