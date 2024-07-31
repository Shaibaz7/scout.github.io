$(document).ready(function() {
            // Function to format the current date
            function getCurrentDate() {
                var now = new Date();
                var dayOfWeek = now.toLocaleString('en-us', { weekday: 'short' }); // Get short day name (e.g., Mon)
                var month = now.toLocaleString('en-us', { month: 'short' }); // Get short month name (e.g., Jan)
                var day = now.getDate(); // Get day of the month
                var year = now.getFullYear(); // Get full year
                
                var currentDate = dayOfWeek + ', ' + month + ' ' + day + ', ' + year;
                return currentDate;
            }
            
            // Set the static text
            var staticText = 'Mon - Fri : 09.00 AM - 09.00 PM';
            
            // Update the HTML content with current date and static text
            $('#currentDateTime').html('<small>' + getCurrentDate());
        });		

$(document).ready(function() {
    // Collapse the navbar on item click
    $('#navbarCollapse .nav-link').on('click', function() {
        $('#navbarCollapse').collapse('hide');
    });
});
$(document).ready(function() {
// Attach a submit event handler to the form
$('.booking_form').click(function(event) {
event.preventDefault(); // Prevent the form from submitting normally

// Get the values from the form
let name = $("input[name='name']").val();

let email = $("input[name='email']").val();
let subject = $("input[name='subject']").val();
let message = $("#message").val();
let booking_form = "booking_form";

// Check if all values are not null
if (name && email && subject && message) {
  // Create an object with the form data
  let formData = {
    name: name,
    email: email,
    subject: subject,
    message: message,
    booking_form:booking_form
  };

  // Use AJAX to send the data to the server
  $.ajax({
    type: 'POST',
    url: 'contact.php',
    data: formData,
    success: function(response) {
      // Handle the successful response
      console.log(response);
      console.log('Email sent successfully!');
      $("#contact_form_response").html("<span class='text-primary'>Email sent successfully!</span>");
      $("#booking-mail")[0].reset();
    },
    error: function(xhr, status, error) {
      // Handle the error response
      console.log(status,error);
      $("#contact_form_response").html("<span class='text-danger'>Error sending email "+error+"</span>");
      console.error('Error sending email: ' + error);
    }
  });
} else {
  // Display an error message if any of the values are null
  $("#contact_form_response").html("<span class='text-danger'>Please fill all fields</span>");
}
});

$('.request_form').click(function(event) {
event.preventDefault(); // Prevent the form from submitting normally

// Get the values from the form
let name = $("input[name='re_name']").val();

let email = $("input[name='re_email']").val();
let subject = $("input[name='re_brand']").val();
let message = $("#yourrequest").val();
let request_form = "request_form";

// Check if all values are not null
if (name && email && subject && message) {
  // Create an object with the form data
  let formData = {
    name: name,
    email: email,
    brand: subject,
    request: message,
    request_form:request_form
  };

  // Use AJAX to send the data to the server
  $.ajax({
    type: 'POST',
    url: 'contact.php',
    data: formData,
    success: function(response) {
      // Handle the successful response
      console.log(response);
      console.log('Email sent successfully!');
      $("#re_form_response").html("<span class='text-white'>Email sent successfully!</span>");
      $("#re_form")[0].reset();
    },
    error: function(xhr, status, error) {
      // Handle the error response
      console.log(status,error);
      $("#re_form_response").html("<span class='text-warning'>Error sending email "+error+"</span>");
      console.error('Error sending email: ' + error);
    }
  });
} else {
  // Display an error message if any of the values are null
  $("#re_form_response").html("<span class='text-warning'>Please fill all fields</span>");
}
});
});

function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition, showError);
    } else {
        document.getElementById("userLocation").innerHTML = "Geolocation is not supported by this browser.";
    }
}

function showPosition(position) {
    var lat = position.coords.latitude;
    var lon = position.coords.longitude;
    fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lon}`)
        .then(response => response.json())
        .then(data => {
            var fullAddress = data.display_name;
            var addressParts = fullAddress.split(',').map(part => part.trim());
            // Extract the parts you need: area, city, state, country, pincode
            var relevantParts = addressParts.slice(-6); // Adjust based on your specific address structure
            document.getElementById("userLocation").innerHTML = relevantParts.join(', ');
        })
        .catch(error => {
            document.getElementById("userLocation").innerHTML = "Unable to retrieve location.";
            console.error('Error:', error);
        });
}

function showError(error) {
    switch(error.code) {
        case error.PERMISSION_DENIED:
            document.getElementById("userLocation").innerHTML = "User denied the request for Geolocation.";
            break;
        case error.POSITION_UNAVAILABLE:
            document.getElementById("userLocation").innerHTML = "Location information is unavailable.";
            break;
        case error.TIMEOUT:
            document.getElementById("userLocation").innerHTML = "The request to get user location timed out.";
            break;
        case error.UNKNOWN_ERROR:
            document.getElementById("userLocation").innerHTML = "An unknown error occurred.";
            break;
    }
}

// Call the function to get the location when the page loads
document.addEventListener("DOMContentLoaded", getLocation);
