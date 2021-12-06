let var1 = 0;
let var2 = 0;
let var3 = 0;
let var4 = 0;
let var5 = 0;
let var6 = 1;
let total_price = 0;

let price_default = 50;

assignment = "Thesis";
educationValue = "University";
serviceValue = "writing";
wordValue = 200;

if (assignment == "Thesis" || assignment == "Project") {
  var1 = 25;
}
//////////////////////////////////////////////////////////////

if (educationValue == "University" || assignment == "College") {
  var2 = 25;
}
if (educationValue == "Masters" || assignment == "Doc") {
  var3 = 50;
}
//////////////////////////////////////////////////////////////

if (serviceValue == "writing" || serviceValue == "rewriting") {
  var4 = 15;
}
if (serviceValue == "Proofreading" || serviceValue == "Editing") {
  var5 = 20;
}
//////////////////////////////////////////////////////////////

if (wordValue > 275) {
  var6 = wordValue / 275;
}
total();

function total() {
  total_price = (price_default + var1 + var2 + var3 + var4 + var5) * var6;

  console.log(
    price_default +
      " " +
      var1 +
      " " +
      var2 +
      " " +
      var3 +
      " " +
      var4 +
      " " +
      var5
  );
  console.log(total_price);
}
