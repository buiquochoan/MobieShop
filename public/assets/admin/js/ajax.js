$.ajaxSetup({
	headers: {
		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	}
});
$(document).ready(function() {
	// body...
	$('.edit').click(function() {
		// body... 
		let id = $(this).data('id');
		$('.divMessage').html("");
		$.ajax({
			url:'admin/category/'+id+'/edit',
			dataType:'json',
			type:'get',
			success:function(data) {
				// body...
				$('.name').val(data.name);
				$('.status').val(data.status);
				$('.title').html(data.name);
				$('.idCategory').val(id);
			}
		});
	});
	$('.btnSua').click(function() {
		// body... 
		let name = $('.name').val();
		let status = $('.status').val();
		let id = $('.idCategory').val();
		$.ajax({
			url:'admin/category/'+id,
			dataType:'json',
			data:{
				name:name,
				status:status
			},
			type:'put',
			success:function(data) {
				if(data.error == 'false'){
					$('.divMessage ').html(data.message);
					setTimeout(function(){
						window.location.reload(); 
					}, 1000);
				}else{
					$('.divMessage').html(data.message.name[0]);
				}
			}
		});
	});
	$('.btnDelete').click(function(){
		let id = $(this).data('id');
		$('.idCategory').val(id);
	});
	$('.btnYes').click(function(){
		$('.divMessageDelete').html("");
		let id = $('.idCategory').val();
		$.ajax({
			url:'admin/category/'+id,
			dataType:'json',
			type:'delete',
			success:function(data){
				$('.divMessageDelete').html(data.message);
				setTimeout(function(){
					window.location.reload(); 
				}, 1000);
			},
		});
	});
	//
	$('.editProductType').click(function() {
		// body... 
		let id = $(this).data('id');
		$('.divMessage').html("");
		$.ajax({
			url:'admin/productType/'+id+'/edit',
			dataType:'json',
			type:'get',
			success:function(data) {
				// body...
				$('.name').val(data.producttype.name);
				$('.status').val(data.producttype.status);
				$('.title').html(data.producttype.name);
				$.each(data.category, function (i, item) {
					$('.idCategory').append($('<option>', { 
						value: item.id,
						text : item.name 
					}));
				});
				$('.idCategory').val(data.producttype.idCategory);
				$('.inputIdProductType').val(id);
			}
		});
	});
	$('.btnSuaProductType').click(function() {
		// body... 
		let name = $('.name').val();
		let status = $('.status').val();
		let id = $('.inputIdProductType').val();
		let idCategory = $('.idCategory').val();
		$.ajax({
			url:'admin/productType/'+id,
			dataType:'json',
			data:{
				name:name,
				status:status,
				idCategory:idCategory
			},
			type:'put',
			success:function(data) {
				if(data.error == 'false'){
					$('.divMessage ').html(data.message);
					setTimeout(function(){
						window.location.reload(); 
					}, 1000);
				}else{
					$('.divMessage').html(data.message.name[0]);
				}
			}
		});
	});

	$('.btnDeleteProductType').click(function(){
		let id = $(this).data('id');
		$('.inputIdProductType').val(id);
	});
	$('.btnYesProductType').click(function(){
		$('.divMessageDelete').html("");
		let id = $('.inputIdProductType').val();
		$.ajax({
			url:'admin/productType/'+id,
			dataType:'json',
			type:'delete',
			success:function(data){
				$('.divMessageDelete').html(data.message);
				setTimeout(function(){
					window.location.reload(); 
				}, 1000);
			},
		});
	});


	$('.editProduct').click(function(){
		let id = $(this).data('id');
		$.ajax({
			url:'/admin/product/'+id+'/edit',
			dataType:'json',
			success:function(data){
				$('.name').val(data.product.name);
				$('.description').val(data.product.description);
				$('.quantity').val(data.product.quantity);
				$('.price').val(data.product.price);
				$('.promotional').val(data.product.promotional);
				$.each(data.category, function (i, item) {
					$('.idCategory').append($('<option>', { 
						value: item.id,
						text : item.name 
					}));
				});
				$.each(data.producttype, function (i, item) {
					$('.idProductType').append($('<option>', { 
						value: item.id,
						text : item.name 
					}));
				});
				$('.idCategory').val(data.product.idCategory);
				$('.idProductType').val(data.product.idProductType);
			}
		});
	});
});