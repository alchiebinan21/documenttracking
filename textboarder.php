<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>CodexWorld - Autocomplete Textbox with Multiple Values using jQuery, PHP and MySQL</title>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
	
    <!-- Autocomplete Multiple Values -->
    <script>
    $(function() {
        function split( val ) {
            return val.split( /,\s*/ );
        }
        function extractLast( term ) {
            return split( term ).pop();
        }
        
        $( "#fname" ).bind( "keydown", function( event ) {
            if ( event.keyCode === $.ui.keyCode.TAB &&
                $( this ).autocomplete( "instance" ).menu.active ) {
                event.preventDefault();
            }
        })
        .autocomplete({
            minLength: 1,
            source: function( request, response ) {
                // delegate back to autocomplete, but extract the last term
                $.getJSON("autocomplete.php", { term : extractLast( request.term )},response);
            },
            focus: function() {
                // prevent value inserted on focus
                return false;
            },
            select: function( event, ui ) {
                var terms = split( this.value );
                // remove the current input
                terms.pop();
                // add the selected item
                terms.push( ui.item.value );
                // add placeholder to get the comma-and-space at the end
                terms.push( "" );
                this.value = terms.join( ", " );
                return false;
            }
        });
    });
    </script>
    
    
    
</head>
<body>
<div class="ui-widget">
    
	<form action="multiplename.php" method="post">
	
	<label for="fname">Input name: </label>
    <input id="fname" name="fname" size="50">
	<input type="submit" name="share" value="share" />
	</form>
	
</div>

 
 
</body>
</html>