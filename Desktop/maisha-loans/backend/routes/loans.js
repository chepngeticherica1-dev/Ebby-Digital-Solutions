const express = require("express");
const router = express.Router();
const Loan = require("../models/Loan");
const User = require("../models/User");

router.post("/apply", async (req, res) => {
  try {
    const {
      userId,
      amount,
      repaymentDays
    } = req.body;

    const user = await User.findById(userId);

    if (!user) {
      return res.status(404).json({
        message: "User not found"
      });
    }

    let score = 0;

    if (user.income >= 50000) {
      score += 40;
    } else if (user.income >= 20000) {
      score += 25;
    } else {
      score += 10;
    }

    if (amount <= user.income * 0.5) {
      score += 30;
    } else {
      score += 10;
    }

    if (user.employment === "employed") {
      score += 20;
    } else if (user.employment === "self") {
      score += 15;
    } else {
      score += 5;
    }

    user.creditScore = score;
    await user.save();

    if (score < 60) {
      return res.json({
        status: "Rejected",
        score
      });
    }

    const interestRate = 10;
    const totalRepayment = amount + (amount * interestRate / 100);

    const loan = await Loan.create({
      userId,
      amount,
      repaymentDays,
      interestRate,
      totalRepayment,
      status: "Approved"
    });

    res.json({
      status: "Approved",
      score,
      loan
    });

  } catch (error) {
    res.status(500).json({ message: error.message });
  }
});

module.exports = router;