
google.load("jquery", "1.4");
google.setOnLoadCallback(function()
{      
   $("#SearchForm_SearchForm_Search").attr("autocomplete", "off"); 
	 $("#SearchForm_SearchForm_Search").blur(
	   function() {                
	     var v =   $("#SearchForm_SearchForm_Search").val();
	     $("#SearchForm_SearchForm_Search").val((v=="")?"Search":v);
	     $('#search_results').fadeOut(); 
	     index = 0;
 	   });
	 $("#SearchForm_SearchForm_Search").focus(
	   function() {       
	     var v =   $("#SearchForm_SearchForm_Search").val();
	     if(v !="Search")
	     {
	       showResults() ;
	     } 
	     else
	     {
	        $("#SearchForm_SearchForm_Search").val("");  
	     } 
	   });                                      
	 $("#SearchForm_SearchForm_Search").keyup(lookup);    
	 $("#SearchForm_SearchForm").submit(  
	    function() {
        var a = $('#search_results li.active a'); 
        if((a.length + index)>1)
        {
            window.location = a.attr("href"); 
            return false; 
        }           
	      return true;
	    } );
	    

	    
	    
	  jsonGallery();  
	     
});
  
  function jsonGallery()
  {   
      //$(".lightwindow").fancybox({ 'zoomSpeedIn': 300, 'zoomSpeedOut': 300, 'overlayShow': false }); 
      $(".pagination a.Next, .pagination a.Prev").click(
          function()
          {                
              $(this).parents(".box:first").load($(this).attr("href"), "", jsonGallery);
              return false;
          } );
  }
  
  
  function showResults()
  {
      $('#search_results').fadeIn(); 
  }      
  
          
    function moveSelection(key)
    { 
      var a = $('#search_results li.active');
      if(a.length )
      {    var all = $('#search_results li'); 
           a.removeClass("active");     
           var inc = (key == 38)?-1:1;  
     
           index = (index+inc) % all.length;
           $(all.get(index)).addClass("active"); 
      } 
      else if($('#search_results li').length)
      {    
        index = 0;
        $('#search_results li:first').addClass("active"); 
      }     

      
    }              
        
  
  var index = 0;
  function lookup(key) 
  { 
      if(key.which == 38 || key.which == 40)
      {      
          moveSelection(key.which);
          return false;
      } 
      index = 0;    
      var inputString = this.value;
    	if(inputString.length < 3) {
    		$('#search_results').fadeOut(); // Hide the suggestions box
    	} else {    

    		$.post($("#SearchForm_SearchForm").attr("action"),{Search:inputString,action_ajaxResults: "Search"}, function(data) { // Do an AJAX call
    			showResults();  // Show the suggestions box
    			$('#search_results').html(data); // Fill the suggestions box
    		});
    	} 
	              
	
	
  }     