( function () {
	'use strict';

	function getTimeZone( value ) {
		var offset = /^([+-])(\d{2}):(\d{2})$/.exec( value );

		if ( ! offset ) {
			return { name: value, offset: 0 };
		}

		return {
			name: 'UTC',
			offset: ( offset[ 1 ] === '-' ? -1 : 1 ) *
				( Number( offset[ 2 ] ) * 60 + Number( offset[ 3 ] ) )
		};
	}

	function updateClock( element ) {
		var locale = element.dataset.locale || 'hu-HU';
		var zone = getTimeZone( element.dataset.timezone || 'UTC' );
		var now = new Date( Date.now() + zone.offset * 60000 );
		var options = {
			timeZone: zone.name,
			hour: '2-digit',
			minute: '2-digit',
			second: '2-digit',
			hourCycle: 'h23'
		};
		var formatter;

		try {
			formatter = new Intl.DateTimeFormat( locale, options );
		} catch ( error ) {
			options.timeZone = 'UTC';
			formatter = new Intl.DateTimeFormat( 'hu-HU', options );
		}

		element.textContent = formatter.format( now );
		element.dateTime = new Date().toISOString();
	}

	function updateClocks() {
		document.querySelectorAll( '.hun-nevnap-time' ).forEach( updateClock );
	}

	function updateAddedClocks( mutations ) {
		mutations.forEach( function ( mutation ) {
			mutation.addedNodes.forEach( function ( node ) {
				var clocks;

				if ( Node.ELEMENT_NODE !== node.nodeType ) {
					return;
				}

				if ( node.matches( '.hun-nevnap-time' ) ) {
					updateClock( node );
				}

				clocks = node.querySelectorAll( '.hun-nevnap-time' );
				clocks.forEach( updateClock );
			} );
		} );
	}

	updateClocks();
	window.setInterval( updateClocks, 1000 );

	new MutationObserver( updateAddedClocks ).observe( document.body, {
		childList: true,
		subtree: true
	} );
}() );
