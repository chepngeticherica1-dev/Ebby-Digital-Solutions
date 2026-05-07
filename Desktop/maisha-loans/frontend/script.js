async function submitApplication() {

  const fullName = document.getElementById("fullName").value;
  const nationalId = document.getElementById("nationalId").value;
  const phone = document.getElementById("phone").value;
  const employment = document.getElementById("employment").value;
  const income = document.getElementById("income").value;
  const mpesa = document.getElementById("mpesa").value;

  const amount = document.getElementById("amount").value;
  const repaymentDays = document.getElementById("days").value;

  const registerResponse = await fetch(
    "http://localhost:5000/api/auth/register",
    {
      method: "POST",
      headers: {
        "Content-Type": "application/json"
      },
      body: JSON.stringify({
        fullName,
        nationalId,
        phone,
        employment,
        income,
        mpesa
      })
    }
  );

  const user = await registerResponse.json();

  const loanResponse = await fetch(
    "http://localhost:5000/api/loans/apply",
    {
      method: "POST",
      headers: {
        "Content-Type": "application/json"
      },
      body: JSON.stringify({
        userId: user._id,
        amount,
        repaymentDays
      })
    }
  );

  const result = await loanResponse.json();

  const resultBox = document.getElementById("result");

  if (result.status === "Approved") {

    resultBox.style.background = "rgba(22,163,74,0.2)";

    resultBox.innerHTML = `
      <h3>Loan Approved</h3>
      <p>Credit Score: ${result.score}</p>
      <p>Total Repayment: KES ${result.loan.totalRepayment}</p>
    `;

  } else {

    resultBox.style.background = "rgba(239,68,68,0.2)";

    resultBox.innerHTML = `
      <h3>Loan Rejected</h3>
      <p>Credit Score: ${result.score}</p>
    `;
  }
}