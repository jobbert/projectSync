<div class="navigatie" id="admin-navigatie">
	<ul class='ul'>
		<li onclick="location.href = 'index.php?page=kosten'">Kosten</li>
		<li onclick="location.href = 'index.php?page=declaratie-onderhoud'">Declaraties</li>
		<li onclick="location.href = 'index.php?page=projecten'">Projecten</li>
		<li onclick="location.href = 'index.php?page=consultants'">Consultants</li>
		<li id="Overzicht" onclick="document.getElementById('Overzicht-options').style.display = 'flex'; this.style.display = 'none'">Overzicht</li>
		<ul id="Overzicht-options" onclick="document.getElementById('Overzicht').style.display = 'flex'; this.style.display = 'none'" style="display:none; padding:0;">
			<li style=''>Overzicht<span style='font-size:8px;'>&nbsp per</span></li>
			<li style='border-bottom:0;' onclick="location.href = 'index.php?page=overzicht&x=cp'; this.parentNode.style.display = 'none';">Consultant</li>
			<li style='border-bottom:0;' onclick="location.href = 'index.php?page=overzicht&x=pc'; this.parentNode.style.display = 'none';">Project</li>
		</ul>
		<li onclick="confirm_logout()">Loguit</li>
	</ul>
</div>
   