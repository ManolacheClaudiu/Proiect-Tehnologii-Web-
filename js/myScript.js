window.onload = function() {
    /* call delete after set number of days days  */
    var oncePerHour = 3600 * 1000;
    setInterval(function(){ 
        deleteOlderPasteBins();
    }, oncePerHour);

    /* highlight on key*/
    var codeInputElementById = document.getElementById("code-input-id");
    codeInputElementById.onkeydown = function(e) {
        if (e.keyCode == 32) {
            highlightOnKeyPressed(codeInputElementById);
        };
    };
};

function getCaretIndex(element) {
    let position = 0;
    const isSupported = typeof window.getSelection !== "undefined";
    if (isSupported) {
        const selection = window.getSelection();
        if (selection.rangeCount !== 0) {
            const range = window.getSelection().getRangeAt(0);
            const preCaretRange = range.cloneRange();
            preCaretRange.selectNodeContents(element);
            preCaretRange.setEnd(range.endContainer, range.endOffset);
            position = preCaretRange.toString().length;
        }
    }
    return position;
}

function placeCaretAtEnd(el) {
    el.focus();
    if (typeof window.getSelection != "undefined" &&
        typeof document.createRange != "undefined") {
        var range = document.createRange();
    range.selectNodeContents(el);
    range.collapse(false);
    var sel = window.getSelection();
    sel.removeAllRanges();
    sel.addRange(range);
} else if (typeof document.body.createTextRange != "undefined") {
    var textRange = document.body.createTextRange();
    textRange.moveToElementText(el);
    textRange.collapse(false);
    textRange.select();
}
}


function highlightOnKeyPressed(codeInputElementById) {
    var caretIndex = getCaretIndex(codeInputElementById);
    highlight();
    placeCaretAtEnd(codeInputElementById, caretIndex);
}

function highlight() {
    var codeParagraphName = "code-input";

    var checkBox = document.getElementById("myCheck");

    var valueOfTextArea = document.getElementsByClassName(codeParagraphName)[0].innerText;

    if (checkBox.checked == true) {
        var selectedLanguage = document.getElementById("languages-id").value;
        var languageRegex = getRegexForLanguage(selectedLanguage);

        var splittedTextBySpace = valueOfTextArea.split(/(\s+)/);

        for (var i = splittedTextBySpace.length - 1; i >= 0; i--) {
            if (splittedTextBySpace[i].match(languageRegex.keywordsRegex) !== null) {
                splittedTextBySpace[i] = '<span class="colored-keywords">' + splittedTextBySpace[i] + '</span>';
            };

            if (splittedTextBySpace[i].match(languageRegex.dataTypesRegex) !== null) {
                splittedTextBySpace[i] = '<span class="colored-datatypes">' + splittedTextBySpace[i] + '</span>';
            };
        }

        var highlightedCode = splittedTextBySpace.join("");

        document.getElementsByClassName(codeParagraphName)[0].innerHTML = highlightedCode;
    } else {
        document.getElementsByClassName(codeParagraphName)[0].innerHTML = valueOfTextArea.replace(/<\/?span[^>]*>/g, "");
    }
}


function getRegexForLanguage(selectedLanguage) {
    var result = {
        keywordsRegex: undefined,
        dataTypesRegex: undefined,
    };
    switch (selectedLanguage) {
        case "java":
        result.keywordsRegex = /\b(abstract|continue|for|new|switch|assert|default|goto|package|synchronized|boolean|do|if|private|this|break|double|implements|protected|throw|byte|else|import|public|throws|case|enum|instanceof|return|transient|catch|extends|int|short|try|char|final|interface|static|void|class|finally|long|strictfp|volatile|const|float|native|super|while+)\b/g;
        result.dataTypesRegex = /\b(Integer|String|Double|BigInteger|Float|Long|Byte|Short|Character+)\b/g;
        default:

    }
    return result;
}

function submitCodeForSave(){
    var valueOfTextArea = document.getElementsByClassName("code-input")[0].innerText;
    document.getElementById("hidden-input-code-id").value = valueOfTextArea;
}

function fetchCodeByCodeId(codeId,codName){
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementsByClassName("code-input")[0].removeAttribute("contenteditable");
            document.getElementsByClassName("code-input")[0].innerText = this.responseText;
        }
    }
    xhttp.open("GET", "getCodeById.php?codid=" + codeId, true);
    xhttp.send(); 

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var response = JSON.parse(this.responseText);

            var liElements = "";
            response.forEach(element =>{
                liElements = liElements + '<li><a class="btn-class-fetched" href="#">' + element.collaboratorUserId + '</a></li>';
             });

            document.getElementById("file-version").innerHTML=liElements;
        }
    }
    xhttp.open("GET", "getCodeVersions.php?codName="+codName, true);
    xhttp.send();

}


function deleteCodeById(codeId){
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            location.reload();  
        }
    }
    xhttp.open("GET", "deleteCodById.php?codid=" + codeId, true);
    xhttp.send();
}

function resetCodeInput(){
    var editableDiv = document.getElementsByClassName("code-input")[0];
    editableDiv.setAttribute("contenteditable", true);
    editableDiv.innerText = "";

}

function deleteOlderPasteBins(){
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            location.reload();  
        }
    }
    xhttp.open("GET", "deleteOldPasteBins.php", true);
    xhttp.send();
}

function editCodeById(codeId){
    var populateFieldsHttp = new XMLHttpRequest();
    populateFieldsHttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var responseAsJson = JSON.parse(this.responseText);
            document.getElementsByClassName("code-input")[0].setAttribute("contenteditable", true);

            document.getElementsByClassName("code-input")[0].innerText = responseAsJson.codeText;
            document.getElementById("codName-id").value = responseAsJson.codName;
            document.getElementById("codPwd").value =  responseAsJson.codPwd;
            document.getElementById("codValability").value = responseAsJson.codValability;
            document.getElementById("codVisibility").value = responseAsJson.codVisibility;

            document.getElementById("action-id-hidden").value= "update";

            document.getElementById("hidden-code-id").value = codeId;
        }
    }
    populateFieldsHttp.open("GET", "getAllCodeInformationById.php?codid=" + codeId, true);
    populateFieldsHttp.send();
}

function addCollaborator(){
    var codeId = document.getElementById("collab-hidden-code-id").value;
    var collabUsername =document.getElementById("collaborators-select-id").value;
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            location.reload(); 
        }
    }
    xhttp.open("POST", "addCollaborator.php", true);
    xhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhttp.send("codeId="+ codeId + "&collabUsername=" + collabUsername);
}


function fetchCollaboratorsForCodeId(codeId){
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var response = JSON.parse(this.responseText);

            var liElements = "";
            response.forEach(element =>{
                liElements = liElements + '<li><a class="btn-class-fetched" href="#">' + element.collaboratorUserId + '</a></li>';
             });

            document.getElementById("collaborators-list-id").innerHTML=liElements;
        }
    }
    xhttp.open("GET", "getCollaboratorsForCodeId.php?codeId="+codeId, true);
    xhttp.send();
}