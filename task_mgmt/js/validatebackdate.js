
var now = new Date();
var nowString = now.getFullYear() + "-" +
                ("0" + (now.getMonth() + 1)).slice(-2) + "-" +
                ("0" + now.getDate()).slice(-2) + "T" +
                ("0" + now.getHours()).slice(-2) + ":" +
                ("0" + now.getMinutes()).slice(-2);
document.getElementById("datePicker").min = nowString;

// fetched the max date 
var maxDateElement = document.getElementById("max_date");
// $maxdate containing the max date
var max = maxDateElement.innerText; 

var maxDate = new Date(max);
var maxString = maxDate.getFullYear() + "-" +
                ("0" + (maxDate.getMonth() + 1)).slice(-2) + "-" +
                ("0" + maxDate.getDate()).slice(-2) + "T" +
                ("0" + maxDate.getHours()).slice(-2) + ":" +
                ("0" + maxDate.getMinutes()).slice(-2);
document.getElementById("datePicker").max = maxString;

// Get the date picker input element
var datePicker = document.getElementById("datePicker");

// Add event listener to disable dates before the min date and after the max date
datePicker.addEventListener("input", function() {
    var selectedDate = new Date(this.value);
    var minDate = new Date(this.min);
    var maxDate = new Date(this.max);

    var allDates = document.querySelectorAll("input[type='date']")[0];
    allDates.setAttribute('min', this.min);
    allDates.setAttribute('max', this.max);

    if (selectedDate < minDate || selectedDate > maxDate) {
        this.value = ''; 
    }
});
