const mongoose = require("mongoose");

const UserSchema = new mongoose.Schema({
  fullName: String,
  nationalId: String,
  phone: String,
  employment: String,
  income: Number,
  mpesa: String,
  creditScore: {
    type: Number,
    default: 50
  },
  createdAt: {
    type: Date,
    default: Date.now
  }
});

module.exports = mongoose.model("User", UserSchema);