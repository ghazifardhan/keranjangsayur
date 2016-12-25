<h1>Create New Customer</h1>
<form id='create_customer' action='javascript://' method='POST' border='0'>
        <table class='table table-hover table-responsive table-bordered'>
            <tr>
                <td>Customer Name</td>
                <td><input type="text" name="customerName" class='form-control'></td>
            </tr>
            <tr>
                <td>Customer Type</td>
                <td><select class="form-control" name="customerType">
                    <option value="0">Regular</option>
                    <option value="1">Restaurant</option>
                </td>
            </tr>
            <tr>
                <td>Description</td>
                <td><input type="text" name="description" class='form-control'></td>
            </tr>
            <tr>
                <td></td>
                <td><button type="submit" name="submit" class='btn btn-primary'><span class='glyphicon glyphicon-plus'></span> Submit</button></td>
            </tr>       
        </table>    
    </form>