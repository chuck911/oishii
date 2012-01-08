$.facebox.settings.closeImage = themeBase+'/css/closelabel.png';
$.facebox.settings.loadingImage = themeBase+'/css/loading.gif';
$(document).ready(function(){
	$('.scroll-pane').jScrollPane();
	
	$('#tag-filter').keyup(function(){
		var searchString = $(this).val();
		if(!searchString){
			$('#tag-list li').css('display','block');
		}else{
			$('#tag-list li').each(function(i){
				if($(this).find('a').text().indexOf(searchString)==-1){
					$(this).css('display','none');
				}else{
					$(this).css('display','block');
				}
			});
		}
	});
	
	(function(){
		var activedByClick = false;
		function toggleAddBookmarkForms(e){
			if(e.type=="click"){
				if(activedByClick){
					hideAddBookmarkForms();
					activedByClick = false;
				}else{
					showAddBookmarkForms();
					activedByClick = true;
				}
			}else if(!activedByClick){
				if(e.type=="mouseleave"){
					hideAddBookmarkForms();
				}else{
					showAddBookmarkForms();
				}
			}
			return false;
		}
		function showAddBookmarkForms(){
			$('#new-bookmark').addClass('active');
			$('#new-bookmark-forms').css('display','block');
		}
		function hideAddBookmarkForms(){
			$('#new-bookmark').removeClass('active');
			$('#new-bookmark-forms').css('display','none');
		}
		$('#new-bookmark').hover(toggleAddBookmarkForms);
		$('#new-bookmark').click(toggleAddBookmarkForms);
		$('#add-bookmark-url').submit(function(){
			hideAddBookmarkForms();
			jQuery.facebox({ajax:$(this).attr('action')+'?'+$(this).serialize()});
			return false;
		});
	})();
	
});