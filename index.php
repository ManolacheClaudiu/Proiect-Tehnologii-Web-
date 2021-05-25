<?php
  include_once 'header.php';
?>
		<div class="MiddleLayout">
			<?php
			include_once 'navigationMenu.php';
			?>
			<div class="CodeBox">
		
             	 <form action="/action_page.php">
					<label for="CodeBox"></label>
					<textarea id="CodeBox" name="Codebox" placeholder="Write your code here!" rows="17" cols="500"></textarea>
  					<br>
					  <ul>
						<li>
							
								<label for="Valability">
									Valability<br>
								</label>
								<select id="Valability" name="Valability">
									<option value="1">1 day</option>
									<option value="2">2 days</option>
									<option value="3">3 days</option>
									<option value="4">4 days</option>
									<option value="5">5 days</option>
									<option value="6">6 days</option>
									<option value="7">7 days</option>
									<option value="8">8 days</option>
									<option value="9">9 days</option>
									<option value="10">10 days</option>
									<option value="15">15 days</option>
									<option value="20">20 days</option>
									<option value="25">25 days</option>
									<option value="30">30 days</option>
								</select>							
						</li>
						<li>
							
								<label for="Visibility">
								<br>Visibility<br>
								</label>
								<select id="Visibility" name="Visibility">
									<option value="public">public</option>
									<option value="private">private</option>
								</select>
							
						</li>
						<li>
							
							<label for="username">
							<br>Colaborators<br>
							</label>
						
							<input type="text" id="username" name="username" size="9" >
						
						</li>
						<li>
							
								<label for="pwd"><br>Password:<br></label>
								<input type="password" id="pwd" name="pwd" size="9"> 
							
						</li>
					</ul>
				<br>
  					<input type="submit" value="Submit">
				</form>
            </div>
        </div>
       
<?php
  include_once 'footer.php';
?>
