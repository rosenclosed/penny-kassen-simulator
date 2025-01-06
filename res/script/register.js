//Define all globally important elements first
const numberLine = $("#numpad-number-line"); //The number line which recieves the numpad inputs
const bigInfoLine1Front = $("#big-info-area-line1-text1"); //the front span element of the upper red info line
const bigInfoLine1Back = $("#big-info-area-line1-text2"); //the back span element of the upper red info line
const bigInfoLine2Front = $("#big-info-area-line2-text1"); //the front span elemet of the lower red info line
const bigInfoLine2Back = $("#big-info-area-line2-text2"); //the back span element of the lower red info line

//Define all important global variables
let registerState; //stores the current state of the register
let lastEnteredNumber; //stores the last entered EAN/NAN/PLU for easy re-entry with EINGABE
let isMengeActive = false; //stores if the Mengentaste is active or not to correctly handle inputs
let isKisteActive = false; //stores if the Kistentaste is active or not to correctly handle inputs
let currentMengeMultiplicator; //stores the current Amount multiplicator to correctly handle inputs


//set Register state to home on document load
$(document).ready(function () {
    console.debug("Document ready!")
    registerState = "home";
    console.debug("Register State: ", registerState);
});


//Adding an event listener for a click or touch to all buttons with the class "penny-btn"
$(".penny-btn").on("touchend click", function (event) {
    event.preventDefault(); //Prevents duplicate firing if both touchend and click happen
    const pressedButton = $(this); //This is the jQuery object of the button which fired the event listener
    const pressedButtonId = pressedButton.attr("id"); //This is the ID of the Button that fired the event listener

    //Determine which area the pressed button belongs to by checking what the ID starts with.
    //Aftwerwards call the handler function and pass the Object, ID and the context of the pressed button

    //checks if the button is one of the empty, not defined buttons
    if (pressedButtonId == undefined) {
        console.warn("Taste nicht belegt!");
        return;
    };

    //checks if the button is a numpad button
    if (pressedButtonId.startsWith("numpad-")) {
        buttonHandler(pressedButton, pressedButtonId, "numpadButtons");
        return;
    };

    //checks if the button is a button on the home screen of the operator panel
    if (pressedButtonId.startsWith("op-home-")) {
        buttonHandler(pressedButton, pressedButtonId, "operatorHomeButtons");
        return;
    };

    //checks if the button is a button on the sum screen of the operator panel
    if (pressedButtonId.startsWith("op-sum-")) {
        buttonHandler(pressedButton, pressedButtonId, "operatorSumButtons");
        return;
    };

    //checks if the button is one of the modal triggering buttons
    if (pressedButtonId.startsWith("mod-")) {
        buttonHandler(pressedButton, pressedButtonId, "modalButtons");
        return;
    };

    //checks if the button is one of the small buttons in the bottom info line
    if (pressedButtonId.startsWith("info-")) {
        buttonHandler(pressedButton, pressedButtonId, "smallInfoButtons");
        return;
    };

    //checks if the button is one of the buttons to control/scroll the digital receipt
    if (pressedButtonId.startsWith("digital-receipt-")) {
        buttonHandler(pressedButton, pressedButtonId, "digitalReceiptButtons");
        return;
    };

    //throw a console error if the button does no belong to a known area, so if something is very broken
    console.error("Button does not belong to a known area.");
    buttonHandler(pressedButton, pressedButtonId, "unknown");


    //Calling handler function and passing the Object and the ID separately as well as the Context of the pressed button
    //buttonHandler(pressedButton, pressedButtonId, "");
});

const buttonHandler = (pressedButton, pressedButtonId, pressedButtonContext) => {
    console.debug("Button Element: ", pressedButton);
    console.debug("Button ID: ", pressedButtonId);
    console.debug("Button Context: ", pressedButtonContext);

    if (pressedButtonContext == "numpadButtons") {
        const numberMatch = pressedButtonId.match(/^numpad-(\d+)-btn$/); // Extract the number from the ID
        if (numberMatch) {
            const number = numberMatch[1];
            console.debug("Number entered: ", number);
            appendToNumberLine(number);
        } else {
            //If it's not a number button, handle operation button
            console.debug("Numpad Operation entered: ", pressedButtonId)
            handleNumpadOperations(pressedButtonId);
        };
        if (numberLine.text() != "" && $("#numpad-eingabe-btn").hasClass("disabled")) {
            $("#numpad-eingabe-btn").removeClass("disabled");
        };
        if (numberLine.text() == "") {
            $("#numpad-eingabe-btn").addClass("disabled");
        };
    };
};

