function changeCategory(){
	var idCategory = $('.idCategory').val();
	$.ajax({
		url:'admin/ajaxProductTypeController/'+idCategory,
		dataType:'json',
		success:function(data){
			$('.idProductType').empty();
			$.each(data, function (i, item) {
				$('.idProductType').append($('<option>', { 
					value: item.id,
					text : item.name 
				}));
			});
		}
	});
}