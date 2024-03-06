<script>
        function reloadDiv() {
            // Fetching updated time
            var currentDate = new Date();
            var hours = currentDate.getHours();
            var minutes = currentDate.getMinutes();
            var seconds = currentDate.getSeconds();
            var ampm = hours >= 12 ? 'PM' : 'AM';

            //12-hour format
            hours = hours % 12;
            hours = hours ? hours : 12; 
            var formattedTime = hours + ':' + (minutes < 10 ? '0' : '') + minutes + ':' + (seconds < 10 ? '0' : '') + seconds + ' ' + ampm;
            var updatedDate = new Date().toLocaleDateString();
            document.getElementById('timeupdate').innerHTML = "Current Date:    " + updatedDate + " <br><br>Current Time:    " + formattedTime;
        }
        setInterval(reloadDiv, 1000);    // 1-second reload
    </script>