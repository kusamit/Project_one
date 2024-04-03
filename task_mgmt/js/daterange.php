<?php
// Fetch the created date and deadline date from the database (example)
$createdDate = $valid_deadline;
// echo $createdDate;
$deadlineDate = $valid_created;
// $valid_deadline = $row['deadline'];
//     $valid_created=$row['created_date'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Select Date Range</title>
    <script>
        window.onload = function() {
            // var startDatePicker = document.getElementById("startDatePicker");
            // var endDatePicker = document.getElementById("endDatePicker");

            // Set created date and deadline date from PHP
            var createdDate = "<?php echo $createdDate; ?>";
            var deadlineDate = "<?php echo $deadlineDate; ?>";

            // Set minimum date for start date picker
            startDatePicker.setAttribute("min", createdDate);
            startDatePicker.setAttribute("max", deadlineDate);

            // Set minimum date for end date picker
            startDatePicker.addEventListener("change", function() {
                endDatePicker.setAttribute("min", this.value);
                endDatePicker.setAttribute("max", deadlineDate);
            });

            // Set maximum date for end date picker
            endDatePicker.addEventListener("change", function() {
                startDatePicker.setAttribute("max", this.value);
            });
        };
    </script>
</head>
<!-- <body>
    <label for="startDatePicker">Start Date:</label>
    <input type="date" id="startDatePicker" name="startDatePicker">

    <label for="endDatePicker">End Date:</label>
    <input type="date" id="endDatePicker" name="endDatePicker">
</body> -->
</html>
