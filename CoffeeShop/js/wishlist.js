$(document).ready(function(){

    $(".AddWishlist").click(function() {
        var pid, pname, pimage, pprice;

        // when we click on addItemToCart button, we get the specific id of this button
        pid = $(this).attr("id");

        // after knowing the id, we get the items info having this id   
        pname = $("#name_" + pid ).text();
        pimage = $("#image_" + pid).attr("src");
        pprice = $("#price_" + pid).text();

        // send data to PHP server script (add_wishlist.php) using Ajax request.
        $.ajax({
            url: './requests/add_wishlist.php',
            method: 'post',
            data: { pid: pid, pname: pname, pimage: pimage, pprice: pprice, action: "add wishlist"},
            success: function(data) {
      
              Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: data,
                showConfirmButton: false,
                timer: 2000
              });

            }
          });
    });

    //remove item from wishlist
    $(".fa-times").click(function() { 
        pid = $(this).attr("id");

        Swal.fire({
            title: 'Are you sure you want to remove this item from Wishlist?',
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
                title: 'Item is removed from Wishlist!',
                showConfirmButton: false,
                timer: 2000
              });

              // send data to PHP server script (add_wishlist.php) using Ajax request.
              $.ajax({
                url: './requests/add_wishlist.php',
                method: 'post',
                data: { product_id:pid , action: 'remove wishlist'},
                success: function() {
      
                  //reload page
                  location.reload(true)
                }
              });
      
              }
            });

    });

});