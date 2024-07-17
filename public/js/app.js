const urlContacts = "/public/api/get_contacts.php";
const $buttonGetTable = $('#get-table');
const $divTable = $('#app');
const svgLoading = `<svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24"><g><circle cx="12" cy="2.5" r="1.5" fill="currentColor" opacity="0.14"/><circle cx="16.75" cy="3.77" r="1.5" fill="currentColor" opacity="0.29"/><circle cx="20.23" cy="7.25" r="1.5" fill="currentColor" opacity="0.43"/><circle cx="21.5" cy="12" r="1.5" fill="currentColor" opacity="0.57"/><circle cx="20.23" cy="16.75" r="1.5" fill="currentColor" opacity="0.71"/><circle cx="16.75" cy="20.23" r="1.5" fill="currentColor" opacity="0.86"/><circle cx="12" cy="21.5" r="1.5" fill="currentColor"/><animateTransform attributeName="transform" calcMode="discrete" dur="0.75s" repeatCount="indefinite" type="rotate" values="0 12 12;30 12 12;60 12 12;90 12 12;120 12 12;150 12 12;180 12 12;210 12 12;240 12 12;270 12 12;300 12 12;330 12 12;360 12 12"/></g></svg>`;

$buttonGetTable.on("click", () => getTable());

async function getTable() {
    $buttonGetTable.html(`${ svgLoading } Cargando...`);
    $divTable.html(null);

    // Traer datos de la API local
    await $.ajax({
        url: urlContacts, 
        type: 'GET',
        dataType: 'json', 
        success: response => showTable(response),
        error: function(error) {
            console.error('Error en la solicitud Ajax:', error);
        }
    });

    $buttonGetTable.html(`Cargar tabla`);
}

function showTable(contacts) {
    let table;

    table = `<h1>Contacts Table</h1><table class="table table-striped table-hover mt-3"><thead><tr><th scope="col">Id</th><th scope="col">Contact N°</th><th scope="col">Last Name</th><th scope="col">Created Time</th></tr></thead><tbody>`;
    contacts.forEach(contact => {
        table += `<tr><th scope="row">${ contact.id }</th><td>${ contact.contact_no }</td><td>${ contact.lastname }</td><td>${ contact.createdtime }</td></tr>`;
    });
    table += `</tbody></table>`;
    // Cargar la tabla en el DIV
    $divTable.html(table);
}