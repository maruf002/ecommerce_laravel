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

//ajax for change category status
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
//ajax for change bannerstatus

$(document).ready(function(){
   //main code start from 2nd line
   $('body').on('change','#bannerstatus',function(){
       var id =$(this).attr('data-id');
      if(this.checked){
         var status =1;
        
      }else{
         var status=0;
      }
     $.ajax({
         url: 'update-banner-status/'+id+'/'+status,
         method:'get',//main part
         //for showing action in debug console
         success: function(result){ 
            console.log(result);
         }
      
     });
   
     });
   
   });


         //Add Remove Fields Dynamically
   $(document).ready(function(){
      var maxField = 10; //Input fields increment limitation
      var addButton = $('.add_button'); //Add button selector
      var wrapper = $('.field_wrapper'); //Input field wrapper
      var fieldHTML = '<div style="display:flex;"><input type="text" name="sku[]" id="sku" placeholder="SKU" class="form-control"style="width: 120px;margin-right:5px;"><input type="text" name="size[]" id="size" placeholder="SIZE" class="form-control" style="width: 120px;margin-right:5px;"> <input type="text" name="price[]" id="price" placeholder="PRICE" class="form-control" style="width: 120px;margin-right:5px;"><input type="text" name="stock[]" id="stock" placeholder="STOCK" class="form-control"style="width: 120px;margin-right:5px;"><a href="javascript:void(0);" class="remove_button">Remove</a></div>'; //New input field html 
      var x = 1; //Initial field counter is 1
      
      //Once add button is clicked
      $(addButton).click(function(){
          //Check maximum number of input fields
          if(x < maxField){ 
              x++; //Increment field counter
              $(wrapper).append(fieldHTML); //Add field html
          }
      });
      
      //Once remove button is clicked
      $(wrapper).on('click', '.remove_button', function(e){
          e.preventDefault();
          $(this).parent('div').remove(); //Remove field html
          x--; //Decrement field counter
      });
  });

   