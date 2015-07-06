<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Rented movies</title>
    <link rel="stylesheet" href="css/foundation.css" />
    <script src="js/vendor/modernizr.js"></script>
  </head>
  <body>
    
    <div class="row">
      <div class="large-12 columns">
        <h1>Rented movies</h1>
      </div>
    </div>
    
    <div class="row">
      <div class="large-12 columns">
      	<div class="panel">

<form action="iptv.php" method="get">
  <div class="row">
    <div class="large-12 columns">
      <label>What
	  <select name="what">
		<option value="rentshow">Show rented</option>
		<option value="removerent">Clear rented</option>		
	  </select>
      </label>
	</div>	  
  </div>
  <div class="row">
    <div class="large-12 columns">	  
      <label>Room
        <input type="text" placeholder="Room" name="room"/>
      </label>
	</div>	  
  </div>  
  <div class="row">
    <div class="large-12 columns">	  
	  <input type="submit" value="Submit">
    </div>
  </div>		

</form>  
		
        </div>
      </div>
    </div>
    
    <script src="js/vendor/jquery.js"></script>
    <script src="js/foundation.min.js"></script>
    <script>
		$(document).foundation();
		$(document).ready(function() {
		  $(window).keydown(function(event){
			if(event.keyCode == 13) {
			  event.preventDefault();
			  return false;
			}
		  });
		});	  
    </script>
  </body>
</html>