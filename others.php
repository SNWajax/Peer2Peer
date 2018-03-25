<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="css/other.css">
    </head>
    <body>
        <div class="bdy-main">
			<form action="back/addOthers.php" class = "w3-container w3-card-4 w3-light-grey" method="post">
                <div class="meh">
                    <h1>OTHER STUFF</h1>
                    <select name="items" class="itm">
                        <option value="food">Food</option>
                        <option value="clothes">Clothing</option>
                        <option value="misc">MISC</option>
                    </select>
                    <br>
					<label>Item</label>
                    <input type='string' class = 'w3-input w3-border w3-round' name='itemToAdd' placeholder ='Item to add'>
                    <input type='submit' class = 'w3-input w3-border w3-round' min='0' required value='ADD Item'>
                </div>
			</form>
        </div>
		<a href = "back/logOut.php">
			<button class = "buttonReturn">
				Log out
			</button>
		</a>
    </body>
    <script>
    /* When the user clicks on the button, 
    toggle between hiding and showing the dropdown content */
    function myFunction() {
        document.getElementById("myDropdown").classList.toggle("show");
    }
    // Close the dropdown if the user clicks outside of it
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
    </script>
</html>