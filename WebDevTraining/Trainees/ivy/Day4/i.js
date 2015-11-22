numQuotes=10;
quoteArray = new Array(numQuotes);
quoteArray[0]="\"Great spirits have always encountered violentopposition from mediocre minds.\"  -Albert Einstein";
quoteArray[1]="\"Tis nobler to lose honor to save the lives of men than tis to gain honor by taking them.\"  -David Borenstein"
quoteArray[2]="\"Freedom is that instant between when someone tells you to do something and when decide how to respond.\"  -Jeffery Borenstein"
quoteArray[3]="\"To live a pure unselfish life, one must count nothing as one's own in the midst of abundance.\"  -Buddha"
quoteArray[4]="\"We need more people who specialize in the impossible.\"  -Unknown"
quoteArray[5]="\"It is not enough to have a good mind; the main thing is to use it well.\"  -Rene Descartes"
quoteArray[6]="\"The world is so fast that there are days when the person who says it can't be done is interrupted by the person who is doing it.\"  -Unknown"
quoteArray[7]="\"The future belongs to those who believe in the beauty of their dreams.\"  -Eleanor Roosevelt"
quoteArray[8]="\"Diamonds are nothing more than chunks of coal that stuck to their jobs.\"  -Malcolm Forbes"
quoteArray[9]="\"It is not for him to pride himself who loveth his own country, but rather for him who loveth the whole world. The earth is but one country and mankind its citizens.\"  -Baha'u'llah"

quoteShowing=-1;


function randQuote()
{ 
    quoteShowing = Math.ceil(Math.random() * numQuotes);

  document.quoteForm.quoteHere.value = quoteArray[quoteShowing];
}


