<?php

	$previous_image = '';
	$previous_post = get_previous_post( true );
	if ( $previous_post ) {
		$previous_image = get_the_post_thumbnail( $previous_post->ID, array( 150, 150 ) );
		$previous_image = str_replace( 'style="width:150px" class="', 'class="', $previous_image );
	}

?>
<div class="end-of-article-call" id="uri-next">
	<h4>Next:</h4>
	<div class="previous">
	<?php
		previous_post_link( '%link', $previous_image . '%title', true );
	?>
	</div>
	
</div>

<?php
?>
