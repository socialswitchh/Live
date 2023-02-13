$(document).ready(function(){
// Add Anonymous Type //	
	$('.anonymous_type_add').click(function(){  
		var action="addAnonymousType"; 
		var name = $('#name').val(); 
      //	alert(name);
		$.ajax({
			url:"./dynamic/custom_anonymous.php",
			type:"POST",
			data:'action='+action+'&name='+name,
			success: function(data){
				alert(data);
				window.setTimeout(function(){location.assign("anonymous_type.php")}, 2000);
			}
		});  
	});
 
// Get Anonymous Type //	
	$('.get_data').click(function(){ 
		var action="getAnonymousType"; 
		var id = $(this).attr("data-id"); 
		$.ajax({
			url:"./dynamic/custom_anonymous.php",
			type:"POST",
			data:'action='+action+'&id='+id,
			dataType: "json", 
			success: function(data){ 
				console.log(data);
				$(".id").val(data.id);
				$(".name").val(data.name);
			}
		});   
	});
	
// Edit Anonymous Type //	
	$('.anonymous_type_edit').click(function(){ 
		var action="editAnonymousType"; 
		var id = $('#id').val(); 
		var name = $('.name').val();   
		$.ajax({
			url:"./dynamic/custom_anonymous.php",
			type:"POST",
			data:'action='+action+'&name='+name+'&id='+id,
			success: function(data){
				alert(data);
				window.setTimeout(function(){location.assign("anonymous_type.php")}, 2000);
			}
		});  
	});	
	
// Add Anonymous //	
	$('.anonymous_add').click(function(){ 
		var action="addAnonymous"; 
		var anonymous_type = $('#anonymous_type').val(); 
		var anonymous_name = $('#anonymous_name').val();
		$.ajax({
			url:"./dynamic/custom_anonymous.php",
			type:"POST",
			data:'action='+action+'&anonymous_type='+anonymous_type+'&anonymous_name='+anonymous_name,
			success: function(data){
				alert(data);
				window.setTimeout(function(){location.assign("anonymous.php")}, 2000);
			}
		});  
	});
	
// Get Anonymous //	
	$('.get_data_anonymous').click(function(){ 
		var action="getAnonymous"; 
		var id = $(this).attr("data-id"); 
		$.ajax({
			url:"./dynamic/custom_anonymous.php",
			type:"POST",
			data:'action='+action+'&id='+id,
			dataType: "json", 
			success: function(data){ 
				console.log(data);
				$(".id").val(data.id);
				$(".anonymous_type").val(data.anonymous_type_id);
				$(".anonymous_name").val(data.anonymous_name);
			}
		});   
	});
	
// Edit Anonymous //	
	$('.anonymous_edit').click(function(){ 
		var action="editAnonymous"; 
		var id = $('.id').val(); 
		var anonymous_type = $('.anonymous_type').val(); 
		var anonymous_name = $('.anonymous_name').val();
		$.ajax({
			url:"./dynamic/custom_anonymous.php",
			type:"POST",
			data:'action='+action+'&anonymous_type='+anonymous_type+'&anonymous_name='+anonymous_name+'&id='+id,
			success: function(data){
				alert(data);
				window.setTimeout(function(){location.assign("anonymous.php")}, 2000);
			}
		});  
	}); 

 
	// Add Badges //	
	$('.add_badges').click(function(){  
		var action="addBadges"; 
		var image = $('#image').val(); 
		var title = $('#title').val();
		$.ajax({
			url:"./dynamic/custom_badges.php",
			type:"POST",
			data:'action='+action+'&image='+image+'&title='+title,
			success: function(data){
				alert(data);
				window.setTimeout(function(){location.assign("badges.php")}, 2000);
			}
		});  
	});
	
// Get Badges //	
	$('.get_data_badges').click(function(){ 
		var action="getBadges"; 
		var id = $(this).attr("data-id"); 
		$.ajax({
			url:"./dynamic/custom_badges.php",
			type:"POST",
			data:'action='+action+'&id='+id,
			dataType: "json", 
			success: function(data){ 
				console.log(data);
				$(".id").val(data.id); 
				$(".title").val(data.title);
			}
		});   
	});
	
// Edit Badges //	
	$('.edit_badges').click(function(){ 
		var action="editBadges"; 
		var id = $('.id').val(); 
		var image = $('.image').val(); 
		var title = $('.title').val();
		$.ajax({
			url:"./dynamic/custom_badges.php",
			type:"POST",
			data:'action='+action+'&image='+image+'&title='+title+'&id='+id,
			success: function(data){
				alert(data);
				window.setTimeout(function(){location.assign("badges.php")}, 2000);
			}
		});  
	}); 
// Multiple Image Upload //
	$('#files').change(function(){ 
	  var files = $('#files')[0].files; 
	  var error = '';
	  var form_data = new FormData(); 
	  var action = 'imageUpload';
		form_data.append('action', action); 	  
		for(var count = 0; count<files.length; count++)
			{  
				var name = files[count].name;  
				var extension = name.split('.').pop().toLowerCase();  
				if(jQuery.inArray(extension, ['gif','png','jpg','jpeg']) == -1){
					error += "Invalid " + count + " Image File" 
				} else {  
					form_data.append('files[]', files[count]);  
				} 
		    }
			if(error == ''){
			    $.ajax({
				url:"./dynamic/custom_tours.php?action=" + action,
				method:"POST",
				data:form_data,
				contentType:false,
				cache:false,
				processData:false,
				beforeSend:function()
				{
					$('#uploaded_images').html("<label class='text-success'>Uploading...</label>");
				},
				success:function(data)
				{  
					$('#uploaded_images').html(data); 
				}
			   });
			} else {
			   alert(error);
			}
		});
// Image Remove //		
	$(document).on('click','.content span',function(){
		var action="imageRemove"; 
		var current = $(this);
		var id = this.id; 
		var split_id = id.split("_");  
		var imgElement_src  = $('#img_'+split_id[1]).attr("src");
		var imageFullPath = imgElement_src.split("tours_images/");
		var imagePath = imageFullPath[1];
		$.ajax({
			url:"./dynamic/custom_tours.php",
			method:"POST",
			data:{action:action,imagePath:imagePath},
			success: function(data){ 
				current.parent().remove();
			}
		});
	});
	 
});







/*   if (window.File && window.FileList && window.FileReader) {
    $("#files").on("change", function(e) {
      var files = e.target.files,
        filesLength = files.length;
	 // var form_data = new FormData();
      for (var i = 0; i < filesLength; i++) {
        var f = files[i];
        var fileReader = new FileReader(); 
        fileReader.onload = (function(e) { 
          var file = e.target; 
		  //alert(file.result);
          $("<span class=\"pip\">" +
            "<img class=\"imageThumb\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" +
            "<br/><span class=\"remove\">Remove image</span>" +
            "</span>").insertAfter("#files");
          $(".remove").click(function(){
            $(this).parent(".pip").remove();
          });
        });
        fileReader.readAsDataURL(f); 
      } 
    });
  } else {
    alert("Your browser doesn't support to File API")
  } */
