let textarea = document.getElementById("body");

//Return the selected text positions as an array.
function getSelections(element) {
    let textarea = document.getElementById(element);
    let start = textarea.selectionStart;
    let finish = textarea.selectionEnd;

    return [start, finish];
}

//Wrap the selected text between 2 tags.
function wrap(tagOne, tagTwo) {
    let selections = getSelections("body");
    let start = selections[0];
    let after = selections[1];

    let text = textarea.value;

    let beforeText = text.slice(0, start);
    let selection = text.slice(start, after)
    let afterText = text.slice(after, text.length);

    textarea.value = beforeText + tagOne + selection + tagTwo + afterText;
}

function insertImageTag(imgUrl) {
    let selections = getSelections("body");
    let start = selections[0];
    let after = selections[1];

    let text = textarea.value;

    let beforeText = text.slice(0, start);
    let afterText = text.slice(after, text.length);

    let imgTag =  '<img src="' + imgUrl + '" alt="Describe Image" width="300" height="200">';

    textarea.value = beforeText + imgTag + afterText;
}

//General Event Listeners
let bold = document.getElementById("bold-button");
bold.addEventListener("click", function() {
    wrap("<strong>", "</strong>");
});

let italic = document.getElementById("italic-button");
italic.addEventListener("click", function() {
    wrap("<em>", "</em>");
});

let underline = document.getElementById("underline-button");
underline.addEventListener("click", function() {
    wrap("<u>", "</u>");
});



//Headings Event Listeners
let h1 = document.getElementById("h1-button");
h1.addEventListener("click", function() {
    wrap("<h1>", "</h1>");
});

let h2 = document.getElementById("h2-button");
h2.addEventListener("click", function() {
    wrap("<h2>", "</h2>");
});

let h3 = document.getElementById("h3-button");
h3.addEventListener("click", function() {
    wrap("<h3>", "</h3>");
});

let h4 = document.getElementById("h4-button");
h4.addEventListener("click", function() {
    wrap("<h4>", "</h4>");
});

let h5 = document.getElementById("h5-button");
h5.addEventListener("click", function() {
    wrap("<h5>", "</h5>");
});

let h6 = document.getElementById("h6-button");
h6.addEventListener("click", function() {
    wrap("<h6>", "</h6>");
});


//Page-layout Event Listeners
let br = document.getElementById("br-button");
br.addEventListener("click", function() {
    wrap('<br>', '</br>') ;
});

let hr = document.getElementById("hr-button");
hr.addEventListener("click", function() {
    wrap('<hr>', '</hr>') ;
});

let code = document.getElementById("code-button");
code.addEventListener("click", function() {
    wrap('<code>', '</code>') ;
});

let link = document.getElementById("link-button");
link.addEventListener("click", function() {
   wrap('<a href="Your Link Here">', '</a>') ;
});


