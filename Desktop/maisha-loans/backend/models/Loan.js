const mongoose = require("mongoose");

const LoanSchema = new mongoose.Schema({
  userId: String,
  amount: Number,
  repaymentDays: Number,
  interestRate: Number,
  totalRepayment: Number,
  status: {
    type: String,
    default: "Pending"
  },
  createdAt: {
    type: Date,
    default: Date.now
  }
});

module.exports = mongoose.model("Loan", LoanSchema);