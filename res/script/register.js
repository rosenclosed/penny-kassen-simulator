// Define all globally important elements
const numberLine = $("#numpad-number-line"); // Number line for numpad inputs
const bigInfoLine1Front = $("#big-info-area-line1-text1"); // Front span of the upper red info line
const bigInfoLine1Back = $("#big-info-area-line1-text2"); // Back span of the upper red info line
const bigInfoLine2Front = $("#big-info-area-line2-text1"); // Front span of the lower red info line
const bigInfoLine2Back = $("#big-info-area-line2-text2"); // Back span of the lower red info line

// Define all important global variables
let registerState; // Stores the current state of the register
let lastEnteredNumber; // Stores the last entered EAN/NAN/PLU for re-entry
let isMengeActive = false; // Tracks if the Menge button is active
let isKisteActive = false; // Tracks if the Kiste button is active
let currentMengeMultiplicator; // Stores the current Menge multiplier

// Initialize register state on document load
$(document).ready(() => {
    console.debug("Document ready!");
    registerState = "home";
    console.debug("Register State:", registerState);
});

// Attach event listeners to buttons
$(".penny-btn").on("touchend click", (event) => {
    event.preventDefault(); // Prevents duplicate firing
    const pressedButton = $(event.currentTarget); // Get the button element
    const pressedButtonId = pressedButton.attr("id"); // Get the button's ID

    if (!pressedButtonId) {
        console.warn("Taste nicht belegt!");
        return;
    }

    // Determine the button's context and handle it
    const contexts = [
        { prefix: "numpad-", handler: "numpadButtons" },
        { prefix: "op-home-", handler: "operatorHomeButtons" },
        { prefix: "op-sum-", handler: "operatorSumButtons" },
        { prefix: "mod-", handler: "modalButtons" },
        { prefix: "info-", handler: "smallInfoButtons" },
        { prefix: "digital-receipt-", handler: "digitalReceiptButtons" }
    ];

    for (const { prefix, handler } of contexts) {
        if (pressedButtonId.startsWith(prefix)) {
            buttonHandler(pressedButton, pressedButtonId, handler);
            return;
        }
    }

    console.error("Button does not belong to a known area.");
    buttonHandler(pressedButton, pressedButtonId, "unknown");
});

// Button handler
const buttonHandler = (pressedButton, pressedButtonId, pressedButtonContext) => {
    console.debug("Button Element:", pressedButton);
    console.debug("Button ID:", pressedButtonId);
    console.debug("Button Context:", pressedButtonContext);

    if (pressedButtonContext === "numpadButtons") {
        const numberMatch = pressedButtonId.match(/^numpad-(\d+)-btn$/);
        if (numberMatch) {
            appendToNumberLine(numberMatch[1]);
        } else {
            handleNumpadOperations(pressedButtonId);
        }
        toggleEingabeButton();
    }
};

// Append number to number line
const appendToNumberLine = (number) => {
    const currentText = numberLine.text();
    if (currentText.length < 16) {
        numberLine.text(currentText + number);
    } else {
        console.warn("Eingabe zu lang!");
        numberLine.text("");
    }
};

// Toggle the "EINGABE" button's state
const toggleEingabeButton = () => {
    const isEmpty = numberLine.text() === "";
    $("#numpad-eingabe-btn").toggleClass("disabled", isEmpty);
};

// Handle numpad operations
const handleNumpadOperations = (buttonId) => {
    const operations = {
        "numpad-back-btn": () => {
            console.debug("Backspace Operation triggered");
            numberLine.text(numberLine.text().slice(0, -1));
        },
        "numpad-delete-btn": () => {
            console.debug("Delete Operation triggered");
            numberLine.text("");
            if (isMengeActive) {
                cancelMengeOperation();
            }
        },
        "numpad-eingabe-btn": eingabeHandler,
        "numpad-menge-btn": () => handleMengeOperation(numberLine.text())
    };

    operations[buttonId]?.();
};

// Cancel Menge operation
const cancelMengeOperation = () => {
    isMengeActive = false;
    bigInfoLine1Front.text("");
    currentMengeMultiplicator = "";
    console.warn("Mengen-Operation abgebrochen!");
};

// Finish Menge operation
const finishMengeOperation = () => {
    isMengeActive = false;
    bigInfoLine1Front.text("");
    currentMengeMultiplicator = "";
    console.warn("Mengen-Operation beendet!");
};

// Handle "EINGABE" operation
const eingabeHandler = () => {
    console.debug("Eingabe Operation triggered");
    pushNumpadEntry(numberLine.text());
    numberLine.text("");
};

// Push numpad entry
const pushNumpadEntry = (numpadEntry) => {
    console.debug("Numpad Entry:", numpadEntry);

    if (isMengeActive) {
        console.debug(`Now entered ${currentMengeMultiplicator}x Item No. ${numpadEntry}`);
        finishMengeOperation();
    }

    const { isValid, type } = validateEAN(numpadEntry);
    if (isValid) {
        console.log(`Valid ${type} detected: ${numpadEntry}`);
        queryBackend(numpadEntry, type);
    } else {
        displayError(`Invalid EAN entered: ${numpadEntry}`);
    }
};

// Display an error message
const displayError = (message) => {
    $("body").append(`<div class="error">${message}</div>`);
    $(".error").fadeOut(3000, () => $(this).remove());
};

// Simulated backend query
const queryBackend = (ean, eanType) => {
    console.log(`Querying backend for ${eanType} with EAN: ${ean}`);
    // Placeholder for actual AJAX logic
};

// Validate EAN
const validateEAN = (ean) => {
    if (!/^\d+$/.test(ean)) return { isValid: false, type: null };

    const length = ean.length;
    if (![8, 13].includes(length)) return { isValid: false, type: null };

    const checksum = Array.from(ean)
        .slice(0, -1)
        .reduce((sum, char, i) => sum + parseInt(char, 10) * (length === 13 ? (i % 2 === 0 ? 1 : 3) : (i % 2 === 0 ? 3 : 1)), 0);

    return {
        isValid: (10 - (checksum % 10)) % 10 === parseInt(ean[length - 1], 10),
        type: length === 13 ? "EAN-13" : "EAN-8"
    };
};

// Handle Menge operation
const handleMengeOperation = (amount) => {
    if (isMengeActive) {
        console.warn("Menge already active!");
        return;
    }
    if (Number(amount) >= 100) {
        console.warn("Menge zu groß!");
        numberLine.text("");
    } else if (Number(amount) > 0) {
        isMengeActive = true;
        currentMengeMultiplicator = amount;
        console.debug("Multiplicator is now:", amount);
        bigInfoLine1Front.text(`MENGE:    ${amount}`);
        numberLine.text("");
    } else {
        console.warn("Menge kleiner/gleich 0!");
        numberLine.text("");
    }
};
