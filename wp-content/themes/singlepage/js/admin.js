jQuery(document).ready(function($){
	
	$(".groupTitle").click(function(){
		var group = $(this).parents(".toggle_option_group");
		if(group.hasClass("group_close")){
		group.removeClass("group_close").addClass("group_open");
		$(this).addClass("open");
		}else{
		group.removeClass("group_open").addClass("group_close");
		$(this).removeClass("open");
			}
 });
	
/* ------------------------------------------------------------------------ */
/*  Sort section             	  								  	    */
/* ------------------------------------------------------------------------ */
	sectionSort = function() {
		var i = 0;
	 $('.home-section').each(function(){
			$(this).find("[name^='singlepage']").each(function(){
				var name = $(this).attr('name');
				var id   = $(this).attr('id');
				var new_name = name.replace(/[0-9]+/, i);
				var new_id   = id.replace(/[0-9]+/, i);
				$(this).attr('name',new_name);
				$(this).attr('id',new_id);
               });
			i++;
	   });
	  $('#section_num').val(i);

		}

/* ------------------------------------------------------------------------ */
/*  delete section             	  								  	    */
/* ------------------------------------------------------------------------ */
 $('#optionsframework').on('click','.delete-section',function(){
	$(this).parents('.home-section').remove();	
	sectionSort();
	
  });
 
/* ------------------------------------------------------------------------ */
/*  sort home sections      	  								  	    */
/* ------------------------------------------------------------------------ */

 $( "#home-sections" ).sortable({
    stop: function(){
       sectionSort();
    }			   
 });
	
	});