<?php
include '../dbconnect/dbconnect.php';
?>
<?php
// Fetch member list from the database
$sql = "SELECT id, fullname FROM user";
$result = $conn->query($sql);

// Check if there are members in the database
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $team_members[] = $row;
    }
}
?>
<form method="POST" action="process_form.php">
    <label for="team_member">Select Member:</label>
    <select name="team_member" id="member">
        <?php
        // Populate dropdown with member names
        foreach ($team_members as $user) {
            echo "<option value=\"{$user['id']}\">{$user['fullname']}</option>";
        }
        ?>
    </select>
    <br>
    <label for="new_member">Enter New Member:</label>
    <input type="text" name="new_member" id="new_member">
    <br>
    <input type="submit" value="Add Member" name="Submit">
</form>
<?php
if (isset($_POST['Submit'])) {
    // Retrieve selected member ID and new member name from the form
    $selectedMemberID = $_POST['team_member'];
    $newMemberName = $_POST['new_member'];

    // Perform the necessary SQL query to add the new member to the team
    // (you should customize this based on your database structure)
    $sql = "INSERT INTO team_formation (team_id, member_id) VALUES (1, $selectedMemberID)";

    if ($conn->query($sql) === TRUE) {
        echo "Member added successfully.";
    } else {
        echo "Error adding member: " . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>

