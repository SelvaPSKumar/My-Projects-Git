<style>
    .dbresult, .dbresult td, .dbresult th {
        border: 1px solid black;
        border-collapse: collapse;
        padding: 8px;
    }

    .dbresult {
        width: 800px;
        margin: auto;
    }

    .dbresult tr:nth-child(odd) {
        background-color: #b2d0d6;
    }

    .dbresult tr:nth-child(even) {
        background-color: lightcyan;
    }
</style>

<Form action="test.php" method="get">
    <table class="dbresult">
        <thead>
            <tr>
                <th colspan="2">Register</th>
            </tr>
            <tr>
                <th colspan="2"><a href="test.php">View Record</a></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Name</td>
                <td><input type="text" name="name1" required=""></td>
            </tr>
            <tr>
                <td>Mobile</td>
                <td><input type="text" name="mobile" required=""></td>
            </tr>
            <tr>
                <td>Age</td>
                <td><input type="number" name="age" required=""></td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: center;"><input type="submit" name="submitvalue" value="Save"></td>
            </tr>
        </tbody>
    </table>
</form>