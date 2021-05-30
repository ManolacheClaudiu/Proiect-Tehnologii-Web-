window.onload = function() {
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