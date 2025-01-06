// Module: numpadEntry.js
import { validateEAN } from "./validation.js";
import { globalVariables } from "./globalVariables.js";
import { queryBackend } from "./queryBackend.js";
import { finishMengeOperation } from "./mengeOperations.js";
//import { displayError } from "./errorDisplay.js";

export const pushNumpadEntry = (numpadEntry) => {
    console.debug("Numpad Entry:", numpadEntry);

    if (globalVariables.isMengeActive) {
        console.debug(`Now entered ${globalVariables.currentMengeMultiplicator}x Item No. ${numpadEntry}`);
        finishMengeOperation();
    }

    const { isValid, type } = validateEAN(numpadEntry);
    console.debug("Validation Result:", { isValid, type });

    if (isValid) {
        console.log(`Valid ${type} detected: ${numpadEntry}`);
        queryBackend(numpadEntry, type);
    } else {
        console.debug(`Invalid code entered: ${numpadEntry}`);
    }
};