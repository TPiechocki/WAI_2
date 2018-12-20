function local(index)
{
	var tab = locReadArr();
	tab[index-1] = index;
	document.getElementById("localRead").innerHTML = displayArr(tab);
	localStorage.setItem("ReadLocal", tab);
}
function session(index)
{
	var tab = sessReadArr();
	tab[index-1] = index;
	document.getElementById("sessionRead").innerHTML = displayArr(tab);
	sessionStorage.setItem("ReadSession", tab);
}

function displayArr(tab)
{	
	var display = '';
	for(var i = 0; i < tab.length; i++)
	{	
		if(tab[i])
			display += tab[i] + ', ';
	}
	return display.slice(0, -2);
}

function locReadArr(){
	if(localStorage.ReadLocal)
		var str = localStorage.getItem("ReadLocal");
	else{
		localStorage.setItem("ReadLocal", ",");
		var str = ",";
	}
	return tab = str.split(',');	
}
function sessReadArr(){
	if(sessionStorage.ReadSession)
		var str = sessionStorage.getItem("ReadSession");
	else{
		sessionStorage.setItem("ReadSession", ",");
		var str = ",";
	} 
	return tab = str.split(',');
}


function altMap()
{
	document.getElementById("mazuryLink").innerHTML = "Mapa z atrakcjami";
	document.getElementById("mazuryLink").style.color = "red";
	document.getElementById("mazuryLink").setAttribute("href", "http://www.suwalszczyzna.com.pl/mapa/mapa_zobacz/mapa_mazury.htm");
	document.getElementById("altMap").style.display = "none";
}

function addPoint()
{	
		sessionStorage.setItem("Opened", 1);
		document.getElementById("nextButton").style.display = "none";
		var div = document.createElement("div");
		var header = document.createElement("h3");
		var par = document.createElement("p");
		var link = document.createElement("a");
		link.setAttribute("class", "extlink");
		link.setAttribute("href", "http://www.a-hoj.pl/zalew-sulejowski-czarter/mapa-zal-2/");
		link.setAttribute("target", "_blank");

		header.innerHTML = "Zalew Sulejowski";
		par.innerHTML = "Ma wiele cech takich samych jak Jezioro Zegrzyńskie. Popularny za sprawą bliskości Łodzi, sztuczny zbiornik na rzece Pilica, który został otwarty w 1974 roku.";
		link.innerHTML = "Mapa Zalewu Sulejowskiego";

		div.appendChild(header);
		div.appendChild(par);
		div.appendChild(link);
		var pos = document.getElementById("next");
		pos.appendChild(div);
}


$(document).ready(function(){
	$("#toggle").click(function(){
        $("#toggleHidden").slideToggle("slow");
    });
	$("#filter").on("keyup", function() {
		var value = $(this).val().toLowerCase();
		$("#tofilter tr td:nth-child(1)").filter(function() {
	    	$(this).parent().toggle($(this).text().toLowerCase().indexOf(value) > -1)
	    });
	});
});


$( function() {
    $( "#slider" ).slider({
	    value:30,
	    min: 0,
		max: 110,
		step: 10,
		slide: function( event, ui ) {
		    $( "#ageval" ).val(ui.value + "-" + (ui.value+9));
		}
		});
		});
$( function() {
    var tooltips = $( "[title]" ).tooltip({
	    position: {
		    my: "left top",
		    at: "right+5 top-5",
		    collision: "none"
	    }
	});
    $( "#help" ).on( "click", function() {
        tooltips.tooltip( "open" );
      })
});
$( function() {
    function runEffect() {
    	var selectedEffect = "drop";
			var options = {};      
			$( "#effect" ).hide( selectedEffect, options, 1000, callback);
		};

	function callback() {
	    setTimeout(function() {
		    $( "#effect" ).removeAttr( "style" ).hide().fadeIn();
		}, 1000 );
	};
			 
	$( "#reset" ).click(function() {
		$("#slider").slider("value", 30);
	    runEffect();    
	});
});