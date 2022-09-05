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

    console.log(beforeText + tagOne + selection + tagTwo + afterText);
    textarea.value = beforeText + tagOne + selection + tagTwo + afterText;
}

//Event Listeners
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
