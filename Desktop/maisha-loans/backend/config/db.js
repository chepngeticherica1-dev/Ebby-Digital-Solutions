mongoose.connect(process.env.MONGO_URI);

const connectDB = async () => {
  try {
    await mongoose.connect("mongodb://127.0.0.1:27017/maisha_loans");
    console.log("MongoDB Connected");
  } catch (error) {
    console.log(error);
    process.exit(1);
  }
};

module.exports = connectDB;
