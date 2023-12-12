$(document).ready(function(){
		
	$('.delete').on('click', function(event){
		event.preventDefault();
		$('.show').css("opacity", 0);
		var postId = $(this).attr("id");	
		$.ajax({
			url:"../admin/manage_posts.php",
			method:"POST",
			data:{
				action: 'postDelete',
				postId: postId
			},
			dataType:'JSON',
			success:function(response){
				$('table').find('tbody').html(response.data);
				$('.count_post').text(response.count);
			}
		})
	});	
});