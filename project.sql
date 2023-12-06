//creating database sql
$sql="CREATE DATABASE project_management_system";
$result=mysqli_query($con,$sql);
if($result)
{
    echo "Database Created Sucessfully..!!";
}
else
{
    echo "Error to Create Database";
}