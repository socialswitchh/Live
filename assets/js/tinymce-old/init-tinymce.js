// Post editor
function startEditor(id) {
tinymce.init({
	selector: "textarea#"+id,
	plugins: 'image code | link | paste | emoticons | media | mediauploader',
    toolbar: 'link image | emoticons | media | mediauploader', 
    contextmenu: true,
    toolbar_location: 'bottom',
    menubar:false,
    branding: false, 
  	image_title: true, 
  	automatic_uploads: true,
  	relative_urls : true,
	  paste_preprocess: function(plugin, args) {
	    args.content += ' ';
	  },  
  	file_picker_types: 'image', 
  	file_picker_callback: function (cb, value, meta) {
    var input = document.createElement('input');
    input.setAttribute('type', 'file');
    input.setAttribute('accept', 'image/*'); 
    input.onchange = function () {
      var file = this.files[0];

      var reader = new FileReader();
      reader.onload = function () { 
        var id = 'blobid' + (new Date()).getTime();
        var blobCache =  tinymce.activeEditor.editorUpload.blobCache;
        var base64 = reader.result.split(',')[1];
        var blobInfo = blobCache.create(id, file, base64);
        blobCache.add(blobInfo); 
        cb(blobInfo.blobUri(), { title: file.name });
      };
      reader.readAsDataURL(file);
    }; 
    input.click();
  }, 

  audio_template_callback: function(data) {
   return '<audio controls>' + '\n<source src="' + data.source + '"' + (data.sourcemime ? ' type="' + data.sourcemime + '"' : '') + ' />\n' + (data.altsource ? '<source src="' + data.altsource + '"' + (data.altsourcemime ? ' type="' + data.altsourcemime + '"' : '') + ' />\n' : '') + '</audio>';
 },
   
   
});
}

// Diary editor
tinymce.init({
  selector:'textarea#diary_editor',
  plugins: 'image code | link | paste | emoticons | media | mediauploader',
    toolbar: 'link image | emoticons | media | mediauploader', 
    contextmenu: true,
    toolbar_location: 'bottom',
    menubar:false,
    branding: false, 
    image_title: true, 
    automatic_uploads: true,
    relative_urls : true,
    paste_preprocess: function(plugin, args) {
      args.content += ' ';
    },  
    file_picker_types: 'image', 
    file_picker_callback: function (cb, value, meta) {
    var input = document.createElement('input');
    input.setAttribute('type', 'file');
    input.setAttribute('accept', 'image/*'); 
    input.onchange = function () {
      var file = this.files[0];

      var reader = new FileReader();
      reader.onload = function () { 
        var id = 'blobid' + (new Date()).getTime();
        var blobCache =  tinymce.activeEditor.editorUpload.blobCache;
        var base64 = reader.result.split(',')[1];
        var blobInfo = blobCache.create(id, file, base64);
        blobCache.add(blobInfo); 
        cb(blobInfo.blobUri(), { title: file.name });
      };
      reader.readAsDataURL(file);
    }; 
    input.click();
  }, 

  audio_template_callback: function(data) {
   return '<audio controls>' + '\n<source src="' + data.source + '"' + (data.sourcemime ? ' type="' + data.sourcemime + '"' : '') + ' />\n' + (data.altsource ? '<source src="' + data.altsource + '"' + (data.altsourcemime ? ' type="' + data.altsourcemime + '"' : '') + ' />\n' : '') + '</audio>';
 },
   
   
});


$( document ).ready(function() {
  startEditor('message'); 
  $(document).on('submit','#posts', function(event){
    var formData = $(this).serialize();
    $.ajax({
                url: "action.php",
                method: "POST",              
                data: formData,
        dataType:"json",
        beforeSend: function() { 
                  $("#post_where").modal("show"); 
              },
                success: function(data) {     
          var html = $("#postHtml").html();         
          html = html.replace(/USERNAME/g, data.user);
          html = html.replace(/POSTDATE/g, data.post_date);
          html = html.replace(/POSTMESSAGE/g, data.message);
          html = html.replace(/POSTID/g, data.id);
          $("#postLsit").append(html).fadeIn('slow');
          tinymce.get('message').setContent('');
                }
        });   
    return false;
  });
  
  
  $('#postLsit').on('click','[id^=edit_]', function(event){ 
    var messageId = $(this).attr('id');
    var header = $(this).attr('header-id');
    //alert(header);
    messageId = messageId.replace(/edit_/g, '');
    messageId = parseInt(messageId);
    tinymce.execCommand("mceRemoveEditor", true, messageId);
    startEditor(messageId);   
    tinymce.get(messageId).setContent($("#post_message_"+messageId).html());
    $("#editSection_"+messageId).removeClass('hidden'); 
    $("#button_section_"+messageId).addClass('hidden');   
  });
  
  $('#postLsit').on('click','[id^=cancel_]', function(event){
    var messageId = $(this).attr('id');
    var header = $(this).attr('header-id');
    messageId = messageId.replace(/cancel_/g, '');
    tinymce.execCommand("mceRemoveEditor", true, messageId);
    $("#editSection_"+messageId).addClass('hidden');
    $("#button_section_"+messageId).removeClass('hidden');    
  });
  
  $('#postLsit').on('click','[id^=save_]', function(event){
    var messageId = $(this).attr('id');
    var header = $(this).attr('header-id');

    messageId = messageId.replace(/save_/g, '');
    messageId = parseInt(messageId);  
    var postMessage = tinymce.get(messageId).getContent();  
    tinymce.execCommand("mceRemoveEditor", true, messageId);          
    var action = 'update';
    $.ajax({
      url:'action.php',
      method:"POST",
      data:{id:messageId, header: header, message:postMessage, action:action},
      dataType:"json",
      success:function(data){ 
        var html = $("#postHtml").html();         
        html = html.replace(/HEADER/g, data.title);
        html = html.replace(/POSTDATE/g, data.created_at);
        html = html.replace(/POSTMESSAGE/g, data.description);
        html = html.replace(/POSTID/g, data.id);
        $("#postRow_"+messageId).html(html);        
        $("#editSection_"+messageId).addClass('hidden');
        $("#button_section_"+messageId).removeClass('hidden');          
      }
    });   
  });
  
});