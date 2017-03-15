<!doctype html>

<html>
	<head>
		<meta charset="utf-8">
		<title>Adminpagina</title>
		<link rel="stylesheet" type="text/css" href="Adminpagina.css">
	</head>


<body>
<div id="container">
<h1>Het adressboek</h1>
	<div id="loginvak">
		<form>
			<p>Voornaam:</p><input class="textvak" type="text" name="gebruikersnaam">
			<p>Tussenvoegsel:</p> <input class="textvak" type="text" name="tussenvoegsel">
            <p>Achternaam:</p> <input class="textvak" type="text" name="gebruikersnaam">
            <p>Telefoon Nummer:</p> <input class="textvak" type="text" name="gebruikersnaam">
            <p>Adress:</p> <input class="textvak" type="text" name="gebruikersnaam">
            <input class="button" type="submit" value="Zoeken" style="height: 40px">
						<input class="button" type="submit" value="Toevoegen" style="height: 40px">
						<input class="button" type="submit" value="Wijzigen" style="height: 40px">
						<input onclick="verwijder()"  class="button" type="submit" value="Verwijderen" style="height: 40px";>
		</form>
    <button id="loguit">Log uit</button>
    <button id="AddUser">Gebruiker toevoegen</button>
	</div>

	<div id="tabel">

		<table>

			<tr>
				<th class="checkbox"><input onchange="checkAll(this)" name="chk[]" validate id="check" class="checkbox" type="checkbox"></th>
				<th>Voornaam</th>
				<th class="klein">Tussenvoegsel</th>
				<th>Achternaam</th>
				<th>Telefoon Nummer</th>
				<th>Adress</th>
				<th class="icon"></th>
			</tr>
			<tr>
				<td class="checkbox"><input id="check" class="checkbox" type="checkbox"></td>
				<td>Rik</td>
				<td class="klein"></td>
				<td>Bosman</td>
				<td>06123456789</td>
				<td>AB 8338</td>
				<td class="icon"><button class="weizigbutton"><img src="/Users/egbert-janterpstra/Downloads/icon.ico"></button</td>
			</tr>
			<tr>
				<td class="checkbox"><input id="check" class="checkbox" type="checkbox"></td>
				<td>Johua</td>
				<td class="klein"></td>
				<td>Goudsblom</td>
				<td>06123456789</td>
				<td>AB 8338</td>
				<td class="icon"><button class="weizigbutton"><img src="/Users/egbert-janterpstra/Downloads/icon.ico"></button</td>
			</tr>
			<tr>
				<td class="checkbox"><input id="check" class="checkbox" type="checkbox"></td>
				<td>Ka Chung</td>
				<td class="klein"></td>
				<td>Li</td>
				<td>06123456789</td>
				<td>AB 8338</td>
				<td class="icon"><button class="weizigbutton"><img src="/Users/egbert-janterpstra/Downloads/icon.ico"></button</td>
			</tr>
			<tr>
				<td class="checkbox"><input id="check" class="checkbox" type="checkbox"></td>
				<td>Darwin</td>
				<td class="klein">de</td>
				<td>Wilde</td>
				<td>06123456789</td>
				<td>AB 8338</td>
				<td class="icon"><button class="weizigbutton"><img src="/Users/egbert-janterpstra/Downloads/icon.ico"></button</td>
			</tr>
			<tr>
				<td class="checkbox"><input id="check" class="checkbox" type="checkbox"></td>
				<td>Egbert-Jan</td>
				<td class="klein"></td>
				<td>Terpstra</td>
				<td>06123456789</td>
				<td>AB 8338</td>
				<td class="icon"><button class="weizigbutton"><img src="/Users/egbert-janterpstra/Downloads/icon.ico"></button</td>
			</tr>
		</table>
	</div>

</div>




</body>

<script type="text/javascript">
  document.getElementById("loguit").onclick = function() {
      location.href = "http://adressboek.000webhostapp.com/uitlog.php/";
    };
    document.getElementById("AddUser").onclick = function() {
        location.href = "http://adressboek.000webhostapp.com/AddUser.php/";
      };


	function checkAll(ele)
	{
		var checkboxes = document.getElementsByTagName('input');
		if (ele.checked)
		{
			for (var i = 0; i < checkboxes.length; i++)
			{
				if (checkboxes[i].type == 'checkbox')
				{
					checkboxes[i].checked = true;
				}
			}
		}

		else
		{
			for (var i = 0; i < checkboxes.length; i++)
			{

				if (checkboxes[i].type == 'checkbox')
				{
					checkboxes[i].checked = false;
				}
			}
		}
	}

function verwijder()
{

	if(document.getElementById('check').checked)
	{
		alert("Weet u zeker dat u dit wilt verwijderen?");

	}
	else
	{
		alert("Selecteer iets");

	}
}



	 </script>
</html>
