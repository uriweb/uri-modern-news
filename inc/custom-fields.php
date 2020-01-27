<?php
/**
 * Features custom post type and fields
 *
 * @package uri-modern-news
 */

if ( function_exists( 'acf_add_local_field_group' ) ) :

acf_add_local_field_group(
	array(
		'key' => 'group_5c23a496d6004',
		'title' => 'COPE Fields',
		'fields' => array(
			array(
				'key' => 'field_5911c478a8175',
				'label' => 'Short Headline',
				'name' => 'short_headline',
				'type' => 'text',
				'instructions' => 'A short version of the headline (5 words or less).	Written and optimized for the web.',
				'required' => 1,
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
				'formatting' => 'html',
				'maxlength' => '',
			),
			array(
				'key' => 'field_5734b7fc07aed',
				'label' => 'Deck',
				'name' => 'deck',
				'type' => 'textarea',
				'instructions' => 'A short summary (sentence) that explains what the article is about. Limit 250 characters.',
				'required' => 1,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
				'maxlength' => 250,
				'rows' => 3,
				'new_lines' => '',
			),
			array(
				'key' => 'field_5734b86f07aee',
				'label' => 'Lead',
				'name' => 'lead',
				'type' => 'textarea',
				'instructions' => 'The first paragraph of the story.',
				'required' => 1,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
				'maxlength' => '',
				'rows' => 3,
				'new_lines' => '',
			),
			array(
				'key' => 'field_5734b8bd07aef',
				'label' => 'Nutshell',
				'name' => 'nutshell',
				'type' => 'textarea',
				'instructions' => 'A brief description of the key points.	Who, what, when, where, why, and how. Can be bullet points.',
				'required' => 1,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
				'maxlength' => '',
				'rows' => '',
				'new_lines' => '',
			),
			array(
				'key' => 'field_5911c4f3143ac',
				'label' => 'Square Image',
				'name' => 'image_square',
				'type' => 'image',
				'instructions' => 'A square-cropped version of the featured image for use on the homepage, News from URI, and other publications.',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'preview_size' => 'thumbnail',
				'library' => 'all',
				'return_format' => 'array',
				'min_width' => 0,
				'min_height' => 0,
				'min_size' => 0,
				'max_width' => 0,
				'max_height' => 0,
				'max_size' => 0,
				'mime_types' => '',
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'post',
				),
				array(
					'param' => 'post_category',
					'operator' => '==',
					'value' => '2',
				),
			),
		),
		'menu_order' => 0,
		'position' => 'acf_after_title',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => array(),
		'active' => 1,
		'description' => '',
	)
);


acf_add_local_field_group(
	array(
		'key' => 'group_5c23a496f02fd',
		'title' => 'Media Contact Fields',
		'fields' => array(
			array(
				'key' => 'field_56f97eaba1a90',
				'label' => 'First Name',
				'name' => 'first_name',
				'type' => 'text',
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
				'prepend' => '',
				'append' => '',
				'formatting' => 'none',
				'maxlength' => '',
			),
			array(
				'key' => 'field_56f97ed1a1a91',
				'label' => 'Last Name',
				'name' => 'last_name',
				'type' => 'text',
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
				'prepend' => '',
				'append' => '',
				'formatting' => 'none',
				'maxlength' => '',
			),
			array(
				'key' => 'field_56f97edca1a92',
				'label' => 'Email',
				'name' => 'email',
				'type' => 'text',
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
				'prepend' => '',
				'append' => '',
				'formatting' => 'none',
				'maxlength' => '',
			),
			array(
				'key' => 'field_56f97eeca1a93',
				'label' => 'Telephone',
				'name' => 'telephone',
				'type' => 'text',
				'instructions' => 'e.g. 401-874-1234',
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
				'formatting' => 'none',
				'maxlength' => '',
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'post_category',
					'operator' => '==',
					'value' => '3',
				),
			),
		),
		'menu_order' => 0,
		'position' => 'normal',
		'style' => 'seamless',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => array(),
		'active' => 1,
		'description' => '',
	)
);

acf_add_local_field_group(
	array(
		'key' => 'group_5c23a49702a08',
		'title' => 'Press Release Fields',
		'fields' => array(
			array(
				'key' => 'field_56fa801133193',
				'label' => 'Media Contact',
				'name' => 'media_contact',
				'type' => 'relationship',
				'instructions' => 'Select the media contact for this release.',
				'required' => 1,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'return_format' => 'id',
				'post_type' => array(
					0 => 'post',
				),
				'taxonomy' => array(
					0 => 'category:3',
				),
				'filters' => array(
					0 => 'search',
				),
				'max' => '',
				'min' => 0,
				'elements' => array(
					0 => 'post_type',
				),
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'post_category',
					'operator' => '==',
					'value' => '2',
				),
			),
		),
		'menu_order' => 0,
		'position' => 'acf_after_title',
		'style' => 'seamless',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => array(),
		'active' => 1,
		'description' => '',
	)
);

acf_add_local_field_group(array(
	'key' => 'group_5e2eef5bd6d48',
	'title' => 'Sticky Order',
	'fields' => array(
		array(
			'key' => 'field_5e2eefa926a8e',
			'label' => 'Order',
			'name' => 'sticky_order',
			'type' => 'range',
			'instructions' => 'Specify the order of the top 4 news stories.	(lower numbers appear first)',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => 30,
			'min' => '',
			'max' => '',
			'step' => '',
			'prepend' => '',
			'append' => '',
		),
	),
	'location' => array(
		array(
			array(
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'post',
			),
			array(
				'param' => 'post_category',
				'operator' => '==',
				'value' => 'category:news',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'side',
	'style' => 'seamless',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => true,
	'description' => 'Sticky Post Order',
));


endif;
