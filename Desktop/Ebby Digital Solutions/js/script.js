// =========================================
// INVOICE SYSTEM
// =========================================

// Create invoice from latest quote

function generateInvoice(){

const quotes =
getData("quotes");

if(quotes.length === 0){

alert(
"No quote available."
);

return;

}

const latestQuote =
quotes[quotes.length - 1];

const invoice = {

id: Date.now(),

invoiceNumber:
"INV-" +
Math.floor(
1000 + Math.random() * 9000
),

service:
latestQuote.service,

amount:
latestQuote.total,

status:
"Pending",

date:
new Date()
.toLocaleDateString()

};

let invoices =
getData("invoices");

invoices.push(invoice);

setData(
"invoices",
invoices
);

addNotification(
`Invoice ${invoice.invoiceNumber} generated.`
);

window.location.href =
"invoice.html";

}

// =========================================
// DISPLAY CURRENT INVOICE
// =========================================

const invoiceNumber =
document.getElementById(
"invoiceNumber"
);

const invoiceService =
document.getElementById(
"invoiceService"
);

const invoiceAmount =
document.getElementById(
"invoiceAmount"
);

const invoiceStatus =
document.getElementById(
"invoiceStatus"
);

const invoiceDate =
document.getElementById(
"invoiceDate"
);

if(invoiceNumber){

const invoices =
getData("invoices");

if(invoices.length > 0){

const invoice =
invoices[
invoices.length - 1
];

invoiceNumber.textContent =
invoice.invoiceNumber;

invoiceService.textContent =
invoice.service;

invoiceAmount.textContent =
invoice.amount;

invoiceStatus.textContent =
invoice.status;

invoiceDate.textContent =
invoice.date;

}

}

// =========================================
// INVOICE LIST
// =========================================

const invoicesList =
document.getElementById(
"invoicesList"
);

if(invoicesList){

const invoices =
getData("invoices");

if(invoices.length === 0){

invoicesList.innerHTML =

'<div class="card"><h3>No Invoices</h3><p>No invoices available.</p></div>';

}else{

invoices
.slice()
.reverse()
.forEach(invoice=>{

invoicesList.innerHTML +=

`<div class="card">

<h3>
${invoice.invoiceNumber}
</h3>

<p>
Service:
${invoice.service}
</p>

<p>
Amount:
${invoice.amount}
</p>

<p>
Status:
${invoice.status}
</p>

<p>
Date:
${invoice.date}
</p>

</div>`;

});

}

}

// =========================================
// INVOICE COUNTER
// =========================================

const invoiceCount =
document.getElementById(
"invoiceCount"
);

if(invoiceCount){

invoiceCount.textContent =
getData(
"invoices"
).length;

}

// =========================================
// PRINT INVOICE
// =========================================

function printInvoice(){

window.print();

}
