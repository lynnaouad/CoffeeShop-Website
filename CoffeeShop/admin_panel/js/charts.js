$(document).ready(function(){
    month_string = $("#hidden-stats").val();
    month_array = month_string.split('-');

    year = $("#hidden-year").val();

const ctx = document.getElementById('myChart');

const myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
        datasets: [{
            label: 'nb of reviews ('+year+')',
            data: month_array,
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(107, 192, 87, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(0, 29, 255, 0.2)',
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(107, 192, 87, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(0, 29, 255, 0.2)'
              
                
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(107, 192, 87, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(0, 29, 255, 1)',
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(107, 192, 87, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(0, 29, 255, 1)'
     
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

// **********************************************************************************************

star_string = $("#hidden-stars").val();
star_array = star_string.split('-');

const ctx2 = document.getElementById('myChart2');

const myChart2 = new Chart(ctx2, {
    type: 'pie',
    data: {
        labels: ['1 star', '2 stars', '3 stars', '4 stars', '5 stars'],
        datasets: [{
            data: star_array,
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(107, 192, 87, 0.2)',
                'rgba(153, 102, 255, 0.2)'  
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(107, 192, 87, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(0, 29, 255, 1)',
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(107, 192, 87, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(0, 29, 255, 1)'
     
            ],
            borderWidth: 1
        }]
    },

});

// **********************************************************************************************

star_average = $("#hidden-average").val();
average_array = star_average.split('-');

const ctx3 = document.getElementById('myChart3');

const myChart3 = new Chart(ctx3, {
    type: 'line',
   
    data: {
           
         labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
        datasets: [{
            label: 'average rating ('+year+')',  
            data: average_array,
            borderWidth: 1,
            pointBackgroundColor: ['rgba(153, 102, 255, 1)'],
            borderColor: ['rgba(255, 99, 132, 1)']
        }]
    },

});


// **********************************************************************************************






});