const appendToNumberLine = (number) => {
    const currentText = numberLine.text(); //Get the current text
    if (currentText.length < 16) {
        numberLine.text(currentText + number);
    } else {
        console.warn("Eingabe zu lang!");
        numberLine.text("");
    }
};

const handleNumpadOperations = (buttonId) => {
    switch (buttonId) {
        case "numpad-back-btn":
            console.debug("Backspace Operation triggered");
            numberLine.text(numberLine.text().slice(0, -1)); //Removes the last character
            break;
        case "numpad-delete-btn":
            console.debug("Delete Operation triggered");
            numberLine.text("");
            if (isMengeActive) {
                isMengeActive = false;
                bigInfoLine1Front.text("");
                currentMengeMultiplicator = "";
                console.warn("Mengen-Operation abgebrochen!");
            }
            break;
        case "numpad-eingabe-btn":
            eingabeHandler();
            break;
        case "numpad-menge-btn":
            console.debug("Menge Operation triggered");
            //Add code for handling the Menge Taste here
            // i.e. handleMengeOperation(numberLine.text()) or something like that
            handleMengeOperation(numberLine.text());
            break;
    };
};

const eingabeHandler = () => {
    console.debug("Eingabe Operation triggered");
    pushNumpadEntry(numberLine.text())
    numberLine.text("");
};

const pushNumpadEntry = (numpadEntry) => {
    console.debug("Numpad Entry: ", numpadEntry);

    if (isMengeActive) {
        //add stuff
        console.debug("Now entered " + currentMengeMultiplicator + "x Item No. " + numpadEntry)
        isMengeActive = false;
        bigInfoLine1Front.text("");
        currentMengeMultiplicator = "";
    }

    // Perform EAN validation
    const { isValid, type } = validateEAN(numpadEntry);

    if (isValid) {
        console.log(`Valid ${type} detected: ${numpadEntry}`);
        // Query the backend with EAN type and value
        queryBackend(numpadEntry, type);
    } else {
        console.error(`Invalid EAN entered: ${numpadEntry}`);
        // Show an error message to the user
        $("body").append(`<div class="error">Invalid EAN entered: ${numpadEntry}</div>`);
        $(".error").fadeOut(3000, () => $(this).remove());
    }

};

// Simulated backend query function using jQuery's AJAX
const queryBackend = (ean, eanType) => {
    console.log(`Querying backend for ${eanType} in the appropriate column with EAN: ${ean}`);
    // Replace with actual AJAX logic
    /* $.ajax({
        url: "/api/query",
        method: "POST",
        data: { ean, eanType },
        success: (response) => {
            console.log("Backend response:", response);
        },
        error: (xhr, status, error) => {
            console.error("Backend query failed:", error);
        }
    }); */
};

//Helper function to validate EAN and determine it's type
const validateEAN = (ean) => {
    //Ensure that the input is a string and only contains digits
    if (!/^\d+$/.test(ean)) {
        return { isValid: false, type: null };
    }

    //Store the length of the String
    const length = ean.length;

    //Check for valid EAN lengths (EAN-8 or EAN-13)
    if (length !== 8 && length !== 13) {
        return { isValid: false, type: null };
    }

    let sum = 0;
    for (let i = 0; i < length - 1; i++) {
        const digit = parseInt(ean[i], 10);
        sum += length === 13
            ? (i % 2 === 0 ? 1 : 3) * digit //EAN-13 weighting
            : (i % 2 === 0 ? 3 : 1) * digit; //EAN-8 weighting
    }

    //Calculate checksum
    const checksum = (10 - (sum % 10)) % 10;

    //Validate Checksum
    return {
        isValid: checksum === parseInt(ean[length - 1], 10),
        type: checksum === parseInt(ean[length - 1], 10)
            ? (length === 13 ? "EAN-13" : "EAN-8")
            : null
    };
};

const handleMengeOperation = (amount) => {
    if (!isMengeActive && Number(amount) < 100 && Number(amount) > 0) {
        isMengeActive = true;
        currentMengeMultiplicator = amount;
        console.debug("Multiplicator is now: ", amount);
        bigInfoLine1Front.text("MENGE:    " + amount);
        //bigInfoLine1Back.text(amount + "   ");
        numberLine.text("");

    } else if (Number(amount) >= 100) {
        console.warn("Menge zu groß!");
        numberLine.text("");
    } else if (isMengeActive) {
        console.warn("Menge already active!");
    } else if (Number(amount) <= 0) {
        console.warn("Menge kleiner/gleich 0!");
        numberLine.text("");
    }
};