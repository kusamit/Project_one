<script>

    function getValueAsync(selector) {
        return new Promise(resolve => {
            var element = document.querySelector(selector);
            resolve(element ? element.value : '');
        });
    }
        
    async function updateStatus(rowId, status) {
        try{
            var progress = await getValueAsync("#row_" + rowId + " #progress_select");
            var remarks = await getValueAsync("#row_" + rowId + " .remarks");

            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    var response = xhr.responseText;
                    console.log(response);            
                }
            } 
            xhr.open('POST', "update_status.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            
            if(status === "progress"){
                xhr.send("rowId=" + rowId + "&status=" + status+"&progress="+progress);
            }
            else{
                xhr.send("rowId=" + rowId + "&status=" + status+"&remarks=" + remarks);
            }
        }
        catch (error) {
            console.error("An error occurred:", error);
        }
        
    }

    </script> 