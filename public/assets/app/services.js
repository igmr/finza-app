const baseUrl = `http://127.0.0.1:8000`;
const urlPostAuthenticate = `${baseUrl}`;
const baseUrlBank = `${baseUrl}/app/bank`;
const baseUrlGender = `${baseUrl}/app/gender`;
const baseUrlClassification = `${baseUrl}/app/classification`;

const fetchPostAuthenticate = async (payload, token) => {
    try {
        const response = await fetch(urlPostAuthenticate, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                Accept: "application/json",
                "X-CSRF-Token": token,
            },
            body: JSON.stringify(payload),
        });
        const data = await response.json();
        const status = response.status;
        return {
            status,
            data,
        };
    } catch (error) {
        console.log(error);
        return {
            status: 500,
            data: {},
        };
    }
};

//* ========================================================================================= *//
//* banks                                                                                     *//
//* ========================================================================================= *//

const storeBank = async (payload, token) => {
    try {
        const response = await fetch(baseUrlBank, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                Accept: "application/json",
                "X-CSRF-Token": token,
            },
            body: JSON.stringify(payload),
        });
        const data = await response.json();
        const status = response.status;
        return {
            status,
            data,
        };
    } catch (error) {
        console.log(error);
        return {
            status: 500,
            data: {},
        };
    }
};

const getAllBanks = async (url) => {
    try {
        auxUrl = url ?? `${baseUrlBank}/list`;
        const response = await fetch(auxUrl, {
            method: "GET",
            headers: {
                "Content-Type": "application/json",
                Accept: "application/json",
            },
        });
        const data = await response.json();
        if (data) {
            return data;
        }
        return {};
    } catch (error) {
        console.log(error);
        return {};
    }
};

const findByIdBank = async (bankId) => {
    const url = `${baseUrlBank}/info/${bankId}`;
    console.log(url);
    const response = await fetch(url, {
        method: "GET",
        headers: {
            "Content-Type": "application/json",
            Accept: "application/json",
        },
    });
    return await response.json();
};

const updateBank = async (payload, token, bankId) => {
    try {
        const response = await fetch(`${baseUrlBank}/${bankId}`, {
            method: "PUT",
            headers: {
                "Content-Type": "application/json",
                Accept: "application/json",
                "X-CSRF-Token": token,
            },
            body: JSON.stringify(payload),
        });
        const data = await response.json();
        const status = response.status;
        return {
            status,
            data,
        };
    } catch (error) {
        console.log(error);
        return {
            status: 500,
            data: {},
        };
    }
};

const deleteBank = async (bankId, token) => {
    const url = `${baseUrlBank}/${bankId}`;
    const response = await fetch(url, {
        method: "DELETE",
        headers: {
            "Content-Type": "application/json",
            Accept: "application/json",
            "X-CSRF-Token": token,
        },
    });
    return await response.json();
};

const restoreBank = async (bankId, token) => {
    const url = `${baseUrlBank}/${bankId}/restore`;
    const response = await fetch(url, {
        method: "DELETE",
        headers: {
            "Content-Type": "application/json",
            Accept: "application/json",
            "X-CSRF-Token": token,
        },
    });
    return await response.json();
};

//* ========================================================================================= *//
//* end banks                                                                                 *//
//* ========================================================================================= *//
//* genders                                                                                   *//
//* ========================================================================================= *//

const storeGender = async (payload, token) => {
    try {
        const response = await fetch(baseUrlGender, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                Accept: "application/json",
                "X-CSRF-Token": token,
            },
            body: JSON.stringify(payload),
        });
        const data = await response.json();
        const status = response.status;
        return {
            status,
            data,
        };
    } catch (error) {
        console.log(error);
        return {
            status: 500,
            data: {},
        };
    }
};

const getAllGenders = async (url) => {
    try {
        auxUrl = url ?? `${baseUrlGender}/list`;
        const response = await fetch(auxUrl, {
            method: "GET",
            headers: {
                "Content-Type": "application/json",
                Accept: "application/json",
            },
        });
        const data = await response.json();
        if (data) {
            return data;
        }
        return {};
    } catch (error) {
        console.log(error);
        return {};
    }
};

