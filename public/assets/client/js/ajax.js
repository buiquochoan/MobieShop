$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$(document).ready(function () {
	// body...
	$('.cartQty').blur(function(){
		var value = $(this).val() * 1;
		var id = $(this).data('id');
		if(value < 0 || value === 0){
			Swal.fire({
				position: 'top-end',
				icon: 'error',
				title: 'Vui lòng nhập số lượng lớn hơn không',
				showConfirmButton: false,
				timer: 1500
			})
		}else{
			$.ajax({
				url:'cart/'+id,
				type:'put',
				dataType:'json',
				data:{qty:value},
				success:function(data){
					Swal.fire({
						position: 'top-end',
						icon: 'success',
						title: data.result,
						showConfirmButton: false,
						timer: 1500
					});
					window.setTimeout(function(){
						window.location.reload();
					},1000);
				}
			});
		}
	});

	$('.btnDeleteCart').click(function(){
		var id = $(this).data('id');
		Swal.fire({
			title: 'Xóa sản phẩm trong giỏ hàng?',
			text: "",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Yes'
		}).then((result) => {
			if (result.value) {
				$.ajax({
					url:'cart/'+id,
					dataType:'json',
					type:'delete',
					success:function(data){
						console.log(data);
						Swal.fire({
							position: 'top-end',
							icon: 'success',
							title: data.message,
							showConfirmButton: false,
							timer: 1500
						});
						window.setTimeout(function(){
							window.location.reload();
						},1000);
					}	
				})
			}
		})
	});

	$('.errorEmail').html("").hide();
	$('.errorPhone').html("").hide();
	$('.errorAddress').html("").hide();
	$('.btnAddAddress').click(function(){
		var active = '';
		if($('.cbActive').prop('checked')){
			active = 'on';
		}else{
			active = 'off';
		}
		$.ajax({
			url:'customer',
			dataType:'json',
			data:{
				email : $('.email').val(),
				phone : $('.phone').val(),
				address : $('.address').val(),
				active : active,
			},
			type:'post',
			success:function(data){
				$('.modalAddress').modal('hide');
				Swal.fire({
					position: 'top-end',
					icon: 'success',
					title: data,
					showConfirmButton: false,
					timer: 1500
				});
				setTimeout(function(){
					window.location.reload();
				},1000);
			},
			error:function(data){
				console.log(data);
				console.log(typeof data.responseJSON.errors.email);
				if(typeof data.responseJSON.errors.email != 'undefined'){
					$('.errorEmail').html(data.responseJSON.errors.email[0]).show();
				}else{
					$('.errorEmail').html("").hide();
				}
				if(typeof data.responseJSON.errors.phone != 'undefined'){
					$('.errorPhone').html(data.responseJSON.errors.phone[0]).show();
				}else{
					$('.errorPhone').html("").hide();
				}
				if(typeof data.responseJSON.errors.address != 'undefined'){
					$('.errorAddress').html(data.responseJSON.errors.address[0]).show();
				}else{
					$('.errorAddress').html("").hide();
				}
			}
		})
	});


	$('.btnPayment').click(function(){
		var idCustomer = $('input[name=rdoaddress]:checked').val();
		var txtGhiChuThanhToan = $('.txtGhiChuThanhToan').val();
		var txtTotalMoney = $('.txtTotalMoney').val();
		if(idCustomer == undefined || idCustomer == ''){
			Swal.fire({
				position: 'top-end',
				icon: 'error',
				title: 'Vui lòng chọn địa chỉ giao hàng',
				showConfirmButton: false,
				timer: 1500
			});
			return;
		}
		$.ajax({
			url:'cart',
			dataType:'json',
			type:'post',
			data:{
				idCustomer:idCustomer,
				txtGhiChuThanhToan:txtGhiChuThanhToan,
				txtTotalMoney:txtTotalMoney
			},
			success:function(data){
				Swal.fire({
				position: 'top-end',
				icon: 'success',
				title: data,
				showConfirmButton: false,
				timer: 1500
			});
				location.href = '/';
			}

		});
	});
});