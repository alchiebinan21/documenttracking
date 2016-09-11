var mainMenu = (function() {

	var $listItems = $( '#mainmenu > ul > li.has-submenu' ),
		$menuItems = $listItems.children( 'a' ),
		$body = $( 'body' ),
		current = -1;

	function init() {
		$menuItems.on( 'click', open );
		$listItems.on( 'click', function( event ) { event.stopPropagation(); } );
	}

	function open( event ) {

		var $item = $( event.currentTarget ).parent( 'li.has-submenu' ),
			idx = $item.index();
		if($item.length != 0){
			if( current !== -1 ) {
				$listItems.eq( current ).removeClass( 'mainmenu-open' );
			}

			if( current === idx ) {
				$item.removeClass( 'mainmenu-open' );
				current = -1;
			}
			else {
				$item.addClass( 'mainmenu-open' );
				current = idx;
				$body.off( 'click' ).on( 'click', close );
			}
			return false;
		}
		else window.location = $item.find('a').attr('href');
	}

	function close( event ) {
		$listItems.eq( current ).removeClass( 'mainmenu-open' );
		current = -1;
	}

	return { init : init };

})();



/* When the user clicks on the button, 
toggle between hiding and showing the dropdown content */
function myFunction() {
    document.getElementById("myDropdown").classList.toggle("show");
}



// Close the dropdown menu for notification if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {

    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}


//NOTIFICATION DROP DOWN

/* When the user clicks on the button, 
toggle between hiding and showing the dropdown content for notification */
function myFunctionNotif() {
    document.getElementById("myDropdownNotif").classList.toggle("show");
}

// Close the dropdown menu for notification if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {

    var dropdownsNotif = document.getElementsByClassName("dropdown-content");
    var x;
    for (x = 0; x < dropdownsNotif.length; x++) {
      var openDropdownNotif = dropdownsNotif[x];
      if (openDropdownNotif.classList.contains('show')) {
        openDropdownNotif.classList.remove('show');
      }
    }
  }
}
