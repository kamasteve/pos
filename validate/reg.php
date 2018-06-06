<?
?>
<div id="container">
		<div id="example">
			<div id="validationMessage"></div>
		  <form id='myForm' action="server.asp" method="post">
		  	<p><label for="name">First Name:*</label><input id="name" name="first" title="Please enter the first name" type="text"  class="required" /></p>
			  	<p><label for="name">Middle Name:*</label><input id="middle" name="middle" title="Please enter the middle name" type="text"  class="required" /></p>
				  	<p><label for="name">Last Name:*</label><input id="last" name="last" title="Please enter the first name" type="text"  class="required" /></p>
			<p><label for="email">Email:*</label><input id="email" name="email" title="Please enter your email" type="text" class="required email" /></p>
			<p><label for="phone">Phone:*</label><input id="phone" name="phone" title="Phone Number" type="text" class="required number" /></p>
			<p><label for="fax">Fax:</label><input id="fax" name="fax" type="text" /></p>
			<p><label for="address">Address:*</label><textarea id="address" name="address" title="Address" class="required"></textarea><p>
			<p><label for="postcode">Postcode:*</label><input id="postcode" name="postcode" title="Postcode" type="text" class="required postcode" /></p>
				<p><label for="sex">Sex:*</label><input type="radio" title="Sex" name="sex" value="male" class="required" />Male
			<input type="radio" name="sex" value="female" class="required" />Female</p>