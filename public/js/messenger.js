$(document).ready(function(){

   var username;
   var messages;
   var formdata;//在polling的時候，送出給server檢查的資料，也就是此時本地端的留言數

   //set ajax csrf token
   $.ajaxSetup({
      headers:{
         'X-CSRF-Token':$('meta[name="csrf-token"]').attr('content')
      }
   });  

   //取得使用者名稱
   $.ajax({
      type:"POST",
      url:"get_name",
      async:true,
      dataType:"json",
      timeout:100000,
      success:function(data){
	username=data;
	//alert(username.messages[4].message);
	//alert(username.username);
      },
      complete:function(data){
	console.log(data);
   	formdata=username;

	poll();
      }
   });

   var message=$("#add_message_text").val();     

   $("#add_message").click(function(){
      var message=$('#add_message_text').val();

      var formdata ={
	 message:message
      };

      $("#add_message_text").val('');

      $.ajax({
         type:"POST",
         url:"test_polling",
	 async:true,
	 data:formdata,
	 dataType:"json",
         timeout:100000,
	 success:function(data){
	    console.log(data);
	 },
	 error:function(data){
 	   console.log(data);
	 }
      });
      //$('#message_board_2').append("<pre class='messages'>"+username.username+"："+message+"</pre>");
      //test delete dom
      //$('.messages').remove();

      //scroll the top to the buttom
      $scrollHeight=$('#message_board_2')[0].scrollHeight;
      console.log($('#message_board_2')[0].scrollHeight);
      $('#message_board_2').animate({scrollTop:$scrollHeight},200);
   });


   refresh_scrollbar();//剛進入頁面時的刷新

   //polling 的時候，要傳送自己的狀態，讓資料庫檢查有無差異
   function poll(){

      $.ajax({
         type:"POST",
         url:"poll",
         async:true,
	 data:formdata, 
         dataType:"json",
         timeout:1000000,  //   x/1000=seconds
         success:function(data){
	    console.log(data);
	    console.log("suc",data.username);
	    formdata=data;

	    //刷新留言板
	    //刪除舊資料
	    //$('.messages').remove();
	    formdata.new_messages.forEach(function(item,index){
		$('#message_board_2').append("<pre class'messages'>"+item.username+"："+item.message+"</pre>");
	    });
	    refresh_scrollbar();
	    //刷新留言板//   
	   
         },
         complete:function(data){
	    //messages=data;
	    //console.log(messages);
	    //console.log("please",data.username);
	    poll();
	 }
      });
  }
  function refresh_scrollbar(){
  	 //scroll the top to the buttom
  	 $scrollHeight=$('#message_board_2')[0].scrollHeight;
	 console.log($scrollHeight);
	 $('#message_board_2').animate({scrollTop:$scrollHeight},200);
  }
});
