// Module: validation.js
export const validateEAN = (ean) => {
    console.debug("Validating EAN:", ean);

    if (!/^\d+$/.test(ean)) {
        console.warn("EAN is not numeric");
        return { isValid: false, type: null };
    }

    const length = ean.length;
    if (length === 8 || length === 13) {
        const checksum = Array.from(ean)
            .slice(0, -1)
            .reduce((sum, char, i) => sum + parseInt(char, 10) * (length === 13 ? (i % 2 === 0 ? 1 : 3) : (i % 2 === 0 ? 3 : 1)), 0);

        const isValid = (10 - (checksum % 10)) % 10 === parseInt(ean[length - 1], 10);
        console.debug("Checksum Validation Result:", isValid);

        return {
            isValid,
            type: length === 13 ? "ean13" : "ean8"
        };
    }

    if (length === 10) {
        console.debug("Detected NAN");
        return { isValid: true, type: "nan" };
    }

    if (length <= 6) {
        console.debug("Detected PLU");
        return { isValid: true, type: "plu" };
    }

    console.warn("EAN is invalid");
    return { isValid: false, type: null };
};