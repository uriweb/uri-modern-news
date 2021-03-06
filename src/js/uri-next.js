/**
 * File uri-next.js.
 *
 * Handles animation for the "up next" box
 *
 * @package uri-modern-news
 */
( function() {
	"use strict";

	let showNext = false;

	window.addEventListener(
		"load",
		function() {
			const el = document.getElementById( "uri-next" );
			if ( el === null ) {
				return;
			}
			window.addEventListener(
				"scroll",
				function() {
					nextOnScreen();
				},
				false
			);
			el.className += " hidden";
		},
		false
	);

	function nextOnScreen() {
		if ( showNext ) {
			return;
		}
		const el = document.getElementById( "uri-next" );
		if ( isElementInViewport( el ) ) {
			el.className = el.className.replace( /hidden/i, "shown" );
			showNext = true;
		} else {
			el.className = el.className.replace( /shown/i, "hidden" );
		}
	}

	function isElementInViewport( el ) {
		const rect = el.getBoundingClientRect();

		return (
			rect.top >= 0 &&
			rect.left >= 0 &&
			rect.top <= ( window.innerHeight || document.documentElement.clientHeight ) && /*or $(window).height() */
			rect.right <= ( window.innerWidth || document.documentElement.clientWidth ) /*or $(window).width() */
		);
	}
}( ) );
