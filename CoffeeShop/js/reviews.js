// --------------------- Reviews --------------------------

$(document).ready(function(){

    var rating_data = 0;
  
    //when we click on add_review button --> show pop up model
    $('#add_review').click(function(){      
        $('#review_modal').modal('show');
    });
  
  
    //when we move cursor on star icon --> color change to yellow
    $(document).on('mouseenter', '.submit_star', function(){
  
        // Get the data-rating attribute of the selected star
        var rating = $(this).data('rating');  
  
        //change the color of stars from yellow to gray if i have already rated and i want to change it
        reset_background();
  
        //change background color into yellow from first star to the selected one
        for(var count = 1; count <= rating; count++)
            $('#submit_star_'+count).addClass('text-warning');  
    });

  
    //change the color of stars from yellow to gray
    function reset_background(){       
        for(var count = 1; count <= 5; count++){
            $('#submit_star_'+count).addClass('star-light');   
            $('#submit_star_'+count).removeClass('text-warning');
        }
    }
  
  
    // when i choose a rate save it inside a variable
    $(document).on('click', '.submit_star', function(){
        rating_data = $(this).data('rating');     
    });
  
    
    
    $(document).on('mouseleave', '.submit_star', function(){
  
        //change the color of all stars from yellow to gray
        reset_background();
  
        //change color of the chosen stars to yellow 
        // if we leave without choosing a rate so rating_data=0
        for(var count = 1; count <= rating_data; count++){
            $('#submit_star_'+count).removeClass('star-light');
            $('#submit_star_'+count).addClass('text-warning'); 
        }
    });
  
  
    //we have used Ajax request, so when user click on submit button after filliing the review fields and rating 
    //review data will be sent to PHP server script using Ajax request.

    $('#save_review').click(function(){
  
        var user_name = $('#user_name').val();
  
        var user_review = $('#user_review').val();
  
        // check if fields not empty
        if(user_name == '' || user_review == '')
        {
              Swal.fire({
                position: 'center',
                icon: 'error',
                title: "Please Fill Both Fields",
                showConfirmButton: false,
                timer: 2000
              });
          
            return false;
        }
        else if(rating_data ==0){  // check if user doesn't rate
            Swal.fire({
                position: 'center',
                icon: 'error',
                title: "Please Rate",
                showConfirmButton: false,
                timer: 2000
              });
            return false;
        }
        else
        {
            // send data to PHP server script (submit_rating.php) using Ajax request.
            $.ajax({
                url:"./requests/submit_rating.php",
                method:"POST",
                data:{rating_data:rating_data, user_name:user_name, user_review:user_review,action:"submit_rating"},
                success:function(data)
                {
                    //hide modal from web page
                    $('#review_modal').modal('hide');  

                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: data,
                        showConfirmButton: false,
                        timer: 2000
                      });

                    //reset values from modal
                    $('#user_name').val('');
                    $('#user_review').val('');
                    reset_background();

                    //update the reviews after submission
                    load_rating_data();    
                }
            })
        }
    });



    $('#cancel_review').click(function(){
        $('#review_modal').modal('hide');
    });
  

    //update the reviews when opening the page
    load_rating_data();
  
    function load_rating_data()
        {
            // send data to PHP server script (submit_rating.php) using Ajax request.
            $.ajax({
                url:"./requests/submit_rating.php",
                method:"POST",
                data:{action:'load_data'},
                dataType:'JSON',            // receive data in JSON format
                success:function(data)
                {   
                    // fill the average and total reviews number
                    $('#average_rating').text(data.average_rating);
                    $('#total_review').text(data.total_review);
  
                    var count_star = 0;
  
                    // average nb of stars -> change background to yellow 
                    $('.main_star').each(function(){
                        count_star++;
                        if(Math.floor(data.average_rating) >= count_star)
                        {
                            $(this).addClass('text-warning');
                            $(this).addClass('star-light');
                        }
                    });

  
                    // fill reviews number for each rate
                    $('#total_five_star_review').text(data.five_star_review);
  
                    $('#total_four_star_review').text(data.four_star_review);
    
                    $('#total_three_star_review').text(data.three_star_review);
    
                    $('#total_two_star_review').text(data.two_star_review);
    
                    $('#total_one_star_review').text(data.one_star_review);

                    
                    // fill the progress bars
                    $('#five_star_progress').css('width', (data.five_star_review/data.total_review) * 100 + '%');
    
                    $('#four_star_progress').css('width', (data.four_star_review/data.total_review) * 100 + '%');
    
                    $('#three_star_progress').css('width', (data.three_star_review/data.total_review) * 100 + '%');
    
                    $('#two_star_progress').css('width', (data.two_star_review/data.total_review) * 100 + '%');
    
                    $('#one_star_progress').css('width', (data.one_star_review/data.total_review) * 100 + '%');


                    // list the reviews
                    if(data.review_data.length > 0){
                    var html = '';
             
                    for(var count = 0; count < data.review_data.length; count++)
                    {
                       
                    html += '<div class="swiper-slide slide" >';
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

                    $('#reviews_swiper').html(html);    
            }}
        }
        });            
        }
});