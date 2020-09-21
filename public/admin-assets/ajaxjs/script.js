//ajax for change productstatus
$(document).ready(function(){
//main code start from 2nd line
$('body').on('change','#productstatus',function(){
    var id =$(this).attr('data-id');
   if(this.checked){
      var status =1;
     
   }else{
      var status=0;
   }
  $.ajax({
      url: 'update-product-status/'+id+'/'+status,
      method:'get',//main part
      //for showing action in debug console
      success: function(result){ 
         console.log(result);
      }
   

  });

  });

});

//ajax for change productstatus
$(document).ready(function(){
   //main code start from 2nd line
   $('body').on('change','#catstatus',function(){
       var id =$(this).attr('data-id');
      if(this.checked){
         var status =1;
        
      }else{
         var status=0;
      }
     $.ajax({
         url: 'update-category-status/'+id+'/'+status,
         method:'get',//main part
         //for showing action in debug console
         success: function(result){ 
            console.log(result);
         }
      
     });
   
     });
   
   });