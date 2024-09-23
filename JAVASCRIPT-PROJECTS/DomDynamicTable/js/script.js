var dom = document.getElementById("myDom");

var btn = document.getElementById("myBtn");

var span = document.getElementsByClassName("close")[0];

btn.onclick = function () {
    dom.style.display = "block";
    isValid = true;
}

span.onclick = function () {
    dom.style.display = "none";
}

window.onclick = function (event) {
    if (event.target == dom) {
        dom.style.display = "none";
    }
}

var selectedRow = null

function onFormSubmit() {
    
    

    if (validate()) {
        var formData = readFormData();
        if (selectedRow == null)
            insertNewRecord(formData);
        else
            updateRecord(formData);
        resetForm();
    }

    
}

function readFormData() {
    var formData = {};
    formData["fullName"] = document.getElementById("fullName").value;
    formData["addr"] = document.getElementById("addr").value;
    formData["number"] = document.getElementById("number").value;
    formData["email"] = document.getElementById("email").value;
    formData["Status"] = document.querySelector('input[name="Status"]:checked').value;
    return formData;
}

function insertNewRecord(data) {
    var table = document.getElementById("employeeList").getElementsByTagName('tbody')[0];
    var newRow = table.insertRow(table.length);
    cell1 = newRow.insertCell(0);
    cell1.innerHTML = data.fullName;
    cell2 = newRow.insertCell(1);
    cell2.innerHTML = data.addr;
    cell3 = newRow.insertCell(2);
    cell3.innerHTML = data.number;
    cell4 = newRow.insertCell(3);
    cell4.innerHTML = data.email;
    cell5 = newRow.insertCell(4);
    cell5.innerHTML = data.Status;
    cell6 = newRow.insertCell(5);
    cell6.innerHTML = `<a onClick="onEdit(this)" id="edit" value="edit" class="button button1">Edit</a>
                        <a onClick="onDelete(this)" id="dlt" value="dlt" class="button button2">Delete</a>;`
}

function resetForm() {
    document.getElementById("fullName").value = "";
    document.getElementById("addr").value = "";
    document.getElementById("number").value = "";
    document.getElementById("email").value = "";
    document.getElementsByClassName("Status").value = "";
    selectedRow = null;
}


function onEdit(td) {
    dom.style.display = "block";
    isValid = true;
    selectedRow = td.parentElement.parentElement;
    document.getElementById("fullName").value = selectedRow.cells[0].innerHTML;
    document.getElementById("addr").value = selectedRow.cells[1].innerHTML;
    document.getElementById("number").value = selectedRow.cells[2].innerHTML;
    document.getElementById("email").value = selectedRow.cells[3].innerHTML;
    document.getElementsByClassName("Status").value = selectedRow.cells[4].innerHTML;
}

function updateRecord(formData) {
    selectedRow.cells[0].innerHTML = formData.fullName;
    selectedRow.cells[1].innerHTML = formData.addr;
    selectedRow.cells[2].innerHTML = formData.number;
    selectedRow.cells[3].innerHTML = formData.email;
    selectedRow.cells[4].innerHTML = formData.Status;
}

function onDelete(td) {
    if (confirm('Are you sure to delete this record ?')) {
        row = td.parentElement.parentElement;
        document.getElementById("employeeList").deleteRow(row.rowIndex);
        resetForm();
    }
}

function validate() {
    isValid = true;
    if (document.getElementById("fullName").value == "") {
        isValid = false;
        document.getElementById("fullNameValidationError").classList.remove("hide");
    } else {
        isValid = true;
        if (!document.getElementById("fullNameValidationError").classList.contains("hide"))
            document.getElementById("fullNameValidationError").classList.add("hide");
    }
    return isValid;
}