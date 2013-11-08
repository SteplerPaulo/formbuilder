aTens = [ "Twenty", "Thirty", "Forty", "Fifty", "Sixty", "Seventy", "Eighty", "Ninety"];
aOnes = [ "Zero", "One", "Two", "Three", "Four", "Five", "Six", "Seven", "Eight", "Nine",
  "Ten", "Eleven", "Twelve", "Thirteen", "Fourteen", "Fifteen", "Sixteen", "Seventeen", "Eighteen", 
  "Nineteen" ];
function ConvertToHundreds(num)
{
   var cNum, nNum;
   var cWords = "";
   num %= 1000;
   if (num > 99) {
      /* Hundreds. */
      cNum = String(num);
      nNum = Number(cNum.charAt(0));
      cWords += aOnes[nNum] + " Hundred";
      num %= 100;
      if (num > 0)
         cWords += " and "
   }

   if (num > 19) {
      /* Tens. */
      cNum = String(num);
      nNum = Number(cNum.charAt(0));
      cWords += aTens[nNum - 2];
      num %= 10;
      if (num > 0)
         cWords += "-";
   }
   if (num > 0) {
      /* Ones and teens. */
      nNum = Math.floor(num);
      cWords += aOnes[nNum];
   }
   return cWords;
}
function amountToWords(num)
{
   var aUnits = [ "Thousand", "Million", "Billion", "Trillion", "Quadrillion" ];
   var cWords = (num >= 1 && num < 2) ? "Peso and " : "Pesos and ";
   var nLeft = Math.floor(num);
   for (var i = 0; nLeft > 0; i++) { 
       if (nLeft % 1000 > 0) {
          if (i != 0)
             cWords = ConvertToHundreds(nLeft) + " " + aUnits[i - 1] + " " + cWords;
          else
             cWords = ConvertToHundreds(nLeft) + " " + cWords;
       }
       nLeft = Math.floor(nLeft / 1000);
   }
   num = Math.round(num * 100) % 100;
   if (num > 0 && num != 1)
      cWords += ConvertToHundreds(num) + " Centavos";
   else if (num == 1)
	cWords += "One Centavo";
   else
      cWords += "Zero Centavo";
   return cWords;
}