$(document).ready(function(){
   
	
   //按鈕測試
   $("#search_btn").click(function(){
      count++;
      alert('a');
   });


   //及時搜尋
   var that = $(this);
   var mSearch = $("#m-search");
   $("#search-input").bind("keyup", function(){
     var value = $(this).val();
     if (!value) {
       mSearch.html("");
       return;
     }; 
     mSearch.html('.wrap:not([data-index*="' + value.toLowerCase() + '"]) {display: none;}');
 
   });

   //set ajax csrf token
   $.ajaxSetup({
     headers:{
	'X-CSRF-Token':$('meta[name="csrf-token"]').attr('content')
     }
   });

   //post new message
   function post_new_message(){
      $.ajax({
	 type:"POST",
	 url:"post_new_message",
  	 async:true,
	 dataType:"json",
  	 timeout:10000,
	 success:function(data){
	    console.log(data);
	 },
	 error:function(data){
	    console.log(data);
	 }
      });
   }
   
    
 
});

