/*Activates the Tabs*/
function tabSwitch(new_tab, new_content) {  
      
    document.getElementById('content_1').style.display = 'none';  
    document.getElementById('content_2').style.display = 'none';  
  
    document.getElementById(new_content).style.display = 'block';     
    document.getElementById('tab_1').className = '';  
    document.getElementById('tab_2').className = '';  
         
    document.getElementById(new_tab).className = 'active';        
 } 

 $(document).ready(function () {
     var average = 0;

    // reviews - get all reviews of a specific rate
    $('.submit_star').on('click', function () { 
        var dataRating = $(this).data('rating');
        
        $.ajax({
            url:"../requests/get_reviews.php",
            method:"POST",
            data:{dataRating:dataRating , action:'rate'},
            dataType:'JSON',           
            success:function(data)
            {
                 $('#NAME').text(data.total_review+" reviews");    

                 average = data.average_rating;

                 // list the reviews
                 if(data.review_data.length > 0){
                    var html = '';
             
                    for(var count = 0; count < data.review_data.length; count++)
                    {
                       
                    html += '<div class="slide" >';
                    html += '<i class="fas fa-quote-right"></i>';
                    html += '<div class="user">'
                    html += '<div class="col-sm-2"><div class="rounded-circle pt-2 pb-2"><h2 class="text-center">'+data.review_data[count].user_name.charAt(0)+'</h2></div></div>';

                    html += '<div class="user-info">';
                    html += '<h3>'+data.review_data[count].user_name+'</h3>';
                    html += '<div class="stars">';

                    for(var star = 1; star <= 5; star++)
                    {
                        var class_name = '';

                        if(data.review_data[count].rating >= star)
                            class_name = 'text-warning';
                        else
                            class_name = 'star-light2';
                        

                        html += '<i class="fas fa-star '+class_name+' mr-1"></i>';
                    }

                    html += '</div>';
                    html += '<h4>'+data.review_data[count].datetime+'</h4>'; 
                    html += '</div></div>';

                    html += '<p>'+data.review_data[count].user_review+'</p>';
                    html += '</div>';

                    $('.review').html(html);    
            }}

            }

        });
        
        
        $('#add_modal').modal('show');

    });


    // shop status
    $('.status').on('click', function () {

        $.ajax({
            url:"../requests/get_reviews.php",
            method:"POST",
            data:{action:'get_avg'},         
            success:function(avg){

                $('#add_modal2').modal('show');

                if(avg < 2){
                    $('.status_elm').text("The average rating is: "+avg+"/5");

                    $('.status_elm2').text("Shop status is BAD");
                    $('.status_elm2').addClass('BAD');
                }
                else if(avg > 2 && avg < 3){
                    $('.status_elm').text("The average rating is: "+avg+"/5");

                    $('.status_elm2').text("Shop status is GOOD");
                    $('.status_elm2').addClass('GOOD');
                }
                else if(avg > 3){
                    $('.status_elm').text("The average rating is: "+avg+"/5");

                    $('.status_elm2').text("Shop status is EXCELLENT");
                    $('.status_elm2').addClass('EXCELLENT');
                }

            }
        });

     });


    $("#cancel").click(function() {

        $('#add_modal').modal('hide');
  
      });

    $("#cancel2").click(function() {

        $('#add_modal2').modal('hide');
  
      });
    
}); 





