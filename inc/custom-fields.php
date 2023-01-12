<?php
/**
 * Custom post type and fields
 *
 * @package uri-modern-news
 */

if ( function_exists( 'acf_add_local_field_group' ) ) :

acf_add_local_field_group(
	array(
		'key' => 'group_5c23a496d6004',
		'title' => 'News Display Fields',
		'fields' => array(
			array(
				'key' => 'field_5734b7fc07aed',
				'label' => 'Subhead',
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
				'key' => 'field_63c0443f4d9be',
				'label' => 'Horizontal Image',
				'name' => 'horizontal_image',
				'type' => 'image',
				'instructions' => 'A horizontal-cropped version of the featured image for use on the homepage and other publications. (Accepts images from 1200px to 2560px wide)',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'return_format' => 'array',
				'preview_size' => 'thumbnail',
				'library' => 'all',
				'min_width' => 1200,
				'min_height' => '',
				'min_size' => '',
				'max_width' => 2560,
				'max_height' => 2560,
				'max_size' => '',
				'mime_types' => 'jpg, jpeg',
			),
			array(
				'key' => 'field_63c0447e4d9bf',
				'label' => 'Vertical Image',
				'name' => 'vertical_image',
				'type' => 'image',
				'instructions' => 'A vertically-cropped version of the featured image for use on the homepage and other publications. (Accepts images from 1200px to 2560px high)',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'return_format' => 'array',
				'preview_size' => 'thumbnail',
				'library' => 'all',
				'min_width' => '',
				'min_height' => 1200,
				'min_size' => '',
				'max_width' => 2560,
				'max_height' => 2560,
				'max_size' => '',
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

acf_add_local_field_group(
	array(
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
	)
	);

	// Media Mentions
	acf_add_local_field_group(
		array(
			'key' => 'group_63b6f040cd6a0',
			'title' => 'Media Mention',
			'fields' => array(
				array(
					'key' => 'field_63b6f2bc8e712',
					'label' => 'Media Outlet',
					'name' => 'media_outlet',
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
					'maxlength' => '',
				),
				array(
					'key' => 'field_63b6f2f38e713',
					'label' => 'Publication Date',
					'name' => 'publication_date',
					'type' => 'date_picker',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'display_format' => 'F j, Y',
					'return_format' => 'F j, Y',
					'first_day' => 0,
				),
			),
			'location' => array(
				array(
					array(
						'param' => 'post_category',
						'operator' => '==',
						'value' => 'category:media-mention',
					),
				),
			),
			'menu_order' => 0,
			'position' => 'acf_after_title',
			'style' => 'default',
			'label_placement' => 'top',
			'instruction_placement' => 'label',
			'hide_on_screen' => '',
			'active' => true,
			'description' => '',
		)
		);


endif;
