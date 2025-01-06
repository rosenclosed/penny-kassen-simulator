// Module: numpad.js
import { domElements } from "./domElements.js";
import { cancelMengeOperation, finishMengeOperation, handleMengeOperation } from "./mengeOperations.js";
import { eingabeHandler } from "./eingabeHandler.js";

export const appendToNumberLine = (number) => {
    const currentText = domElements.numberLine.text();
    console.debug("Current Text in Number Line:", currentText);

    if (currentText.length < 16) {
        domElements.numberLine.text(currentText + number);
        console.debug("Updated Number Line:", domElements.numberLine.text());
    } else {
        console.warn("Eingabe zu lang!");
        domElements.numberLine.text("");
    }
};

export const toggleEingabeButton = () => {
    const isEmpty = domElements.numberLine.text() === "";
    console.debug("Is Number Line Empty?:", isEmpty);
    $("#numpad-eingabe-btn").toggleClass("disabled", isEmpty);
};

export const handleNumpadOperations = (buttonId) => {
    console.debug("Handling Numpad Operation for Button ID:", buttonId);

    const operations = {
        "numpad-back-btn": () => {
            console.debug("Backspace Operation triggered");
            domElements.numberLine.text(domElements.numberLine.text().slice(0, -1));
        },
        "numpad-delete-btn": () => {
            console.debug("Delete Operation triggered");
            domElements.numberLine.text("");
            if (globalVariables.isMengeActive) {
                console.debug("Cancelling Menge Operation");
                cancelMengeOperation();
            }
        },
        "numpad-eingabe-btn": eingabeHandler,
        "numpad-menge-btn": () => {
            console.debug("Handling Menge Operation");
            handleMengeOperation(domElements.numberLine.text());
        }
    };

    if (operations[buttonId]) {
        operations[buttonId]();
    } else {
        console.warn("No operation defined for Button ID:", buttonId);
    }
};