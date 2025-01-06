// Module: mengeOperations.js
import { domElements } from "./domElements.js";
import { globalVariables } from "./globalVariables.js";

export const cancelMengeOperation = () => {
    globalVariables.isMengeActive = false;
    domElements.bigInfoLine1Front.text("");
    globalVariables.currentMengeMultiplicator = "";
    console.warn("Mengen-Operation abgebrochen!");
};

export const finishMengeOperation = () => {
    globalVariables.isMengeActive = false;
    domElements.bigInfoLine1Front.text("");
    globalVariables.currentMengeMultiplicator = "";
    console.warn("Mengen-Operation beendet!");
};

export const handleMengeOperation = (amount) => {
    console.debug("Handling Menge Operation with Amount:", amount);

    if (globalVariables.isMengeActive) {
        console.warn("Menge already active!");
        return;
    }
    if (Number(amount) >= 100) {
        console.warn("Menge zu groß!");
        domElements.numberLine.text("");
    } else if (Number(amount) > 0) {
        globalVariables.isMengeActive = true;
        globalVariables.currentMengeMultiplicator = amount;
        console.debug("Multiplicator is now:", amount);
        domElements.bigInfoLine1Front.text(`MENGE:\t\t${amount}`);
        domElements.numberLine.text("");
    } else {
        console.warn("Menge kleiner/gleich 0!");
        domElements.numberLine.text("");
    }
};