// send an email
function sendEmail() {
    const formInput = document.getElementById("contact-form").elements;
    let nameInput = formInput[0].value;
    let emailInput = formInput[1].value;
    let phoneInput = formInput[2].value;
    let messageInput = formInput[3].value;

    let emailBody = "Name: " + nameInput + "%0A" + "Email: " + emailInput + "%0A" + "Phone Number: " + phoneInput + "%0A" + "Message:%0A" + messageInput;

    for (let i = 0; i < emailBody.length; i++) {
        if (emailBody[i] == " ") {
            emailBody[i] = "%20";
        }
    }

    window.location.href = "mailto:rpi.lab3.burner@outlook.com?subject=ITWS%20Form&body=" + emailBody;

    alert("Form Submitted")
    // Email.send({
    //     Host: "in-v3.mailjet.com",
    //     Username: "6eeecfd65e64bac98e270c1c3d12e9a3",
    //     Password: "cd1c88b5a110c178de753a0f169b6a08",
    //     To: 'rpi.lab3.burner@outlook.com',
    //     From: "rpi.lab3.burner@outlook.com",
    //     Subject: "ITWS Inqury from " + nameInput,
    //     Body: emailBody
    // }).then(
    //     message => alert(message)
    // );

}

// Change nav bar based on scroll
window.onscroll = function () { navChange() };
function navChange() {
    var rpiLogo = document.getElementById("ITWS-logo");
    if(screen.width < 700){
        rpiLogo.src = "Resources/RPI-logo-black.png";
        rpiLogo.style.height = "3rem";
        return;
    }
    if (document.body.scrollTop > 0 || document.documentElement.scrollTop > 0) {
        rpiLogo.src = "Resources/RPI-logo-black.png";
        rpiLogo.style.height = "2rem";
    } else {
        rpiLogo.src = "Resources/RPI-ITWS-logo-black-howelc.svg";
        rpiLogo.style.height = "5rem";
    }
}