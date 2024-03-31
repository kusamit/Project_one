// Get the current date and time
var now = new Date();

// Convert it to a string compatible with datetime-local input format
var nowString = now.getFullYear() + "-" +
                ("0" + (now.getMonth() + 1)).slice(-2) + "-" +
                ("0" + now.getDate()).slice(-2) + "T" +
                ("0" + now.getHours()).slice(-2) + ":" +
                ("0" + now.getMinutes()).slice(-2);

// Set the minimum attribute of the input field to the current date and time
document.getElementById("datePicker").min = nowString;