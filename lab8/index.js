import websysData from './websys.json' assert {type: 'json'};

let websysCourse = websysData;

let websysLectures = websysCourse.Lectures;

let websysLabs = websysCourse.Labs;

let tabDisplay = document.getElementById("tab-display")

let lecList = document.getElementById("lec-dropdown");

let labList = document.getElementById("lab-dropdown");


// display lecture items
for (let i = 0; i < websysLectures.length; i++) {

    let lecNum = i + 1;

    let listHTML = '';

    let tabHTML = '';

    listHTML += '<li class="wb-nav-item" role="presentation"><button class="nav-link" id=lecture-';
    listHTML += i + ' data-bs-toggle="tab" data-bs-target="#lecture-';
    listHTML += i + '-tab" type="button" aria-controls="lecture-';
    listHTML += i + '-tab" aria-selected="false" role="tab">Lecture ';
    listHTML += lecNum + '</li >';
    lecList.innerHTML += listHTML;

    tabHTML += '<div class="tab-pane fade" id="lecture-' + i + '-tab" role="tabpanel" aria-labelledby="lecture-' + i + '" tabindex="0">';
    tabHTML += '<h2 class="title-text">' + websysLectures[i].Title + '</h2>';
    tabHTML += '<p class= "body-text">' + websysLectures[i].Description + '</p>';
    tabHTML += '<button id="lecture' + i + '" class="btn btn-success px-4 mb-4 post-btn">Archive Content </button>';
    websysLectures[i].Slides.forEach(link => {
        tabHTML += '<iframe src="' + link + '"></iframe>';
    });
    tabHTML += "</div>";

    tabDisplay.innerHTML += tabHTML;
};

// display lab items
for (let i = 0; i < websysLabs.length; i++) {

    let labNum = i + 1;

    let listHTML = '';

    let tabHTML = '';

    listHTML += '<li class="wb-nav-item" role="presentation"><button class="nav-link" id=lab-';
    listHTML += i + ' data-bs-toggle="tab" data-bs-target="#lab-';
    listHTML += i + '-tab" type="button" aria-controls="lab-';
    listHTML += i + '-tab" aria-selected="false" role="tab">Lab ';
    listHTML += labNum + '</li >';
    labList.innerHTML += listHTML;

    tabHTML += '<div class="tab-pane fade" id="lab-' + i + '-tab" role="tabpanel" aria-labelledby="lab-' + i + '" tabindex="0">';
    tabHTML += '<h2 class="title-text">' + websysLabs[i].Title + '</h2>';
    tabHTML += '<p class= "body-text">' + websysLabs[i].Description + '</p>';
    tabHTML += '<button id="lab' + i + '" class="btn btn-success px-4 mb-4 post-btn">Archive Content </button>';
    tabHTML += '<iframe src="' + websysLabs[i].Instructions + '"></iframe>';
    tabHTML += "</div>";

    tabDisplay.innerHTML += tabHTML;
};

document.getElementById("lec-display").addEventListener("click", function () {
    if (lecList.className == "hide") {
        lecList.className = "show";
    } else {
        lecList.className = "hide";
    }
    if (labList.className == "show") {
        labList.className = "hide";
    }
}
);

document.getElementById("lab-display").addEventListener("click", function () {
    if (labList.className == "hide") {
        labList.className = "show";
    } else {
        labList.className = "hide";
    }
    if (lecList.className == "show") {
        lecList.className = "hide";
    }
});


let btns = document.getElementsByClassName("post-btn");


for (let i = 0; i < btns.length; i++) {
    btns[i].addEventListener("click", function () {
        let newid;
        let jsonData;
        if (btns[i].id.includes("lab")) {
            newid = parseInt(btns[i].id.replace('lab', ''));
            jsonData = websysCourse.Labs[newid];
        } else {
            newid = parseInt(btns[i].id.replace('lecture', ''));
            jsonData = websysCourse.Lectures[newid];
        }
        fetch("./archive.php", {
            method: "POST",
            credentials: "same-origin",
            mode: "same-origin",
            body: JSON.stringify(jsonData),
            headers: {
                "Content-Type": "application/json"
            },
            success: function (data) {
                alert(data);
            }
        }
        )
        alert("Content Archived");
    })
};