const table = new NioApp.DataTable(".list", {
    scrollX: true,
    scrollY: 200,
    progressing: true,
    autoWidth: false,
    pageLength: 5,
    lengthMenu: [
        [5, 10, 20, -1],
        [5, 10, 20, "All"],
    ],
    paging: true,
    responsive: {
        details: true,
    },
    buttons: ["copy", "excel", "csv", "pdf"],
    ajax: `${baseUrlEgress}/datatable`,
    columns: [
        {
            title: "#",
            data: "egr_id",
        },
        {
            title: "Concept",
            data: null,
            render: (data) => {
                return `<a href="${baseUrlEgress}/${data.egr_id}">${data.concept}</a>`;
            },
        },
        {
            title: "Category",
            data: "category",
        },
        {
            title: "Amount",
            class: "text-right",
            data: null,
            render: (data) => {
                let amount = currencyFormatter({
                    currency: "MXN",
                    value: data.amount,
                });
                return amount;
            },
        },
        {
            title: "Created at",
            class: "text-right",
            data: "created_at",
            render: (data) => {
                return dateFormatter({ locate: "en-US", value: data });
            },
        },
        {
            title: "Status",
            class: "text-right",
            data: null,
            render: (data) => {
                let statusClass = "danger";
                let statusText = "Inactive";
                if (data.status == "Activo") {
                    statusClass = "success";
                    statusText = "Active";
                }
                return ` <span class="badge badge-dot badge-${statusClass}" id="status">${statusText}</span>`;
            },
        },
    ],
    order: [[0, 'desc']]
});
