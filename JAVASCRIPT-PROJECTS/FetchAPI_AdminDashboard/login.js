
// Targetting all classes & id from HTML

let id = (id) => document.getElementById(id);

let classes = (classes) => document.getElementsByClassName(classes);

let email = id("email"),
    password = id("password"),
    form = id("form"),
    errorMsg = classes("error"),
    successIcon = classes("success-icon"),
    failureIcon = classes("failure-icon");

// Adding the submit event Listener

form.addEventListener("submit", (e) => {
    e.preventDefault();

    engine(email, 1, "Email cannot be blank");
    engine(password, 2, "Password cannot be blank");
});

// engine function which will do all the works

let engine = (id, serial, message) => {
    if (id.value.trim() === "") {
        errorMsg[serial].innerHTML = message;
        id.style.border = "2px solid red";

        // icons
        failureIcon[serial].style.opacity = "1";
        successIcon[serial].style.opacity = "0";
    } else {
        errorMsg[serial].innerHTML = "";
        id.style.border = "2px solid green";

        // icons
        failureIcon[serial].style.opacity = "0";
        successIcon[serial].style.opacity = "1";
    }
};

// Login Auth

function fetchAuth() {
    const user = {
        "email": document.getElementById("email").value,
        "password": document.getElementById("password").value
    }
    console.log('user : ', user)
    let options = {
        method: 'POST',
        headers: {
            'Content-Type':
                'application/json;charset=utf-8'
        },
        body: JSON.stringify(user)
    }

    let fetchRes = fetch(
        "https://salixv3qa.radiusdirect.net/coreapi/clientAdminLogin",
        options);
    fetchRes.then(res =>
        res.json()).then(response => {
            console.log('Response : ', response)
            if (response && response.apiStatus) {
                localStorage.setItem("token", response.token);
                location.href = "dash.html";
            } else {
                alert(response.result)
                document.getElementById("email").value = ''
                document.getElementById("password").value = ''
            }
        })
};