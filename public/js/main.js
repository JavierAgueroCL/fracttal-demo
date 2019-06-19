$(document).ready(function() {
	$(".obtener").on('click', function(e){
		jQuery.ajax({
			type: "GET",
			url: 'http://www.railstack.cl/fracttal-demo/public/obtener_datos',
			beforeSend: function(){
				$(".obtener-content").html("<center>Cargando...</center>");
			},
			success: function(response) {
				$(".obtener-content").html(response);
			},
			error: function(jqXHR, textStatus, errorThrown) {
				$(".obtener-content").html("<center>Error...</center>");
			}
		});
	})

	$(".modificar").on('click', function(e){
		jQuery.ajax({
			type: "GET",
			url: 'http://www.railstack.cl/fracttal-demo/public/obtener_datos',
			beforeSend: function(){
				$(".modificar-content").html("<center>Cargando...</center>");
			},
			success: function(response) {
				$(".modificar-content").html(response);
			},
			error: function(jqXHR, textStatus, errorThrown) {
				$(".modificar-content").html("<center>Error...</center>");
			}
		});
	})

});
