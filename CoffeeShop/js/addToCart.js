// --------------------- Add To Cart --------------------------
//            All add to cart actions are here

$(document).ready(function(){
  var pid, pname, pimage, pprice, pqty ;


  // when we click on add to cart button --> showing the toppings modal
  $(".addItemToCart").click(function() {

    //reset all previous selected checkboxes when we click on another item
    $('.checkitem').prop('checked',false);

    // when we click on addItemToCart button, we get the specific id of this button
    pid = $(this).attr("id");

    // after knowing the id, we get the items info having this id   
     pname = $("#name_" + pid ).text();
     pimage = $("#image_" + pid).attr("src");
     pprice = $("#price_" + pid).text();
     pqty = $("#quantity_" + pid).text();
    

    if($("#wishlist_section").val() == "wishlist")
        pqty = $("#quantity_"+pid).val();


     currency = $('#currency_list').val();

    // we put the values in the toppings modal
    $('#ITEM_NAME').text(pname+" - "+pprice+currency);
    $('#ITEM_QUANTITY').text("Quantity: "+pqty);
    $('#ITEM_IMAGE').attr("src",pimage);

    // we show the modal
    $('#addToCart_modal').modal('show');

  });



  // when we click on button close --> hide the modal
  $('#btn-close').click(function(){
    $('#addToCart_modal').modal('hide');
  });


  // when we click on the second addToCart button --> we put toppings data inside a session
  $('#btn-addToCart').click(function(){
    var toppings = [];
   
    // get the selcted toppings and store them inside an array
    $('.checkitem:checked').each(function(){
      toppings.push($(this).val());
    });

    // we hide the modal after submitting
    $('#addToCart_modal').modal('hide');


    // send data to PHP server script (Add_To_Cart.php) using Ajax request.
    $.ajax({
      url: './requests/Add_To_Cart.php',
      method: 'post',
      data: { pid: pid, pname: pname, pimage: pimage, pprice: pprice, pqty: pqty, toppings: toppings, action: "add"},
      success: function() {

        Swal.fire({
          position: 'top-end',
          icon: 'success',
          title: pqty+" "+pname+" added to cart successfully!",
          showConfirmButton: false,
          timer: 2000
        });

      }
    });

  });


  //  when we click on the delete button
  $('.delete').click(function(){
    var product_id = $(this).attr("id");

    Swal.fire({
      title: 'Are you sure you want to remove this item from Cart?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes'
    }).then((result) => {
          if (result.isConfirmed) {

            Swal.fire({
              position: 'top-end',
              icon: 'success',
              title: 'Item is removed from Cart!',
              showConfirmButton: false,
              timer: 2000
            });

            $.ajax({
              url: './requests/Add_To_Cart.php',
              method: 'post',
              data: { product_id:product_id , action: 'remove'},
              success: function() {

                //reload page
                location.reload(true)
              }
            });

          }
      });
  });


  //  when we click on the clear button
  $('.clear').click(function(){
    var action="clear";

    Swal.fire({
      title: 'Are you sure?',
      text: "All items in Cart will be removed",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes'
    }).then((result) => {
            if (result.isConfirmed) {

              Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Cart Cleared',
                showConfirmButton: false,
                timer: 2000
              });

              $.ajax({
                url: './requests/Add_To_Cart.php',
                method: 'post',
                data: { action: action},
                success: function() {

                  //reload page
                  location.reload(true)
                }
              });

            }
      });

    });

});