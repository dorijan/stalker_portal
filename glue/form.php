<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>API Glue</title>
    <link rel="stylesheet" href="css/foundation.css" />
    <script src="js/vendor/modernizr.js"></script>
  </head>
  <body>
    
    <div class="row">
      <div class="large-12 columns">
        <h1>API Glue</h1>
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
		<option value="add">Add</option>
		<option value="remove">Remove</option>		
	  </select>
      </label>
	</div>	  
  </div>
  <div class="row">
    <div class="large-12 columns">	  
      <label>First and last name
        <input type="text" placeholder="First and last name" name="fname"/>
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
      <label>MAC
        <input type="text" placeholder="MAC" name="mac"/>
      </label>
	</div>	  
  </div>  
  <div class="row">
    <div class="large-12 columns">	  
      <label>Gender
	  <select name="gender">
		<option value="0">Mr. - adult or married man </option>
		<option value="1">Mrs. - Married woman </option>		
		<option value="2">Ms. Won't tell you </option>				
		<option value="3">Miss - unmarried woman </option>				
		<option value="4">Master - Unmarried man </option>		
	  </select>
      </label><br>
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