const findByIdGender = async (genderId) => {
    const url = `${baseUrlGender}/info/${genderId}`;
    console.log(url);
    const response = await fetch(url, {
        method: "GET",
        headers: {
            "Content-Type": "application/json",
            Accept: "application/json",
        },
    });
    return await response.json();
};

const updateGender = async (payload, token, genderId) => {
    try {
        const response = await fetch(`${baseUrlGender}/${genderId}`, {
            method: "PUT",
            headers: {
                "Content-Type": "application/json",
                Accept: "application/json",
                "X-CSRF-Token": token,
            },
            body: JSON.stringify(payload),
        });
        const data = await response.json();
        const status = response.status;
        return {
            status,
            data,
        };
    } catch (error) {
        console.log(error);
        return {
            status: 500,
            data: {},
        };
    }
};

const deleteGender = async (genderId, token) => {
    const url = `${baseUrlGender}/${genderId}`;
    const response = await fetch(url, {
        method: "DELETE",
        headers: {
            "Content-Type": "application/json",
            Accept: "application/json",
            "X-CSRF-Token": token,
        },
    });
    return await response.json();
};
const restoreGender = async (genderId, token) => {
    const url = `${baseUrlGender}/${genderId}/restore`;
    const response = await fetch(url, {
        method: "DELETE",
        headers: {
            "Content-Type": "application/json",
            Accept: "application/json",
            "X-CSRF-Token": token,
        },
    });
    return await response.json();
};

//* ========================================================================================= *//
//* end genders                                                                               *//
//* ========================================================================================= *//
//* classifications                                                                           *//
//* ========================================================================================= *//

const storeClassification = async (payload, token) => {
    try {
        const response = await fetch(baseUrlClassification, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                Accept: "application/json",
                "X-CSRF-Token": token,
            },
            body: JSON.stringify(payload),
        });
        const data = await response.json();
        const status = response.status;
        return {
            status,
            data,
        };
    } catch (error) {
        console.log(error);
        return {
            status: 500,
            data: {},
        };
    }
};

const getAllClassifications = async (url) => {
    try {
        auxUrl = url ?? `${baseUrlClassification}/list`;
        const response = await fetch(auxUrl, {
            method: "GET",
            headers: {
                "Content-Type": "application/json",
                Accept: "application/json",
            },
        });
        const data = await response.json();
        if (data) {
            return data;
        }
        return {};
    } catch (error) {
        console.log(error);
        return {};
    }
};

const findByIdClassification = async (classificationId) => {
    const url = `${baseUrlClassification}/info/${classificationId}`;
    console.log(url);
    const response = await fetch(url, {
        method: "GET",
        headers: {
            "Content-Type": "application/json",
            Accept: "application/json",
        },
    });
    return await response.json();
};

const updateClassification = async (payload, token, classificationId) => {
    try {
        const response = await fetch(`${baseUrlClassification}/${classificationId}`, {
            method: "PUT",
            headers: {
                "Content-Type": "application/json",
                Accept: "application/json",
                "X-CSRF-Token": token,
            },
            body: JSON.stringify(payload),
        });
        const data = await response.json();
        const status = response.status;
        return {
            status,
            data,
        };
    } catch (error) {
        console.log(error);
        return {
            status: 500,
            data: {},
        };
    }
};

const deleteClassification = async (classificationId, token) => {
    const url = `${baseUrlClassification}/${classificationId}`;
    const response = await fetch(url, {
        method: "DELETE",
        headers: {
            "Content-Type": "application/json",
            Accept: "application/json",
            "X-CSRF-Token": token,
        },
    });
    return await response.json();
};

const restoreClassification = async (classificationId, token) => {
    const url = `${baseUrlClassification}/${classificationId}/restore`;
    const response = await fetch(url, {
        method: "DELETE",
        headers: {
            "Content-Type": "application/json",
            Accept: "application/json",
            "X-CSRF-Token": token,
        },
    });
    return await response.json();
};

//* ========================================================================================= *//
//* end classifications                                                                       *//
//* ========================================================================================= *//
