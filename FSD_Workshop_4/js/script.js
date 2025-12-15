document.getElementById("register-form").addEventListener("submit", function (e) {
    e.preventDefault();

    ["nameError", "emailError", "passwordError", "confirmError", "Success"]
        .forEach(id => document.getElementById(id).innerText = "");

    const formData = {
        name:document.querySelector("[name='name']").value.trim(),
        email:document.querySelector("[name='email']").value.trim(),
        password:document.querySelector("[name='password']").value,
        password2:document.querySelector("[name='password2']").value
    };

    fetch("php/registration.php", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(formData)
    })
    .then(res => res.json())
    .then(data => {
        if (data.errors) {
            Object.keys(data.errors).forEach(key => {
                const elementId = key==="confirm" ? "confirmError" : key + "Error";
                const element = document.getElementById(elementId);
                if (element) {
                    element.innerText = data.errors[key];
                    console.log(`${key} error: ${data.errors[key]}`);
                }
            });
        } else if (data.success) {
            document.getElementById("Success").innerText = data.success;
            console.log("Success:", data.success);
        }
    })
    .catch(err => {
        console.error("AJAX Error:", err);
        document.getElementById("Success").innerText = "Server Error";
    });
});
