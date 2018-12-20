<?php
$page = "contact";
include 'partial/head.php';
?>

		<div class="main">
			<aside class="left">
			</aside>
			<div id="content">
				<div id="effect" class="ui-widget-content ui-corner-all">
					<form action="contact_info" method="post" id="myform">
						<h2 id="formHeader">Formularz kontaktowy</h2>
						<div class="flex3">
							<div class="formcolumn">
								<label for="firstName">Imię</label><br />
								<input type="text" name="firstName" id="firstName" title="Podaj swoje imie" /><br />
								<label for="lastName">Nazwisko</label><br />
								<input type="text" name="lastName" id="lastName" title="Podaj swoje nazwisko" /><br />
								<label for="email">Email</label><br />
								<input type="email" name="email" id="email" title="Podaj swojego maila, byśmy mogli do ciebie napisać."><br />
								<label for="phone">Telefon</label><br />
								<input type="tel" name="phone" id="phone"  title="Podaj numer telefonu, jeśli chcesz byśmy oddzwonili." />
								<br /><br />
							</div>
							<div class="formcolumn">
								<span>Płeć</span><br />
								<input type="radio" name="gender" id="male" value="male" />
								<label for="male">Mężczyzna</label><br />
								<input type="radio" name="gender" id="female" value="female" />
								<label for="female">Kobieta</label><br /> <br /><br />
								<span>Wiek</span><br />
								<input type="text" name="age" id="ageval" readonly value="30-39">
								<div id="slider"></div>
							</div>
						</div><br /><br />
						<span>Rodzaj zapytania</span><br />
						<input type="checkbox" name="requesttype[]" value="question" id="question" />
						<label for="question">Pytanie</label>
						<input type="checkbox" name="requesttype[]" value="cooperation" id="cooperation" />
						<label for="cooperation">Propozycja współpracy</label>
						<br />
						<input type="checkbox" name="requesttype[]" value="comment" id="comment" />
						<label for="comment">Uwaga do treści</label>
						<input type="checkbox" name="requesttype[]" value="other" id="other" />
						<label for="other">Inne</label>
						<br /><br />
						
						<textarea name="message" placeholder="Tutaj wpisz treść zapytania."></textarea><br />
						<input type="submit" value="Wyślij" class="button" />
						<input type="reset" class="button" id="reset" />
						<input type="button" class="button" value="Help" id="help" />
					</form>
				</div>
			</div>
			<aside class="right">
			</aside>
		</div>

<?php include 'partial/footer.php' ?>