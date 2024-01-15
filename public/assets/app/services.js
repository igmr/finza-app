const baseUrl = `http://127.0.0.1:8000`;
const urlPostAuthenticate = `${baseUrl}`;
const baseUrlBank = `${baseUrl}/app/bank`;
const baseUrlGender = `${baseUrl}/app/gender`;
const baseUrlClassification = `${baseUrl}/app/classification`;
const baseUrlAccount = `${baseUrl}/app/account`;
const baseUrlCategory = `${baseUrl}/app/category`;
const baseUrlBudget = `${baseUrl}/app/budget`;
const baseUrlSaving = `${baseUrl}/app/saving`;
const baseUrlDebt = `${baseUrl}/app/debt`;
const baseUrlIngress = `${baseUrl}/app/ingress`;
const baseUrlEgress = `${baseUrl}/app/egress`;
const baseUrlTransaction = `${baseUrl}/app/transaction`;

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

const selectBank = async () => {
    try {
        const url = `${baseUrlBank}/select`;
        const response = await fetch(url, {
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

const selectGender = async () => {
    try {
        const url = `${baseUrlGender}/select`;
        const response = await fetch(url, {
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

//* ========================================================================================= *//
//* end genders                                                                               *//
//* ========================================================================================= *//
//* categories                                                                                *//
//* ========================================================================================= *//

const storeCategory = async (payload, token) => {
    try {
        const response = await fetch(baseUrlCategory, {
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

const getAllCategories = async (url) => {
    try {
        auxUrl = url ?? `${baseUrlCategory}/list`;
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

const findByIdCategory = async (categoryId) => {
    const url = `${baseUrlCategory}/info/${categoryId}`;
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

const updateCategory = async (payload, token, categoryId) => {
    try {
        const response = await fetch(`${baseUrlCategory}/${categoryId}`, {
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

const deleteCategory = async (categoryId, token) => {
    const url = `${baseUrlCategory}/${categoryId}`;
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

const restoreCategory = async (categoryId, token) => {
    const url = `${baseUrlCategory}/${categoryId}/restore`;
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

const selectCategory = async () => {
    try {
        const url = `${baseUrlCategory}/select`;
        const response = await fetch(url, {
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

//* ========================================================================================= *//
//* end categories                                                                            *//
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
        const response = await fetch(
            `${baseUrlClassification}/${classificationId}`,
            {
                method: "PUT",
                headers: {
                    "Content-Type": "application/json",
                    Accept: "application/json",
                    "X-CSRF-Token": token,
                },
                body: JSON.stringify(payload),
            }
        );
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

const selectClassification = async () => {
    try {
        const url = `${baseUrlClassification}/select`;
        const response = await fetch(url, {
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

//* ========================================================================================= *//
//* end classifications                                                                       *//
//* ========================================================================================= *//
//* accounts                                                                                  *//
//* ========================================================================================= *//

const storeAccount = async (payload, token) => {
    try {
        const response = await fetch(baseUrlAccount, {
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

const getAllAccounts = async (url) => {
    try {
        auxUrl = url ?? `${baseUrlAccount}/list`;
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

const findByIdAccount = async (accountId) => {
    const url = `${baseUrlAccount}/info/${accountId}`;
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

const updateAccount = async (payload, token, accountId) => {
    try {
        const response = await fetch(`${baseUrlAccount}/${accountId}`, {
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

const deleteAccount = async (accountId, token) => {
    const url = `${baseUrlAccount}/${accountId}`;
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

const restoreAccount = async (accountId, token) => {
    const url = `${baseUrlAccount}/${accountId}/restore`;
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

const selectAccount = async () => {
    try {
        const url = `${baseUrlAccount}/select`;
        const response = await fetch(url, {
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

//* ========================================================================================= *//
//* end accounts                                                                              *//
//* ========================================================================================= *//
//* budgets                                                                                   *//
//* ========================================================================================= *//

const storeBudget = async (payload, token) => {
    try {
        const response = await fetch(baseUrlBudget, {
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

const getAllBudgets = async (url) => {
    try {
        auxUrl = url ?? `${baseUrlBudget}/list`;
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

const findByIdBudget = async (budgetId) => {
    const url = `${baseUrlBudget}/info/${budgetId}`;
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

const updateBudget = async (payload, token, budgetId) => {
    try {
        const response = await fetch(`${baseUrlBudget}/${budgetId}`, {
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

const deleteBudget = async (budgetId, token) => {
    const url = `${baseUrlBudget}/${budgetId}`;
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

const restoreBudget = async (budgetId, token) => {
    const url = `${baseUrlBudget}/${budgetId}/restore`;
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

const selectBudget = async () => {
    try {
        const url = `${baseUrlBudget}/select`;
        const response = await fetch(url, {
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

//* ========================================================================================= *//
//* end budgets                                                                               *//
//* ========================================================================================= *//
//* ========================================================================================= *//
//* Savings                                                                                   *//
//* ========================================================================================= *//

const storeSaving = async (payload, token) => {
    try {
        const response = await fetch(baseUrlSaving, {
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

const getAllSaving = async (url) => {
    try {
        auxUrl = url ?? `${baseUrlSaving}/list`;
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

const findByIdSaving = async (savingId) => {
    const url = `${baseUrlSaving}/info/${savingId}`;
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

const updateSaving = async (payload, token, savingId) => {
    try {
        const response = await fetch(`${baseUrlSaving}/${savingId}`, {
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

const deleteSaving = async (savingId, token) => {
    const url = `${baseUrlSaving}/${savingId}`;
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

const restoreSaving = async (savingId, token) => {
    const url = `${baseUrlSaving}/${savingId}/restore`;
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

const selectSaving = async () => {
    try {
        const url = `${baseUrlSaving}/select`;
        const response = await fetch(url, {
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

//* ========================================================================================= *//
//* end Savings                                                                               *//
//* ========================================================================================= *//
//* Debts                                                                                     *//
//* ========================================================================================= *//

const storeDebt = async (payload, token) => {
    try {
        const response = await fetch(baseUrlDebt, {
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

const getAllDebt = async (url) => {
    try {
        auxUrl = url ?? `${baseUrlDebt}/list`;
        const response = await fetch(auxUrl, {
            method: "GET",
            headers: {
                "Content-Type": "application/json",
                Accept: "application/json",
            },
        });
        const data = await response.json();
        console.log(data);
        if (data) {
            return data;
        }
        return {};
    } catch (error) {
        console.log(error);
        return {};
    }
};

const findByIdDebt = async (debtId) => {
    const url = `${baseUrlDebt}/info/${debtId}`;
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

const updateDebt = async (payload, token, debtId) => {
    try {
        const response = await fetch(`${baseUrlDebt}/${debtId}`, {
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

const deleteDebt = async (debtId, token) => {
    const url = `${baseUrlDebt}/${debtId}`;
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

const restoreDebt = async (debtId, token) => {
    const url = `${baseUrlDebt}/${debtId}/restore`;
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

const selectDebt = async () => {
    try {
        const url = `${baseUrlDebt}/select`;
        const response = await fetch(url, {
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

//* ========================================================================================= *//
//* end Debts                                                                                 *//
//* ========================================================================================= *//
//* Ingresses                                                                                 *//
//* ========================================================================================= *//

const storeIngress = async (payload, token) => {
    try {
        const response = await fetch(baseUrlIngress, {
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

const getAllIngress = async (url) => {
    try {
        auxUrl = url ?? `${baseUrlIngress}/list`;
        const response = await fetch(auxUrl, {
            method: "GET",
            headers: {
                "Content-Type": "application/json",
                Accept: "application/json",
            },
        });
        const data = await response.json();
        console.log(data);
        if (data) {
            return data;
        }
        return {};
    } catch (error) {
        console.log(error);
        return {};
    }
};

const findByIdIngress = async (ingressId) => {
    const url = `${baseUrlIngress}/info/${ingressId}`;
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

const updateIngress = async (payload, token, ingressId) => {
    try {
        const response = await fetch(`${baseUrlIngress}/${ingressId}`, {
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

const deleteIngress = async (ingressId, token) => {
    const url = `${baseUrlIngress}/${ingressId}`;
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

const restoreIngress = async (ingressId, token) => {
    const url = `${baseUrlIngress}/${ingressId}/restore`;
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
//* end Ingresses                                                                             *//
//* ========================================================================================= *//
//* Egresses                                                                                  *//
//* ========================================================================================= *//

const storeEgress = async (payload, token) => {
    try {
        const response = await fetch(baseUrlEgress, {
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

const getAllEgress = async (url) => {
    try {
        auxUrl = url ?? `${baseUrlEgress}/list`;
        const response = await fetch(auxUrl, {
            method: "GET",
            headers: {
                "Content-Type": "application/json",
                Accept: "application/json",
            },
        });
        const data = await response.json();
        console.log(data);
        if (data) {
            return data;
        }
        return {};
    } catch (error) {
        console.log(error);
        return {};
    }
};

const findByIdEgress = async (egressId) => {
    const url = `${baseUrlEgress}/info/${egressId}`;
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

const updateEgress = async (payload, token, egressId) => {
    try {
        const response = await fetch(`${baseUrlEgress}/${egressId}`, {
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

const deleteEgress = async (egressId, token) => {
    const url = `${baseUrlEgress}/${egressId}`;
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

const restoreEgress = async (egressId, token) => {
    const url = `${baseUrlEgress}/${egressId}/restore`;
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
//* end Egresses                                                                              *//
//* ========================================================================================= *//
//* Transactions                                                                              *//
//* ========================================================================================= *//

const storeTransaction = async (payload, token) => {
    try {
        const response = await fetch(baseUrlTransaction, {
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

const getAllTransaction = async (url) => {
    try {
        auxUrl = url ?? `${baseUrlTransaction}/list`;
        const response = await fetch(auxUrl, {
            method: "GET",
            headers: {
                "Content-Type": "application/json",
                Accept: "application/json",
            },
        });
        const data = await response.json();
        console.log(data);
        if (data) {
            return data;
        }
        return {};
    } catch (error) {
        console.log(error);
        return {};
    }
};

const findByIdTransaction = async (transactionId) => {
    const url = `${baseUrlTransaction}/info/${transactionId}`;
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

const updateTransaction = async (payload, token, transactionId) => {
    try {
        const response = await fetch(`${baseUrlTransaction}/${transactionId}`, {
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

const deleteTransaction = async (transactionId, token) => {
    const url = `${baseUrlTransaction}/${transactionId}`;
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

const restoreTransaction = async (transactionId, token) => {
    const url = `${baseUrlTransaction}/${transactionId}/restore`;
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
//* end Transactions                                                                          *//
//* ========================================================================================= *//
